<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Admin;
use App\Models\admin\Award;
use Illuminate\Support\Facades\Hash;
use App\Models\admin\Pages;
use File;
use Image;
class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->awards = Award::orderBy('item_no')->get();
    }

    public function index()
    {
        $type = 'Award';
        $data = [
            'pageData' =>  Pages::where('type', 'award_page')->first(),
            'type' => $type,
            'awards' =>  $this->awards];
        return view('admin.home-editor.popup-page', $data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createaward()
    {

        $type = 'AddAward';
        // dd($type);
        $data = [
            'pageData' =>  Pages::where('type', 'award_page')->first(),
                    'type' => $type
                ];
       
        return view('admin.home-editor.popup-page',$data);
        // return view('adm.pages.award.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->file('image'));

        $list_no = Award::orderBy('created_at', 'desc')->first();

        if($list_no){
            $list_no =  $list_no->id + 1;
        }else{
            $list_no = 1;
        }
     
        if($request->status){
            $status = 1;
        }else{
            $status = 0;
        }

        if($request->file('image')){
            $image = $request->file('image');
            $image_name = time() . '_' . $image->getClientOriginalName();
    
            // Compress and save the image
            $image_path = public_path('images/' . $image_name);
            Image::make($image)
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($image_path, 75); // 75% quality
    
            // Delete the old image if it exists
            if ($request->old_image && file_exists(public_path('images/' . $request->old_image))) {
                unlink(public_path('images/' . $request->old_image));
            }
        } else {
            $image_name = $request->old_image;
        }

        $award = new Award;
        $award->name = $request->name;
        $award->item_no = $list_no;
        $award->note = $request->note;
        $award->image = $image_name;
        $award->admin_id = session('LoggedUser')->id;
        $award->status = $status;
               
        $save = $award->save();

        if($save){
            return response()->json([
                'success' => true,
                'message' => 'Client Updated...'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, try again later...'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = 'award_edit';
        $award = Award::find($id);
        if(!isset($award)){
            return redirect(route('award.index'));
        }
        
        $data = [
            'pageData' =>  Pages::where('type', 'award_page')->first(),
            'award' =>  Award::find($id), 'awards' => $this->awards,'type' => $type];
            return view('admin.home-editor.popup-page', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Check the status from the request
        $status = $request->status == 'on' ? 1 : 0;
    
        if($request->file('image')){
            $image = $request->file('image');
            $image_name = time() . '_' . $image->getClientOriginalName();
    
            // Compress and save the image
            $image_path = public_path('images/' . $image_name);
            Image::make($image)
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($image_path, 75); // 75% quality
    
            // Delete the old image if it exists
            if ($request->old_image && file_exists(public_path('images/' . $request->old_image))) {
                unlink(public_path('images/' . $request->old_image));
            }
        } else {
            $image_name = $request->old_image;
        }
    
        // Update the award details
        $award = Award::find($id);
        $award->name = $request->name;
        $award->note = $request->note;
        $award->image = $image_name;
        $award->status = $status;
    
        $save = $award->save();
    
        if ($save) {
            return response()->json([
                'success' => true,
                'message' => 'Award Updated...'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, try again later...'
            ]);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $award = Award::find((int)$id);
        deleteBulkImage($award->image);
        $delete = $award->delete();
        if($delete){
            return response()->json([
                'success' => true,
                'message' => 'Award Deleted...'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, try again later...'
            ]);
        }

    }

    public function deleteItem(Request $request, $id)
    {
        $video = Award::find($id);
        if($video){
            deleteTableUrlData($video->id, 'testimonial_link');
            $delete = $video->delete();

            if(isset($delete)){
                deleteBulkImage($video->image);
                if($request->ajax())
                {
                    return response()->json(['success' => 'Content Deleted Successfully']);
                } else {
                    return back()->with('success', 'Data Deleted...');
                }
            }
            else{
                return back()->with('fail', 'Something went wrong, try again later...');
            }
        }
        else{
            return redirect(route('index'));
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Partners;
use Intervention\Image\Facades\Image;
use App\Models\admin\Pages;

class PartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = 'Partners_List';
        $data = [
            'pageData' =>  Pages::where('type', 'client_page')->first(),
            'blogs' =>  Partners::orderBy('item_no', 'ASC')->get(),
            'type' => $type
        ];
        return view('admin.home-editor.popup-page', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = 'Addpartners';
        $data = [
            'pageData' =>  Pages::where('type', 'client_page')->first(),
            'blogs' =>  Partners::all(),'type' => $type
        ];
        return view('admin.home-editor.popup-page',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   
        $list_no = Partners::orderBy('created_at', 'desc')->first();

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

        if ($request->file('image')) {
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
            // If no new image is uploaded, use the old image
            $image_name = $request->old_image;
        }
        $blog = new Partners;
        $blog->title = $request->title;
        $blog->short_description = $request->short_description;
        $blog->full_description= $request->full_description;
        $blog->image = $image_name;
        $blog->image_alt = $request->image_alt;
        $blog->image_title = $request->image_title;

        $blog->slug = $request->slug;

        $blog->meta_title  = $request->meta_title;
        $blog->meta_keyword  = $request->meta_keyword;
        $blog->meta_description  = $request->meta_description;

        $blog->search_index = $request->search_index;      
        $blog->search_follow = $request->search_follow;      
        $blog->canonical_url = $request->canonical_url;   

        $blog->status = $status;
        $save = $blog->save();

        if($save){
            // return back()->with('success', 'Partners Added...');
            return response()->json([
                'success' => true,
                'message' => 'Partner Added...'
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
        $type = 'partners_edit';
        $data = [
            'pageData' =>  Pages::where('type', 'client_page')->first(),
            'blog' =>  Partners::find($id),
            'type' => $type
        ];
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
        // dd($request->input());
    

        $list_no = Partners::orderBy('created_at', 'desc')->first();

        if($list_no){
            $list_no =  $list_no->id + 1;
        }else{
            $list_no = 1;
        }
 
        if($request->status == 'on'){
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
    
        $blog =  Partners::find($id);
        $blog->title = $request->title;
        $blog->short_description = $request->short_description;
        $blog->full_description= $request->full_description;
        $blog->image = $image_name;
        $blog->image_alt = $request->image_alt;
        $blog->image_title = $request->image_title;
        
        $blog->slug = $request->slug;
        
        $blog->meta_title  = $request->meta_title;
        $blog->meta_keyword  = $request->meta_keyword;
        $blog->meta_description  = $request->meta_description;

        $blog->search_index = $request->search_index;      
        $blog->search_follow = $request->search_follow;      
        $blog->canonical_url = $request->canonical_url;   

        $blog->status = $status;
        $save = $blog->save();

        if($save){
            // return back()->with('success', 'Partners Updated...')->with('close', '1');
            return response()->json([
                'success' => true,
                'message' => 'Partner Updated...'
            ]);
        }else{
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
        // dd($partners->image);
        $partners =  Partners::find((int)$id);
        $delete = $partners->delete();
        deleteTableUrlData($partners->id,'product_link');
        if($delete){

            deleteBulkImage($partners->image);
            return response()->json([
                'success' => true,
                'message' => 'Partner Updated...'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, try again later...'
            ]);
        }
    }

    public function deleteItem($id)
    {
        $blog = Partners::find($id);
        if($blog){
            deleteTableUrlData($blog->id, 'blog_link');
            $delete = $blog->delete();
            if($delete){
                deleteBulkImage($blog->image);
                // return back()->with('success', 'Partners Deleted...');
                if($request->ajax())
                {
                    return response()->json(['success' => 'Content Deleted Successfully']);
                } else {
                    return back()->with('success', 'Partners Deleted...');
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

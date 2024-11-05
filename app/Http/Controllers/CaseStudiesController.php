<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CaseStudies;
use App\Models\admin\Pages;
use Session;
use Intervention\Image\Facades\Image;

class CaseStudiesController extends Controller
{
    public function index()
    {
        $type = 'Casestudies';
        
        $data = [
            'pageData' =>  Pages::where('type', 'casestudies_page')->first(),
            'testimonials' =>  CaseStudies::orderBy('item_no')->get(),
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
        $type = 'CasestudiesCreate';
        $data = [
            'type' => $type,
            'pageData' =>  Pages::where('type', 'casestudies_page')->first(),
            'testimonials' =>  CaseStudies::all()];
            return view('admin.home-editor.popup-page', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $file_name = uploadAnyFile($request, $name = 'file', $saveName = date("Ymdhis"), $path = public_path('web/casestudies').'');
        /*$destinationPath = public_path('/web/casestudies');
        $file = $request->file('file');
        $file->move($destinationPath,$file->getClientOriginalName());*/


         
        $item_no = CaseStudies::orderBy('item_no', 'desc')->first();

        if($item_no){
            $item_no =  $item_no->item_no + 1;
        }else{
            $item_no = 1;
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
        $file_name = uploadAnyFile($request, $name = 'file', $saveName = date("Ymdhis"), $path = public_path('/casestudies'));

        $casestudies = new CaseStudies;
        $casestudies->item_no = $item_no;
        $casestudies->title = $request->title;
        $casestudies->short_description = $request->short_description;
        $casestudies->full_description= $request->full_description;
        $casestudies->image = $image_name;
        $casestudies->file_name = $file_name;
        $casestudies->slug = $request->slug;
        $casestudies->meta_title = $request->meta_title;
        $casestudies->meta_keyword = $request->meta_keyword;
        $casestudies->meta_description = $request->meta_description;
        $casestudies->search_index = $request->search_index;
        $casestudies->search_follow = $request->search_follow;
        $casestudies->canonical_url = $request->canonical_url;
        $casestudies->image_alt = $request->image_alt;      
        $casestudies->image_title = $request->image_title;  
        $casestudies->status = $status;

        $save = $casestudies->save();

        if($save){
            return response()->json([
                'success' => true,
                'message' => 'Case Studies Updated...'
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
        $type = 'casestudies_edit';
        $testimonial = CaseStudies::find($id);
        $data = [
            'pageData' =>  Pages::where('type', 'casestudies_page')->first(),
            'testimonial' =>  $testimonial,
            'type' => $type
        ];

        if($testimonial){
            return view('admin.home-editor.popup-page', $data);
        }
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
        // dd($request);
        /*print_r($_REQUEST);
        exit();*/
     

        $item_no = CaseStudies::orderBy('item_no', 'desc')->first();
        /*if($item_no){
            $item_no =  $item_no->item_no + 1;
        }else{
            $item_no = 1;
        }*/

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

        if($request->file('file')){
            // dd($request->old_image);
            $file_name = uploadAnyFile($request, $name = 'file', $saveName = date("Ymdhis"), $path = public_path('/casestudies'));
            deleteBulkImage($request->old_file);
        }else{
            $file_name = $request->old_file;
        }
        
        $casestudies = CaseStudies::find($id);
        // $casestudies->item_no = $item_no;
        $casestudies->title = $request->title;
        $casestudies->short_description = $request->short_description;
        $casestudies->full_description= $request->full_description;
        $casestudies->image = $image_name;
        $casestudies->file_name = $file_name;
        $casestudies->slug = $request->slug;
        $casestudies->meta_title = $request->meta_title;
        $casestudies->meta_keyword = $request->meta_keyword;
        $casestudies->meta_description = $request->meta_description;
        $casestudies->search_index = $request->search_index;
        $casestudies->search_follow = $request->search_follow;
        $casestudies->canonical_url = $request->canonical_url;
        $casestudies->image_alt = $request->image_alt;      
        $casestudies->image_title = $request->image_title;  
        $casestudies->status = $status;

        $save = $casestudies->save();

        if($save){
            return response()->json([
                'success' => true,
                'message' => 'Case Studies Updated...'
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
    public function destroy(Request $request,$id)
    {
        $casestudies = CaseStudies::find($id);
        deleteTableUrlData($id, 'casestudies_link');

        $delete = $casestudies->delete();
        
        if($delete){
            deleteBulkImage($casestudies->image);
            return response()->json([
                'success' => true,
                'message' => 'Case Studies Updated...'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, try again later...'
            ]);
            // 
        }


        // $video = $video->delete();
        // if($video){
        //     return back()->with('success', 'Video Deleted...');
        // }else{
        //     return back()->with('fail', 'Something went wrong, try again later...');
        // }

    }

    public function deleteItem(Request $request,$id)
    {
        
            $casestudies = CaseStudies::find($id);
            if($casestudies){
            deleteTableUrlData($casestudies->id, 'casestudies_link');
            $delete = $casestudies->delete();
            if($delete){
                deleteBulkImage($casestudies->image);
                // return back()->with('success', 'Casestudies Deleted...');
                if($request->ajax())
                {
                    return response()->json(['success' => 'CaseStudies Deleted...']);
                } else {
                    return back()->with('success', 'CaseStudies Deleted...');
                }
            }else{
                // return back()->with('fail', 'Something went wrong, try again later...');
                if($request->ajax())
                {
                    return response()->json(['fail' => 'Something went wrong, try again later...']);
                } else {
                    return back()->with('fail', 'Something went wrong, try again later...');
                }
            }
        }
        else{
            return redirect(route('index'));
        }
    }
}

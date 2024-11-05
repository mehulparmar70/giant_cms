<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Newsletter;
use App\Models\admin\Pages;
use Intervention\Image\Facades\Image;

class NewsletterController extends Controller
{
    public function index()
    {
      
        $type = 'newsletter';
        $data = [
            'pageData' =>  Pages::where('type', 'newsletter_page')->first(),
            'testimonials' =>  Newsletter::orderBy('item_no')->get(),
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
        $type = 'newsletter_add';
        $data = [
            'pageData' =>  Pages::where('type', 'newsletter_page')->first(),
            'testimonials' =>  Newsletter::all(),
            'type' => $type];
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
        // $file_name = uploadAnyFile($request, $name = 'file', $saveName = date("Ymdhis"), $path = public_path('web/Newsletter').'');
        /*$destinationPath = public_path('/web/Newsletter');
        $file = $request->file('file');
        $file->move($destinationPath,$file->getClientOriginalName());*/


  
        $item_no = Newsletter::orderBy('item_no', 'desc')->first();

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
        $Newsletter = new Newsletter;
        $Newsletter->item_no = $item_no;
        $Newsletter->title = $request->title;
        $Newsletter->short_description = $request->short_description;
        $Newsletter->full_description= $request->full_description;
        $Newsletter->image = $image_name;
        // $Newsletter->file_name = $file_name;
        $Newsletter->slug = $request->slug;
        $Newsletter->meta_title = $request->meta_title;
        $Newsletter->meta_keyword = $request->meta_keyword;
        $Newsletter->meta_description = $request->meta_description;
        $Newsletter->search_index = $request->search_index;
        $Newsletter->search_follow = $request->search_follow;
        $Newsletter->canonical_url = $request->canonical_url;
        $Newsletter->image_alt = $request->image_alt;      
        $Newsletter->image_title = $request->image_title;  
        $Newsletter->status = $status;

        $save = $Newsletter->save();

        if($save){
            return response()->json([
                'success' => true,
                'message' => 'Industries Updated...'
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
        $type = 'newsletter_edit';
        $testimonial = Newsletter::find($id);
        $data = [
            'pageData' =>  Pages::where('type', 'newsletter_page')->first(),
            'testimonial' =>  $testimonial,
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

     
        $item_no = Newsletter::orderBy('item_no', 'desc')->first();
        if($item_no){
            $item_no =  $item_no->item_no + 1;
        }else{
            $item_no = 1;
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
        /*if($request->file('file')){
            // dd($request->old_image);
            $file_name = uploadAnyFile($request, $name = 'file', $saveName = date("Ymdhis"), $path = public_path('/web/Newsletter'));
            deleteBulkImage($request->old_file);
        }else{
            $file_name = $request->old_file;
        }*/
        
        $Newsletter = Newsletter::find($id);
        $Newsletter->item_no = $item_no;
        $Newsletter->title = $request->title;
        $Newsletter->short_description = $request->short_description;
        $Newsletter->full_description= $request->full_description;
        $Newsletter->image = $image_name;
        // $Newsletter->file_name = $file_name;
        $Newsletter->slug = $request->slug;
        $Newsletter->meta_title = $request->meta_title;
        $Newsletter->meta_keyword = $request->meta_keyword;
        $Newsletter->meta_description = $request->meta_description;
        $Newsletter->search_index = $request->search_index;
        $Newsletter->search_follow = $request->search_follow;
        $Newsletter->canonical_url = $request->canonical_url;
        $Newsletter->image_alt = $request->image_alt;      
        $Newsletter->image_title = $request->image_title;  
        $Newsletter->status = $status;

        $save = $Newsletter->save();

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*dd($Newsletter);
        exit();*/
        $Newsletter = Newsletter::find((int)$id);
        deleteTableUrlData($Newsletter->id, 'newsletter_link');

        $delete = $Newsletter->delete();
        
        if($delete){
            deleteBulkImage($Newsletter->image);
            return response()->json([
                'success' => true,
                'message' => 'Newsletter Updated...'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, try again later...'
            ]);
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
            $Newsletter = Newsletter::find($id);
            if($Newsletter){
            deleteTableUrlData($Newsletter->id, 'newsletter_link');
            $delete = $Newsletter->delete();
            if($delete){
                deleteBulkImage($Newsletter->image);
                if($request->ajax())
                {
                    return response()->json(['success' => 'Content Deleted Successfully']);
                } else {
                    return back()->with('success', 'Newsletter Deleted...');
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

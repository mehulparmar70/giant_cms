<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Testimonials;
use App\Models\admin\Pages;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = 'Testimonials';
        $data = [
            'pageData' =>  Pages::where('type', 'client_page')->first(),
            'testimonials' =>  Testimonials::orderBy('item_no')->get(),
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
        $type = 'testimonial_create';
        $data = [
            'pageData' =>  Pages::where('type', 'client_page')->first(),
            'testimonials' =>  Testimonials::all(),
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
        
       
         
        $item_no = Testimonials::orderBy('item_no', 'desc')->first();

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
        $testimonial = new Testimonials;
        $testimonial->client_name = $request->client_name;
        $testimonial->item_no = $item_no;
        $testimonial->title = $request->title;
        $testimonial->short_description = $request->short_description;
        $testimonial->full_description= $request->full_description;
        $testimonial->image = $image_name;

        $testimonial->image_alt = $request->image_alt;      
        $testimonial->image_title = $request->image_title;  
        
        $testimonial->youtube_embed = $request->youtube_embed;
        $testimonial->slug = $request->slug;
        
        $testimonial->status = $status;
        $save = $testimonial->save();

        if($save){
            return response()->json([
                'success' => true,
                'message' => 'Testimonial Updated...'
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
        $type = 'Testimonial_edit';
        $testimonial = Testimonials::find($id);
        $data = [
            'pageData' =>  Pages::where('type', 'client_page')->first(),
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

       

        $item_no = Testimonials::orderBy('item_no', 'desc')->first();
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
        
        $testimonial =  Testimonials::find($id);
        $testimonial->client_name = $request->client_name;
        $testimonial->title = $request->title;
        $testimonial->short_description = $request->short_description;
        $testimonial->full_description= $request->full_description;
        $testimonial->image = $image_name;
        $testimonial->image_alt = $request->image_alt;      
        $testimonial->image_title = $request->image_title;  

        $testimonial->youtube_embed = $request->youtube_embed;
        $testimonial->slug = $request->slug;
        
        $testimonial->status = $status;
        $save = $testimonial->save();

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
        // dd($testimonial);
        $testimonial =  Testimonials::find((int)$id);
        deleteTableUrlData($testimonial->id, 'testimonial_link');

        $delete = $testimonial->delete();
        
        if($delete){
            deleteBulkImage($testimonial->image);
            return response()->json([
                'success' => true,
                'message' => 'Testimonial Updated...'
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

    public function deleteItem($id)
    {
            $testimonial = Testimonials::find($id);
            if($testimonial){
            deleteTableUrlData($testimonial->id, 'testimonial_link');
            $delete = $testimonial->delete();
            if($delete){
                deleteBulkImage($testimonial->image);
                if($request->ajax())
                {
                    return response()->json(['success' => 'Content Deleted Successfully']);
                } else {
                    return back()->with('success', 'Testimonial Deleted...');
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

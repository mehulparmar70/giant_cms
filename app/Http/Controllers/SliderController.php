<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Slider;
use App\Models\admin\Pages;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = 'Slider';
        $data = [
            'type' => $type,
            'pageData' =>  Pages::where('type', 'client_page')->first(),
            'sliders' =>  Slider::orderBy('slider_no')->get()
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
        //
        $type = 'Add_Slider';
        $data = [
            'pageData' =>  Pages::where('type', 'client_page')->first(),
                    'type' => $type
                ];
        // dd($data);
        return view('admin.home-editor.popup-page',$data);
        // return view('slider.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $slider_no = Slider::orderBy('slider_no', 'desc')->first();

        if($slider_no){
            $slider_no =  $slider_no->slider_no + 1;
        }else{
            $slider_no = 1;
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
        $slider = new Slider;
        $slider->slider_no = $slider_no;
        $slider->title = $request->title;
        $slider->image = $image_name;
        $slider->description = $request->description;
        $slider->url = $request->url;
        $slider->youtube_embed = $request->youtube_embed;

        $slider->meta_title  = $request->meta_title;
        $slider->meta_keyword  = $request->meta_keyword;
        $slider->meta_description  = $request->meta_description;
        
        $slider->status = $status;
        
        $save = $slider->save();

        if($save){
            $slider_list = Slider::find($slider->id);
            $slider_list->slider_no = $slider_no;
            $slider_list->save();
            return response()->json([
                'success' => true,
                'message' => 'Slider Added...'
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
        // dd($id);

        $slider =  Slider::find($id);
        $type = 'EditSlider';
        $data = [
            'pageData' =>  Pages::where('type', 'client_page')->first(),
            'sliders' =>  Slider::orderBy('slider_no')->get(),
            'slider' =>  $slider,
            'type' => $type
        ];
        
        // if($slider){
            // return view('adm.pages.slider.edit', $data);
            return view('admin.home-editor.popup-page', $data);
        // }else{
        //     return redirect(route('slider.index'))->with('fail', 'Slider Not Available...');
        // }

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
   

        if($request->file('image')){
            $image = $request->file('image');
        $image_name = time() . '_' . $image->getClientOriginalName();
        $image_path = public_path('images/' . $image_name);
        Image::make($image)
            ->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->save($image_path, 75); // 75% quality
            if ($request->old_image && file_exists(public_path('images/' . $request->old_image))) {
                unlink(public_path('images/' . $request->old_image));
            }
        }else{
            $image_name = $request->old_image;
        }

        $slider_no = Slider::orderBy('slider_no', 'desc')->first();

        if($request->status){
            $status = 1;
        }else{
            $status = 0;
        }

        $slider = Slider::find($id);
        $slider->title = $request->title;
        $slider->image = $image_name;
        $slider->description = $request->description;
        $slider->url = $request->url;
        $slider->youtube_embed = $request->youtube_embed;

        $slider->meta_title  = $request->meta_title;
        $slider->meta_keyword  = $request->meta_keyword;
        $slider->meta_description  = $request->meta_description;
        
        $slider->status = $status;
        // $slider->admin_id = session('LoggedUser')->id;
        
        $save = $slider->save();


        if($save){
            return response()->json([
                'success' => true,
                'message' => 'Slider Updated...'
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
        
        $slider = Slider::find((int)$id);
        // dd($slider);
        // dd($slider->id);
        deleteBulkImage($slider->image);
        $slider = $slider->delete();
        if($slider){
            return response()->json([
                'success' => true,
                'message' => 'Slider Deleted...'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, try again later...'
            ]);
        }
    }

    public function update_list_no($id){
                 
  	    $i=1;
  		foreach ($data as $key => $value) {
                $slider = Slider::find($value);
                $slider->slider_no = $i;
                $slider->save();
			$i++;
		}
    }
    
}

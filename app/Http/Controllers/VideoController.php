<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Video;
use Intervention\Image\Facades\Image;
use App\Models\admin\Pages;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = 'videoIndex';
        $data = [
            'videos' =>  Video::orderBy('item_no')->get(),
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
        $type = 'Addvideo';
        $data = [
            'pageData' =>  Pages::where('type', 'video_page')->first(),
            'videos' =>  Video::all(),'type' => $type];
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
        // dd($request->status);
       

        
        $item_no = Video::orderBy('item_no','desc')->first();

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
        
        $youtube1 = "https://www.youtube.com/watch?v=";
        $youtube2 = "https://youtu.be";
        $mystring = $request->youtube_embed;

        // if(strpos($mystring, $youtube1) !== false){
        //     $youtube_embed = str_replace("https://www.youtube.com/watch?v=","https://www.youtube.com/embed/",$request->youtube_embed);
        // }
        // else if(strpos($mystring, $youtube2) !== false){
        //     $youtube_embed = str_replace("https://youtu.be","https://www.youtube.com/embed",$request->youtube_embed);
        // }else{
        //     $youtube_embed = null;
        // }


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
        $video = new Video;
        $video->title = $request->title;
        $video->item_no = $item_no;
        $video->short_description = $request->short_description;
        $video->video_date = $request->video_date;
        
        $video->youtube_embed = $request->youtube_embed;

        $video->status = $status;
        $save = $video->save();

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
        $type = 'Video_edit';
        $video = Video::find($id);
        $data = [
            'pageData' =>  Pages::where('type', 'video_page')->first(),
            'video' =>  $video,'type' => $type
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
      

        
        $item_no = Video::orderBy('item_no')->first();

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


        
        $video =  Video::find($id);
        $video->title = $request->title;
        $video->short_description = $request->short_description;
        $video->video_date = $request->video_date;
        $video->youtube_embed = $request->youtube_embed;

        $video->status = $status;
        $save = $video->save();

        if($save){
            return response()->json([
                'success' => true,
                'message' => 'Video Updated...'
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
        $video =  Video::find((int)$id);
        $video = $video->delete();
        if($video){
            return response()->json([
                'success' => true,
                'message' => 'Video Deleted...'
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
        $video = Video::find($id);
        if($video){
            deleteTableUrlData($video->id, 'testimonial_link');
            $delete = $video->delete();

            if(isset($delete)){
                deleteBulkImage($video->image);
                return back()->with('success', 'Testimonial Deleted...');
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

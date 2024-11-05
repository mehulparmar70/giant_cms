<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Admin;
use App\Models\admin\Client;
use Illuminate\Support\Facades\Hash;
use App\Models\admin\Media;
use App\Models\admin\Pages;
use File;
use Intervention\Image\Facades\Image;

use DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(){
        $this->clients = Client::orderBy('item_no')->get();
    }
    

    public function client()
    {
        
        $data = ['clients' =>  $this->clients];
        
        return view('client.client', $data);
    }


    public function index()
    {
        $type = 'Client';
        $data = [
            'pageData' =>  Pages::where('type', 'client_page')->first(),
            'clients' =>  $this->clients,
            'type' => $type];
        // dd($data);
        return view('admin.home-editor.popup-page', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $type = 'AddClient';
        $data = [
            'pageData' =>  Pages::where('type', 'client_page')->first(),
                    'type' => $type
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
       
        // dd($request->file('image'));
        // dd($request);
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
        // $image_name ='client';
        $client = new Client;
        $client->name = $request->name;
        $client->image = $image_name;
        $client->url = $request->page_link;
        $client->alt_text = $request->image_alt;
        $client->image_title = $request->image_title;
        $client->short_description = $request->short_description;
        // $client->client_images = $image_name;
        $client->note = $request->note;
        $client->admin_id = session('LoggedUser')->id;
        $client->status = $status;
               
        $save = $client->save();
        $lastId = $client->id;
        if($save){

            // $multipleImage = $request->file('images');
            /*print_r($request->all());
            exit();*/
            // if (isset($multipleImage)) {
            //     foreach($request->file('images') as $index => $imageData){
            //         $media = new Media;
            //         $media->media_id = $lastId;
            //         $media->image_type = 'clients';
            //         $media->image_alt = $request->alt[$index];
            //         $media->image_title = $request->title[$index];
            //         $image_name2 = $imageData;
            //         $media->image = $image_name2;
            //         $save = $media->save();
            //     }
            // }
            return response()->json([
                'success' => true,
                'message' => 'Client Created...'
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

       
        $type = 'client_edit';
        $client = Client::find($id);
        if(!isset($client)){
            return redirect(route('client.index'));
        }
        $media = DB::table('media')->where('media_id', $id)->where('image_type', 'clients')->get();
        
        $data = [
            'pageData' =>  Pages::where('type', 'client_page')->first(),
            'client' =>  Client::find($id), 'clients' => $this->clients,'media' =>  $media,'type' => $type];
        
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
    if($request->status == 'on'){
        $status = 1;
    } else {
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

    $client = Client::find($id);
    $client->name = $request->name;
    $client->note  = $request->note;  
    $client->image = $image_name;
    $client->url = $request->url;
    $client->alt_text = $request->image_alt;
    $client->image_title = $request->image_title;
    $client->short_description = $request->short_description;
    $client->status = $status;     

    $save = $client->save();

    if ($save) {
        // $multipleImage = $request->file('images');

        // if (isset($multipleImage)) {
        //     foreach ($request->file('images') as $index => $imageData) {
        //         $media = new Media;
        //         $media->media_id = $id;  // Assuming $id is the client ID
        //         $media->image_type = 'clients';
        //         $media->image_alt = $request->alt[$index];
        //         $media->image_title = $request->title[$index];
        //         $image_name2 = uploadMultipleImageThumb($imageData);
        //         $media->image = $image_name2;
        //         $media->save();
        //     }
        // }

        return response()->json([
            'success' => true,
            'message' => 'Client Updated...'
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
        // dd($client)
        $client = Client::find((int)$id);
        $delete = $client->delete();
        if($delete){
            deleteBulkImage($client->image);
            return response()->json([
                'success' => true,
                'message' => 'Client Deleted...'
            ]);
        }else{
           return response()->json([
            'success' => false,
            'message' => 'Something went wrong, try again later...'
        ]);
        }

    }
}

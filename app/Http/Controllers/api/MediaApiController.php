<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\admin\Media;

use Intervention\Image\Facades\Image;
// use Image;
use File;
use DB; 
use Session;
// use Illuminate\Support\Facades\Auth;

use Auth;


class MediaApiController extends Controller
{
    public function index(){
        header("Access-Control-Allow-Origin: *");
             
        $getPosts = DB::table('media')
        ->orderBy('media.id','desc')
        ->get();

        return response()->json($getPosts);

    }

    public function getProductImages($id){
        header("Access-Control-Allow-Origin: *");
        $getPosts = DB::table('media')
        ->orderBy('media.id','desc')
        ->where('media_id',$id)
        ->get();

        return response()->json($getPosts);
    }

    public function updateProductImage(Request $request){
        // dd($request->input());
        $media = Media::find($request->id);
        $media->id = $request->id;
        $media->image_alt = $request->image_alt;
        $media->image_title = $request->image_title;
        if($media->save()){        
            return 'Product Image Data Saved';
        }else{
            return 'something went wrong, try again later.';    
        }

    }

    
    public function mediaStore(Request $request){
        
        header("Access-Control-Allow-Origin: *");
        $image = $request->file('image');
            
        $input['imagename'] = time().'_'.rand(1111,9999).'.'.$image->extension();
        
        //icon images resize
        // $destinationPath = public_path('../../public_html/web/media/icon');
        $destinationPath = public_path('/web/media/icon');
        $img_icon = Image::make($image->path());
        $img_icon->resize(60, 60, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
        
        //xs images resize
        $destinationPath = public_path('/web/media/xs');
        $img_xs = Image::make($image->path());
        $img_xs->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
        
        //sm images resize
        $destinationPath = public_path('/web/media/sm');
        $img_sm = Image::make($image->path());
        $img_sm->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
        
        //md images resize
        $destinationPath = public_path('/web/media/md');
        $img_md = Image::make($image->path());
        $img_md->resize(600, 600, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
   
        //original image 
        $destinationPath = public_path('/web/media/lg');
        $image->move($destinationPath, $input['imagename']);
                    
            $media_id = 'med_'.mt_rand(1000, 9999).mt_rand(50000,99999);

                $media = new Media;
                $media->media_id = $request->media_id;
                $media->image_type = $request->image_type;
                $media->image_alt = $request->image_alt;
                $media->image_title = $request->image_title;
                $media->image = $input['imagename'];
                if($media->save()){       
                    return 'success';;
                }else{
                    return 'something went wrong, try again later.';

                }
    }

    public function updateImageData(Request $request){
        header("Access-Control-Allow-Origin: *");

                $media = Media::find($request->id);
                $media->image_alt = $request->image_alt;
                $media->image_title = $request->image_title;

                if($media->save()){        
                    return 'success';
                }else{
                    return 'something went wrong, try again later.';

            }
    }

    
    
    public function mediaDelete(Request $request) {
        header("Access-Control-Allow-Origin: *");
        $media = Media::find($request->id);
    
        if ($media) {
            $imagePath = public_path('images/' . $media->image);
            
            // Check if file exists before trying to delete
            if (File::exists($imagePath)) {
                try {
                    unlink($imagePath); // Delete the file
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error deleting the file: ' . $e->getMessage(),
                    ], 500);
                }
            }
    
            // Delete the media record from the database
            $media->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Image Deleted...',
                'deleted_id' => $request->id
            ]);
        }
    
        // Return a response if media is not found
        return response()->json([
            'success' => false,
            'message' => 'Media not found or already deleted.',
        ], 404);
    }

    public function imageDelete(Request $request){
        header("Access-Control-Allow-Origin: *");
    
        // Check for data presence
        if (!$request->has(['table', 'field', 'id'])) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required parameters.',
            ], 400);
        }
    
        $getData = DB::table($request->table)->where('id', $request->id)->first();
    
        if ($getData) {
            $fileName = $getData->{$request->field};
    
            if (File::exists(public_path('images/' . $fileName))) {
                unlink(public_path('images/' . $fileName));
    
                DB::table($request->table)->where('id', $request->id)->update([$request->field => null]);
    
                return response()->json([
                    'success' => true,
                    'message' => 'Image Deleted...'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'File not found.'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No matching record found.'
            ]);
        }
    }
    
}

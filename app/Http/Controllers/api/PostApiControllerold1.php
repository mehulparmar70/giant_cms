<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Notification;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Model\admin\Media;
use App\Model\user\post;
use App\Model\user\Pressnote;
use App\Model\user\category;
use App\Model\admin\Admin;
use Image;
use File;
use DB; 
// use Illuminate\Support\Facades\Auth;
use Auth;
use Session;
use Redirect;


class PostApiController extends Controller
{
    
        
    
    
    // public function getCsrf(){
    //     return csrf_token();
    // }

    public function checkLogin(Request $request){
        // return $request->all();
        
        // return Admin::where(['email' =>$request->email, 'password' => Hash::make($request->password)])->get()->count();

        
        $credentials = $request->only('email', 'password');
        $admin = Admin::where('email', $request->email)->first();

        if (Admin::where('email',$request->email)->count()) {
            if ($admin->status === 1) {
                
                if(Auth::guard('admin')->attempt($credentials, $request->remember)){
                    $user = Admin::where('email', $request->email)->first();
                    Auth::guard('admin')->login($user);
                    return [ 'status'=>'success', 'message'=>'Login Success...','loginUserData'=>$user];
                }
                return ['status'=>'wrong', 'message'=>'Wrong Email & Password...'];

            //    return ['email'=>$request->email,'password'=>$request->password, 'status'=>1];

            }else{
                
                return ['status'=>'inactive', 'message'=>'You are not active person, please contact to Admin.'];
            }
        }else{
            return ['status'=>'notfound', 'email'=>$request->email,'message'=>'Email not found.'];
        }


        


            
        // dd(admin::where('email',$request->email)->count());

        if (admin::where('email',$request->email)->count()) {
            if ($admin->status == 0) {
                return ['email'=>'inactive','password'=>'You are not active person, please contact Admin.'];
            }else{
               return ['email'=>$request->email,'password'=>$request->password, 'status'=>1];

            }
        }else{
            return ['email'=>$request->email,'message'=>'email not found'];
            
        }
    }


    public function getJsonData(){
        return response()->json(
            [
                'message'=>'Fetched',
                'status' => 0,
                'categories' => DB::table('categories')->orderBy('id','DESC')->get(),
                
                'postList' => DB::table('posts')->whereNotIn('type',['bulletin'])->orderBy('id','DESC')->get(),

                'totalPosts'=> DB::table('posts')->whereNotIn('type',['bulletin'])->orderBy('id','DESC')->get()->count(),
                'bulletinList10' => DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->take(10)->get(),
                'bulletinList' => DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->get(),
                'pressnoteList' => DB::table('pressnotes')->orderBy('id','DESC')->get(),
                'totalPressnote' => DB::table('pressnotes')->get()->count(),
                'totalNews' => DB::table('posts')->whereNotIn('type',['bulletin'])->get()->count(),
                'totalBulletin' => DB::table('posts')->where('type','bulletin')->get()->count(),
            ]);
    }

    public function getCategoryList(){
        return response()->json(DB::table('categories')->orderBy('id','DESC')->get());
        
    } 

    public function getPosts(){
        return response()->json(DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->take(10)->get());
    }
    public function getPostLists(){
        return response()->json(DB::table('posts')->whereNotIn('type',['bulletin'])->orderBy('id','DESC')->get());
    } 


    public function getBulleinLists(){
        return response()->json(DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->get());
    } 

    
    public function storePost(Request $request){
        
    //    return $request->all();

    //    return  $rest = substr($request->body, 0, 1); // returns "de"
        $string =  $request->body;
       if($request->body[0] == '<' && $request->body[1] == 'p' && $request->body[2] == '>'  
            && $string[strlen($string)-1] == '>' && $string[strlen($string)-2] == 'p' && $string[strlen($string)-3] == '/'
            && $string[strlen($string)-4] == '<' ){
        //    return 'p tag';
           $body = $request->body;
       }else{
            $body = '<p>'.$request->body.'</p>';
       }

  
    if(isset($_FILES['avatar']['name'])){
    
    try{    
        $image = $request->file('avatar');
        $file = basename($_FILES['avatar']['name']);
        
        //icon images resize
        $destinationPath = public_path('/web/media/icon');
        $img_icon = Image::make($image->path());
        $img_icon->resize(60, 60, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$file);
        
        //xs images resize
        $destinationPath = public_path('/web/media/xs');
        $img_xs = Image::make($image->path());
        $img_xs->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$file);
        
        //sm images resize
        $destinationPath = public_path('/web/media/sm');
        $img_sm = Image::make($image->path());
        $img_sm->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$file);
        
        //md images resize
        $destinationPath = public_path('/web/media/md');
        $img_md = Image::make($image->path());
        $img_md->resize(600, 600, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$file);   
        
        
       //lg images resize
       $destinationPath = public_path('/web/media/lg');
       $img_md = Image::make($image->path());
       $img_md->resize(1200, 1200, function ($constraint) {
           $constraint->aspectRatio();
       })->save($destinationPath.'/'.$file);        
       if($request->mul_images == 'null')
        {
           $mul_images = null;
        }else{
            $mul_images = $request->mul_images;
        }
        
        $youtube1 = "https://www.youtube.com/watch?v=";
        $youtube2 = "https://youtu.be";
        $mystring = $request->youtube;
        if(strpos($mystring, $youtube1) !== false){
            $youtube = str_replace("https://www.youtube.com/watch?v=","https://www.youtube.com/embed/",$request->youtube);
        }
        else if(strpos($mystring, $youtube2) !== false){
            $youtube = str_replace("https://youtu.be","https://www.youtube.com/embed",$request->youtube);
        }else{
            $youtube = null;
        }

        if($request->status == 'true'){
            $status = 1;
        }else{
            $status = 0;
        }

     

            $post = new post;
            // $post->category_id = $request->category;
            // $post->title = $request->title;
            // $post->subtitle =$request->subtitle;
            // $post->youtube =$youtube;
            // $post->body =$body;
            // $post->slug =$request->slug;
            // $post->type = 'bulletin';
            // $post->image =$file;
            // $post->mul_images = $mul_images ;
            // $post->status = $status;
            // $post->admin_id = $request->admin_id;

            
            $post->title = 1;
            $post->subtitle =1;
            $post->youtube ='sadadasd';
            $post->body ='sasda';
            $post->slug =1;
            $post->type = 'bulletin';
            $post->image ='sasda.jpg';
            $post->mul_images = '1sa5d4' ;
            $post->status = 1;
            $post->admin_id = 1;

            $post->save();
            // Notification::sendNotification($request->title, $request->subtitle, $request->slug, url('web').'/media/sm//'.$file);

            return response()->json('New Post Bulleting Added...');
            

            }
        catch(Exception $e){
        return response()->json('not uploaded'.$e);
            
         }
        }else{
            return response()->json('Please Select Image');

        }
    } 

    
    public function storePressnote(Request $request){
            // return ($request->all());
           if($request->mul_images == 'null')
            {
               $mul_images = null;
            }else{
                $mul_images = $request->mul_images;
            }
            
            $slug = rand(11,99).'_'.date("dmY");

                $pressnote = new Pressnote;
                $pressnote->category_id = $request->category;
                $pressnote->title = $request->title;
                $pressnote->subtitle =$request->subtitle;
                $pressnote->slug =$slug;
                $pressnote->mul_images = $mul_images ;
                $pressnote->admin_id = $request->admin_id;
                $pressnote->save();

                return response()->json(
                    [
                         'message'=>'New Pressnote Bulleting Added...',
                        'pressnoteList'=> DB::table('pressnotes')->orderBy('id','DESC')->get(),
                        'totalPressnote' => DB::table('pressnotes')->get()->count(),
                    ]
                );

                // return response()->json(
                //     [
                //         'message'=>'-- New Pressnote Bulleting Added...',
                //         'status' => 0,
                //         // 'categories' => DB::table('categories')->orderBy('id','DESC')->get(),
                //         // 'postList' => DB::table('posts')->whereNotIn('type',['bulletin'])->orderBy('id','DESC')->get(),
                //         // 'totalPosts'=> DB::table('posts')->whereNotIn('type',['bulletin'])->orderBy('id','DESC')->get()->count(),
                //         // 'bulletinList10' => DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->take(10)->get(),
                //         // 'bulletinList' => DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->get(),
                //         // 'pressnoteList' => DB::table('pressnotes')->orderBy('id','DESC')->get(),
                //         'totalPressnote' => DB::table('pressnotes')->get()->count(),
                //         'totalNews' => DB::table('posts')->whereNotIn('type',['bulletin'])->get()->count(),
                //         'totalBulletin' => DB::table('posts')->where('type','bulletin')->get()->count(),
                //     ]);

        }
        
    
    public function updatePressnote(Request $request){
        // return'test';
            // return $request->all();

            // return $request->mul_images;
            
           if($request->mul_images == 'null')
            {
               $mul_images = null;
            }else{
                $mul_images = $request->mul_images;
            }

           
                $pressnote = Pressnote::find($request->id);
                
                $pressnote->category_id = $request->category;
                $pressnote->title = $request->title;
                $pressnote->subtitle =$request->subtitle;
                $pressnote->mul_images = $mul_images ;
                $pressnote->status =  $request->status;
                
                $pressnote->save();
                
                return response()->json('Pressnote Updated...');
        }
     
        
    public function testMultiple(Request $request){

        // $image = $request->file('avatar');
        // $file = basename($_FILES['avatar']['name']);
        // return ($file);
        
        // //icon images resize
        // $destinationPath = public_path('/web/media/lg');
        // $img_icon = Image::make($image->path());
        // $img_icon->resize(60, 60, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save($destinationPath.'/'.$file);

        // return response()->json($_FILES['avatar']);
    
    if(isset($_FILES['avatar']['name'])){
        
    // $file = basename($_FILES['avatar']['name']);
    // $title = $request->title;
    // $category_id = $request->category;
    // $tmp_name = $_FILES['avatar']['tmp_name'];
    // return $tmp_name;
    
    try{    
        $image = $request->file('avatar');
        $file = basename($_FILES['avatar']['name']);
        
        //icon images resize
        $destinationPath = public_path('/web/media/icon');
        $img_icon = Image::make($image->path());
        $img_icon->resize(60, 60, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$file);
        
        //xs images resize
        $destinationPath = public_path('/web/media/xs');
        $img_xs = Image::make($image->path());
        $img_xs->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$file);
        
        //sm images resize
        $destinationPath = public_path('/web/media/sm');
        $img_sm = Image::make($image->path());
        $img_sm->resize(250, 250, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$file);
        
        //md images resize
        $destinationPath = public_path('/web/media/md');
        $img_md = Image::make($image->path());
        $img_md->resize(400, 400, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$file);   
        
        
       //lg images resize
       $destinationPath = public_path('/web/media/lg');
       $img_md = Image::make($image->path());
       $img_md->resize(800, 800, function ($constraint) {
           $constraint->aspectRatio();
       })->save($destinationPath.'/'.$file);        


            return response()->json('File Uploaded Successfully...');

            }
        catch(Exception $e){
        return response()->json('not uploaded'.$e);
            
         }
        }
    } 

    public function updatePost(Request $request){

// old  

        $string =  $request->body;
        $slug = $request->slug;

    
    $youtube1 = "https://www.youtube.com/watch?v=";
    $youtube2 = "https://youtu.be";
    $mystring = $request->youtube;
    if(strpos($mystring, $youtube1) !== false){
        $youtube = str_replace("https://www.youtube.com/watch?v=","https://www.youtube.com/embed/",$request->youtube);
    }
    else if(strpos($mystring, $youtube2) !== false){
        $youtube = str_replace("https://youtu.be","https://www.youtube.com/embed",$request->youtube);
    }else{
        $youtube = '';
    }
    

   if(isset($_FILES['avatar']['name'])){
   $file = basename($_FILES['avatar']['name']);
   
   $title = $request->title;
   $category_id = $request->category;
   $tmp_name = $_FILES['avatar']['tmp_name'];
   
   try{

       $image = $request->file('avatar');
       $file = basename($_FILES['avatar']['name']);
       
       //icon images resize
       $destinationPath = public_path('/web/media/icon');
       $img_icon = Image::make($image->path());
       $img_icon->resize(60, 60, function ($constraint) {
           $constraint->aspectRatio();
       })->save($destinationPath.'/'.$file);
       
       //xs images resize
       $destinationPath = public_path('/web/media/xs');
       $img_xs = Image::make($image->path());
       $img_xs->resize(150, 150, function ($constraint) {
           $constraint->aspectRatio();
       })->save($destinationPath.'/'.$file);
       
       //sm images resize
       $destinationPath = public_path('/web/media/sm');
       $img_sm = Image::make($image->path());
       $img_sm->resize(300, 300, function ($constraint) {
           $constraint->aspectRatio();
       })->save($destinationPath.'/'.$file);
       
       //md images resize
       $destinationPath = public_path('/web/media/md');
       $img_md = Image::make($image->path());
       $img_md->resize(600, 600, function ($constraint) {
           $constraint->aspectRatio();
       })->save($destinationPath.'/'.$file);        

       //lg images resize
       $destinationPath = public_path('/web/media/lg');
       $img_md = Image::make($image->path());
       $img_md->resize(1200, 1200, function ($constraint) {
           $constraint->aspectRatio();
       })->save($destinationPath.'/'.$file);        

       if($request->mul_images === 'null')
       {
          $mul_images = null;
       }else{
           $mul_images = $request->mul_images;
       }
         
       
       if($request->body[0] == '<' && $request->body[1] == 'p' && $request->body[2] == '>'  
       && $string[strlen($string)-1] == '>' && $string[strlen($string)-2] == 'p' && $string[strlen($string)-3] == '/'
       && $string[strlen($string)-4] == '<' ){
        //    return 'p tag';
            $body = $request->body;
        }else{
            $body = '<p>'.$request->body.'</p>';
        }

           $post = post::find($request->id);
           $post->category_id = $request->category;
           $post->title = $request->title;
           $post->subtitle =$request->subtitle;
           $post->youtube =$youtube;
           $post->body =$body;
           $post->slug =$slug;
           $post->type = 'bulletin';
           $post->image =$file;
           $post->mul_images = $mul_images ;
           $post->status = $request->status ;
           $post->admin_id = 1;
           
           $post->save();

           return response()->json('Bulleting Updated Succefully.');

           }
       catch(Exception $e){
       return response()->json('not uploaded'.$e);
           
        }
       }else{
           
       if($request->mul_images === 'null')
       {
          $mul_images = null;
       }else{
           $mul_images = $request->mul_images;
       }
        
       if($request->body[0] == '<' && $request->body[1] == 'p' && $request->body[2] == '>'  
       && $string[strlen($string)-1] == '>' && $string[strlen($string)-2] == 'p' && $string[strlen($string)-3] == '/'
       && $string[strlen($string)-4] == '<' ){
        //    return 'p tag';
            $body = $request->body;
        }else{
            $body = '<p>'.$request->body.'</p>';
        }
        
        $body = $request->body;

        $post = post::find($request->id);
        $post->category_id = $request->category;
        $post->title = $request->title;
        $post->subtitle =$request->subtitle;
        $post->body =$body;
        $post->youtube =$youtube;
        $post->slug =$slug;
        $post->type = 'bulletin';
        $post->mul_images =$mul_images;
        $post->admin_id = 1;
        $post->status = $request->status ;
        $post->save();

        return response()->json('Bulleting Updated Succefully.');

       }

//new

// $string =  $request->body;
//        if($request->body[0] == '<' && $request->body[1] == 'p' && $request->body[2] == '>'  
//             && $string[strlen($string)-1] == '>' && $string[strlen($string)-2] == 'p' && $string[strlen($string)-3] == '/'
//             && $string[strlen($string)-4] == '<' ){
//         //    return 'p tag';
//            $body = $request->body;
//        }else{
//             $body = '<p>'.$request->body.'</p>';
//        }

//         // return($request->avatar);
//         //  $slugCount = post::where('slug',$request->slug)->get()->count();
//         //  if($slugCount == 0){
//         //     $slug = $request->slug;
//         //  }else{
//         //     $slug = $request->slug.rand(1,100);
//         //  }
//         //  return $wordCount->count();
//         // if($_FILES['avatar']['name'] === null){
//         //     return response()->json('All Fields are Required');
//         // }else{
//         //     return ('file available'. $_FILES['avatar']['name'].'tmp - '. $_FILES['avatar']['tmp_name']);
//         // }

//     if(isset($_FILES['avatar']['name'])){
        
//     // $file = basename($_FILES['avatar']['name']);
//     // $title = $request->title;
//     // $category_id = $request->category;
//     // $tmp_name = $_FILES['avatar']['tmp_name'];
    
//     try{    
//         $image = $request->file('avatar');
//         $file = basename($_FILES['avatar']['name']);
        
//         //icon images resize
//         $destinationPath = public_path('/web/media/icon');
//         $img_icon = Image::make($image->path());
//         $img_icon->resize(60, 60, function ($constraint) {
//             $constraint->aspectRatio();
//         })->save($destinationPath.'/'.$file);
        
//         //xs images resize
//         $destinationPath = public_path('/web/media/xs');
//         $img_xs = Image::make($image->path());
//         $img_xs->resize(150, 150, function ($constraint) {
//             $constraint->aspectRatio();
//         })->save($destinationPath.'/'.$file);
        
//         //sm images resize
//         $destinationPath = public_path('/web/media/sm');
//         $img_sm = Image::make($image->path());
//         $img_sm->resize(300, 300, function ($constraint) {
//             $constraint->aspectRatio();
//         })->save($destinationPath.'/'.$file);
        
//         //md images resize
//         $destinationPath = public_path('/web/media/md');
//         $img_md = Image::make($image->path());
//         $img_md->resize(600, 600, function ($constraint) {
//             $constraint->aspectRatio();
//         })->save($destinationPath.'/'.$file);   
        
        
//        //lg images resize
//        $destinationPath = public_path('/web/media/lg');
//        $img_md = Image::make($image->path());
//        $img_md->resize(1200, 1200, function ($constraint) {
//            $constraint->aspectRatio();
//        })->save($destinationPath.'/'.$file);        
//        if($request->mul_images == 'null')
//         {
//            $mul_images = null;
//         }else{
//             $mul_images = $request->mul_images;
//         }
        
//         $youtube1 = "https://www.youtube.com/watch?v=";
//         $youtube2 = "https://youtu.be";
//         $mystring = $request->youtube;
//         if(strpos($mystring, $youtube1) !== false){
//             $youtube = str_replace("https://www.youtube.com/watch?v=","https://www.youtube.com/embed/",$request->youtube);
//         }
//         else if(strpos($mystring, $youtube2) !== false){
//             $youtube = str_replace("https://youtu.be","https://www.youtube.com/embed",$request->youtube);
//         }else{
//             $youtube = null;
//         }

//             $post = post::find($request->id);
//             // $post = new post;
//             $post->category_id = $request->category;
//             $post->title = $request->title;
//             $post->subtitle =$request->subtitle;
//             $post->youtube =$youtube;
//             $post->body =$body;
//             $post->slug =$request->slug;
//             $post->type = 'bulletin';
//             $post->image =$file;
//             $post->mul_images = $mul_images ;
//             $post->admin_id = 1;
//             $post->save();
//             // Notification::sendNotification($request->title, $request->subtitle, $request->slug, url('web').'/media/sm//'.$file);

//             return response()->json('New Post Bulleting Added...');

//             }
//         catch(Exception $e){
//         return response()->json('not uploaded'.$e);
            
//          }
//         }else{
//             return response()->json('Please Select Image');

//         }
  
   } 

    
   public function mobMediaDelete(Request $request){
    //    return($request->item);

        // $media = Media::find($request->id);
        if(File::exists(public_path('web').'/media/xs/'.$request->item)){
            
            unlink(public_path('web').'/media/lg/'.$request->item);
            unlink(public_path('web').'/media/md/'.$request->item);
            unlink(public_path('web').'/media/sm/'.$request->item);
            unlink(public_path('web').'/media/xs/'.$request->item);
            unlink(public_path('web').'/media/icon/'.$request->item);
            // $media->delete();
            
        $post = post::find($request->id);
        $post->mul_images = $request->mul_images;

        $post->save();
            return 'File Deleted Successfully...';
        }
        else{
            $post = post::find($request->id);
            $post->mul_images = $request->mul_images;
            $post->save();
            return 'Image Not Found...';
        }
}       

   public function mobMediaDeletePressnote(Request $request){
    //    return($request->item);

        // $media = Media::find($request->id);
        if(File::exists(public_path('web').'/media/xs/'.$request->item)){
            
            unlink(public_path('web').'/media/lg/'.$request->item);
            unlink(public_path('web').'/media/md/'.$request->item);
            unlink(public_path('web').'/media/sm/'.$request->item);
            unlink(public_path('web').'/media/xs/'.$request->item);
            unlink(public_path('web').'/media/icon/'.$request->item);
            // $media->delete();
            
        $pressnote = Pressnote::find($request->id);
        $pressnote->mul_images = $request->mul_images;

        $pressnote->save();
            return 'File Deleted Successfully...';
        }
        else{
            $pressnote = Pressnote::find($request->id);
            $pressnote->mul_images = $request->mul_images;
            $pressnote->save();
            return 'Image Not Found...';
        }
}   


public function mobMediaDeleteUnsaved(Request $request){
    // return($request->item);

     // $media = Media::find($request->id);
     if(File::exists(public_path('web').'/media/xs/'.$request->item)){
         unlink(public_path('web').'/media/lg/'.$request->item);
         unlink(public_path('web').'/media/md/'.$request->item);
         unlink(public_path('web').'/media/sm/'.$request->item);
         unlink(public_path('web').'/media/xs/'.$request->item);
         unlink(public_path('web').'/media/icon/'.$request->item);
         return 'File Deleted Successfully...';
     }
     else{
         return 'Image Not Found...';
     }
}
   public function uploadVideo(Request $request){
       
    $image = $request->file('videoFile');
    // $file = basename($_FILES['videoFile']['name']);
    return($_FILES['videoFile']['name']);
    
    return($request->all());
    

        // $media = Media::find($request->id);
        if(File::exists(public_path('web').'/media/xs/'.$request->item)){
            unlink(public_path('web').'/media/lg/'.$request->item);
            unlink(public_path('web').'/media/md/'.$request->item);
            unlink(public_path('web').'/media/sm/'.$request->item);
            unlink(public_path('web').'/media/xs/'.$request->item);
            unlink(public_path('web').'/media/icon/'.$request->item);
            return 'File Deleted Successfully...';
        }
        else{
            return 'Image Not Found...';
        }
}


    public function getPostDetail(Request $request){
        // return response()->json(DB::table('posts')->where('id',$request->id)->first());
        return response()->json(['message'=>'Fetched', 'status' => 0, 'post' => DB::table('posts')->where('id',$request->id)->first()]);
            

        // try {
        //     DB::table('posts')->where('id',$request->id)->first();
        //     return response()->json(['message'=>'Fetched', 'status' => 0, 'post' => DB::table('posts')->where('id',$request->id)->first()]);
        //     // return response()->json(['message'=>'Post Deleted', 'status' => 0, 'posts' => DB::table('posts')->orderBy('id','DESC')->get()]);
        //     // $queryStatus = "Successful";
        // } catch(Exception $e) {
        //     // $queryStatus = "Not success";
        //     return response()->json(['message'=>'Something Went Wrong!!!', 'status' => 1, 'post' =>null]);
        // }

        // return response()->json(DB::table('posts')->where('id',$request->id)->first());
    }
    
    public function getPressnoteDetail(Request $request){
        // return response()->json(DB::table('posts')->where('id',$request->id)->first());
        return response()->json(['message'=>'Fetched', 'status' => 0, 'post' => DB::table('pressnotes')->where('id',$request->id)->first()]);
            

        // try {
        //     DB::table('posts')->where('id',$request->id)->first();
        //     return response()->json(['message'=>'Fetched', 'status' => 0, 'post' => DB::table('posts')->where('id',$request->id)->first()]);
        //     // return response()->json(['message'=>'Post Deleted', 'status' => 0, 'posts' => DB::table('posts')->orderBy('id','DESC')->get()]);
        //     // $queryStatus = "Successful";
        // } catch(Exception $e) {
        //     // $queryStatus = "Not success";
        //     return response()->json(['message'=>'Something Went Wrong!!!', 'status' => 1, 'post' =>null]);
        // }

        // return response()->json(DB::table('posts')->where('id',$request->id)->first());
    }

    public function delPost(Request $request){

          $post = DB::table('posts')->where('id',$request->id)->first();
          $postCount = DB::table('posts')->where('id',$request->id)->get()->count();
            if($postCount){

            $total_mul_images = explode(',',$post->mul_images);
            if($post->mul_images !== null){
                
                foreach ($total_mul_images as $total_mul_image){                
                    if(File::exists(public_path('web').'/media/lg/'.$total_mul_image)){
                        unlink(public_path('web').'/media/lg/'.$total_mul_image);
                        unlink(public_path('web').'/media/md/'.$total_mul_image);
                        unlink(public_path('web').'/media/sm/'.$total_mul_image);
                        unlink(public_path('web').'/media/xs/'.$total_mul_image);
                        unlink(public_path('web').'/media/icon/'.$total_mul_image);
                    }
                }
            }          


          
          if(DB::table('posts')->where('id',$request->id)->count() > 0){
                if(File::exists(public_path('web').'/media/lg/'.$post->image)){
                    // return response()->json(['message'=>'222='.url('web'), 'status' => 0]);
                    unlink(public_path('web').'/media/lg/'.$post->image);
                    unlink(public_path('web').'/media/md/'.$post->image);
                    unlink(public_path('web').'/media/sm/'.$post->image);
                    unlink(public_path('web').'/media/xs/'.$post->image);
                    unlink(public_path('web').'/media/icon/'.$post->image);

                    DB::table('posts')->where('id',$request->id)->delete();
                    return response()->json(['message'=>'Post Deleted', 'status' => 0,

                     
                'categories' => DB::table('categories')->orderBy('id','DESC')->get(),
                'postList' => DB::table('posts')->whereNotIn('type',['bulletin'])->orderBy('id','DESC')->get(),
                'totalPosts'=> DB::table('posts')->whereNotIn('type',['bulletin'])->orderBy('id','DESC')->get()->count(),
                'bulletinList10' => DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->take(10)->get(),
                'bulletinList' => DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->get(),
                'pressnoteList' => DB::table('pressnotes')->orderBy('id','DESC')->get(),
                'totalPressnote' => DB::table('pressnotes')->get()->count(),
                'totalNews' => DB::table('posts')->whereNotIn('type',['bulletin'])->get()->count(),
                'totalBulletin' => DB::table('posts')->where('type','bulletin')->get()->count(),


                     ]);
                }else{
                    // return 'not';
                    DB::table('posts')->where('id',$request->id)->delete();
                    return response()->json(['message'=>'Post Deleted', 'status' => 0,

                'categories' => DB::table('categories')->orderBy('id','DESC')->get(),
                'postList' => DB::table('posts')->whereNotIn('type',['bulletin'])->orderBy('id','DESC')->get(),
                'totalPosts'=> DB::table('posts')->whereNotIn('type',['bulletin'])->orderBy('id','DESC')->get()->count(),
                'bulletinList10' => DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->take(10)->get(),
                'bulletinList' => DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->get(),
                'pressnoteList' => DB::table('pressnotes')->orderBy('id','DESC')->get(),
                'totalPressnote' => DB::table('pressnotes')->get()->count(),
                'totalNews' => DB::table('posts')->whereNotIn('type',['bulletin'])->get()->count(),
                'totalBulletin' => DB::table('posts')->where('type','bulletin')->get()->count(),


                     ]);
                }
          }else{
            return response()->json(['message'=>'Something Went Wrong!!!', 'status' => 1,
            
            'categories' => DB::table('categories')->orderBy('id','DESC')->get(),
            'postList' => DB::table('posts')->whereNotIn('type',['bulletin'])->orderBy('id','DESC')->get(),
            'totalPosts'=> DB::table('posts')->whereNotIn('type',['bulletin'])->orderBy('id','DESC')->get()->count(),
            'bulletinList10' => DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->take(10)->get(),
            'bulletinList' => DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->get(),
            'pressnoteList' => DB::table('pressnotes')->orderBy('id','DESC')->get(),
            'totalPressnote' => DB::table('pressnotes')->get()->count(),
            'totalNews' => DB::table('posts')->whereNotIn('type',['bulletin'])->get()->count(),
            'totalBulletin' => DB::table('posts')->where('type','bulletin')->get()->count(),

            
            ]);
          }
        }else{
            return 'post not found';
        }
    }
    
    
    public function delPressnote(Request $request){

        $post = DB::table('pressnotes')->where('id',$request->id)->first();
        $postCount = DB::table('pressnotes')->where('id',$request->id)->get()->count();
          if($postCount){

          $total_mul_images = explode(',',$post->mul_images);
          if($post->mul_images !== null){
              
              foreach ($total_mul_images as $total_mul_image){                
                  if(File::exists(public_path('web').'/media/lg/'.$total_mul_image)){
                      unlink(public_path('web').'/media/lg/'.$total_mul_image);
                      unlink(public_path('web').'/media/md/'.$total_mul_image);
                      unlink(public_path('web').'/media/sm/'.$total_mul_image);
                      unlink(public_path('web').'/media/xs/'.$total_mul_image);
                      unlink(public_path('web').'/media/icon/'.$total_mul_image);
                  }
              }
          }          


        
        if(DB::table('pressnotes')->where('id',$request->id)->count() > 0){
                  // return 'not';
                  DB::table('pressnotes')->where('id',$request->id)->delete();
                  return response()->json(['message'=>'Post Deleted', 'status' => 0,

              'categories' => DB::table('categories')->orderBy('id','DESC')->get(),
              'postList' => DB::table('posts')->whereNotIn('type',['bulletin'])->orderBy('id','DESC')->get(),
              'totalPosts'=> DB::table('posts')->whereNotIn('type',['bulletin'])->orderBy('id','DESC')->get()->count(),
              'bulletinList10' => DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->take(10)->get(),
              'bulletinList' => DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->get(),
              'pressnoteList' => DB::table('pressnotes')->orderBy('id','DESC')->get(),
              'totalPressnote' => DB::table('pressnotes')->get()->count(),
              'totalNews' => DB::table('posts')->whereNotIn('type',['bulletin'])->get()->count(),
              'totalBulletin' => DB::table('posts')->where('type','bulletin')->get()->count(),


                   ]);
        }else{
          return response()->json(['message'=>'Something Went Wrong!!!', 'status' => 1,
          'categories' => DB::table('categories')->orderBy('id','DESC')->get(),
          'postList' => DB::table('posts')->whereNotIn('type',['bulletin'])->orderBy('id','DESC')->get(),
          'totalPosts'=> DB::table('posts')->whereNotIn('type',['bulletin'])->orderBy('id','DESC')->get()->count(),
          'bulletinList10' => DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->take(10)->get(),
          'bulletinList' => DB::table('posts')->where('type','bulletin')->orderBy('id','DESC')->get(),
          'pressnoteList' => DB::table('pressnotes')->orderBy('id','DESC')->get(),
          'totalPressnote' => DB::table('pressnotes')->get()->count(),
          'totalNews' => DB::table('posts')->whereNotIn('type',['bulletin'])->get()->count(),
          'totalBulletin' => DB::table('posts')->where('type','bulletin')->get()->count(),

          
          ]);
        }
      }else{
          return 'post not found';
      }
            
    
  }

    
}
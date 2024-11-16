<?php
use App\Models\admin\Category;
use App\Models\admin\Slider;
use App\Models\admin\SocialMedia;
use App\Models\admin\EmailFilter;
use App\Models\admin\Media;
use Illuminate\Support\Facades\File;


// use File;

// dd(ini_get('post_max_size'));
function getMaxUploadSide(){
    // dd(ini_get('post_max_size'));
    $maxSize = ini_get('upload_max_filesize');
    return substr($maxSize, 0, -1) * 1000 -500;
}

function deleteSubCategoryImages($id){
    $medias = Media::where('media_id', $id)->get();
    foreach($medias as $media){
        deleteBulkImage($media->image);
    }
}

function deleteBulkImage($image){
    if(isset($image)){
        if(File::exists(public_path('/').'images/'.$image)){
            unlink(public_path('/').'images/'.$image);
          }

        
    }
}


function uploadAnyFile($request, $name, $saveName = null, $path = null){
    // dd($path);
    // echo $name;
    if($request->file($name)){
        $file = $request->file($name);
        $input['fileName'] = $saveName.'.'.$file->getClientOriginalExtension();

        $destinationPath = $path;
        
        $file->move($destinationPath, $input['fileName']);
        
        $fileName = $input['fileName'];
    }else{
        $fileName = null;
    }
    return $fileName;

}


function getCategory($id){

    return  DB::table('categories')->where('id', $id)->first();
}
    function deleteChildCategory($id){
    $checkCategory = DB::table('categories')->where('id', $id)->first();
    // dd($checkCategory);

    if(isset($checkCategory)){
        deleteBulkImage($checkCategory->image);
        DB::table('categories')->where('id', $id)->delete();
    }
}



function addEllipsis($string, $length, $end='…')
{
    if (strlen($string) > $length)
    {
        $length -= strlen($end);
        $string  = substr($string, 0, $length);
        $string .= $end;
    }
    return $string;
}
// Upload multiple images with thumbnails





// function uploadTinyImageThumb($request){
//     // dd($request->file('image'));

//     if($request->file('image')){
//         $image = $request->file('image');
//         // dd($image);
//         $input['imagename'] = time().'_'.rand(111,999).'.webp';
        
//        \Tinify\setKey(tinyPngKey());
//         // original
//         $source = \Tinify\fromFile($_FILES['image']['tmp_name']);
//         // $source->toFile($_FILES['image']['name']);
//         $source->toFile("web/media/lg/".$input['imagename']);
//         // $thumb = \Tinify\fromFile($_FILES['image']['tmp_name']);
        
//         // icon
//         $thumbIcon = $source->resize(array(
//             "method" => "fit",
//             "width" => 60,
//             "height" => 60
//         ));
//         $thumbIcon->toFile("web/media/icon/".$input['imagename']);

//         // xs
//         $thumbIcon = $source->resize(array(
//             "method" => "fit",
//             "width" => 150,
//             "height" => 150
//         ));
//         $thumbIcon->toFile("web/media/xs/".$input['imagename']);

//         // sm
//         $thumbIcon = $source->resize(array(
//             "method" => "fit",
//             "width" => 150,
//             "height" => 150
//         ));
//         $thumbIcon->toFile("web/media/sm/".$input['imagename']);

//         // md
//         $thumbIcon = $source->resize(array(
//             "method" => "fit",
//             "width" => 600,
//             "height" => 600
//         ));
//         $thumbIcon->toFile("web/media/md/".$input['imagename']);
//         $image_name = $input['imagename'];

//     }else{
//         $image_name = null;
//     }
//     return $image_name;
// }

function uploadImageThumb($request){

    if($request->file('image')){
        $image = $request->file('image');
        // dd($image);
        $input['imagename'] = time().'_'.rand(111,999).'.'.$image->extension();

        //icon image resize
        $destinationPath = public_path('/web/media/icon');
        $img_icon = Image::make($image->getRealPath());
        $img_icon->resize(60, 60, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
        
        //xs image resize
        $destinationPath = public_path('/web/media/xs');
        $img_xs = Image::make($image->getRealPath());
        $img_xs->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
        
        //sm image resize
        $destinationPath = public_path('/web/media/sm');
        $img_sm = Image::make($image->getRealPath());
        $img_sm->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
        
        //md image resize
        $destinationPath = public_path('/images');
        $img_md = Image::make($image->getRealPath());
        $img_md->resize(600, 600, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);

        //original image 
        $destinationPath = public_path('/web/media/lg');
        $image->move($destinationPath, $input['imagename']);
        $image_name = $input['imagename'];
    }else{
        $image_name = null;
    }

    
    return $image_name;
}



function today_date(){
    return date("d/m/Y");
}


function dateToDay($date){
    $now = \Carbon\Carbon::now()->format('Y-m-d H:s:i');
    
    $fromFormat = \Carbon\Carbon::parse($date)->format('Y-m-d H:s:i');

    $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $now);
    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $fromFormat);

    $diff_in_minutes = $from->diffInMinutes($to);
    return $diff_in_minutes;
}

function dateToDayCalculate($date){

    $now = \Carbon\Carbon::now()->format('Y-m-d H:s:i');
    $fromFormat = \Carbon\Carbon::parse($date)->format('Y-m-d H:s:i');

    $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $now);
    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $fromFormat);

    $diff_in_minutes = $from->diffInMinutes($to);
    
    if($diff_in_minutes == 0){
        return $diff_in_minutes. ' Minute Ago';
    }
    elseif($diff_in_minutes > 0 && $diff_in_minutes <= 59)
    {
        return $diff_in_minutes. ' Minutes Ago';
    }elseif($diff_in_minutes > 60){
        $hours = floor($diff_in_minutes / 60);

        if($hours <= 24){
            return $hours = floor($diff_in_minutes / 60).':'.($diff_in_minutes -   floor($diff_in_minutes / 60) * 60). ' Hours Ago';
        }else{
            return $days = floor($hours / 24). ' Days Ago';
        }

    }

}

function dateFormat($date, $format){
    return \Carbon\Carbon::parse($date)->format($format);
}

function dateFormatGujDay($date, $format){
    $day = \Carbon\Carbon::parse($date)->format($format);
    if($day == 'Monday'){
        return 'સોમવાર';
    }elseif($day == 'Tuesday'){
        return 'મંગળવાર';
    }elseif($day == 'Wednesday'){
        return 'બુધવાર';
    }elseif($day == 'Thursday'){
        return 'ગુરુવાર';
    }elseif($day == 'Friday'){
        return 'શુક્રવાર';
    }elseif($day == 'Saturday'){
        return 'શનિવાર';
    }else{
        return 'રવિવાર';
    }
}


function getStatusBgColor($status){
    if($status == 'pending'){
        return 'bg-warning';
    }elseif($status == 'processing'){
        return 'bg-info';
    }elseif($status == 'cancelled'){
        return 'bg-danger';
    }elseif($status == 'completed'){
        return 'bg-success';
    }else{
        return 'bg-default';
    }
}

function subCategoryCheckProduct($id){
// dd($id);
    $cat =  DB::table('categories')->where('parent_id', $id)->get();
    $check = DB::table('categories')
    ->join('products', 'products.category_id', '=', 'categories.id')
    
    ->get();
    // dd($check);
    
    // $check =  DB::table('categories')->where('category_id', $id)->get();
}

// function checkIsProductAvailable($category_id){
//     $check =  DB::table('products')->where('category_id', $category_id)->first();
//     if($check){
//         return true;
//     }else{
//         return false;
//     }
// }


function getStatusBadgeColor($status){
    if($status == 'pending'){
        return 'badge bg-warning';
    }elseif($status == 'processing'){
        return 'badge bg-info';
    }elseif($status == 'cancelled'){
        return 'badge bg-danger';
    }elseif($status == 'completed'){
        return 'badge bg-success';
    }else{
        return 'badge bg-default';
    }
}

function getStatusTextColor($status){
    if($status == 'pending'){
        return 'text-warning';
    }elseif($status == 'processing'){
        return 'text-info';
    }elseif($status == 'cancelled'){
        return 'text-danger';
    }elseif($status == 'completed'){
        return 'text-success';
    }else{
        return 'text-default';
    }
}

function test1(){
    dd('testing helper');
}

function checkEmailFilter(){
    return EmailFilter::first();
}

function sendMailNotification(string $type = "", string $to = 'sales@giantinflatables.in', string $title = "", array $data = []){
// return $data['email'];
    $user['to'] = $to;
    $user['email'] = $data['email'];
    $user['name'] = $data['name'];

    switch ($type) {
        case 'contact_inquiry':
            $user['subject']  = $data['name'].' has contacted Giant Inflatables';
            break;
        
            case 'enquire':
                $user['subject']  = $data['name'].' has contacted Giant Inflatables';
                $user['formView'] = 'mail/send-inquiry';
                break;
            
        default:
            $user['subject']  = 'Admin Mailer - '. $data['name'];
            $user['formView'] = 'mail/send-notification';
            break;
    }
if($type == 'enquire'){
    $formView = 'mail/send-inquiry';
}else{
    $formView = 'mail/send-notification';
}



try{
    Mail::send('mail/thankyou-notification', $data, function($message) use ($user){
        $message->from('sales@giantinflatables.in', 'Giant Inflatables Asia');
        $message->to($user['email']);
        $message->subject('Thank you for contacting us.');
        $message->replyTo($user['to']);
    });

    Mail::send($formView, $data, function($message) use ($user){
        $message->from('sales@giantinflatables.in', 'Giant Inflatables Asia');
        $message->to('sales@giantinflatables.in');
        $message->subject($user['subject']);
        $message->replyTo($user['email']);
        
        $message->bcc(['myalivecreate@gmail.com']);

        $message->bcc(['krutarth@live.com', 'prakash@thestudio5.com.au',
        'myalivecreate@gmail.com', 'krishna@thestudio5.com.au']);
    
    
        // $message->bcc(['krutarth@live.com', 'sales@giantinflatables.in', 'david@giantinflatables.com.au',
        // 'discuss@searchmediabroker.com', 'mikael@giantinflatables.com.au', 'prakash@thestudio5.com.au']);
    
    });

}catch(\Exception $e){

    Mail::send($formView, $data, function($message) use ($user){
        $message->to($user['to']);
        $message->subject($user['subject']);
        $message->replyTo($user['email']);
    });
    
//Below code is for email errors
    // Mail::send('mail/failed-mail', $data, function($message) use ($user){
    //     $message->to($user['to']);
    //     $message->subject('Alert - Invalid form entry.');
    // });

    return 'err';
}


}
    
function getParent($id){

    $category = Category::find($id);
    if($category == null){
        return ['parent_id' => 0];
    }else{
        return $category;
    }
}


function getReffrel(){
    if (isset($_SERVER['HTTP_REFERER'])) {
        $link = $_SERVER['HTTP_REFERER'];
        $explodedLink = explode('/', $_SERVER['HTTP_REFERER']);

        $slug = end($explodedLink);
        $category = DB::table('categories')->where('slug', $slug)->first();

        if(isset($category)){
            // dd($category);
            if($category->name){
                $name = $category->name;
            }
            else{
                $name = null;
            }
            return ['name' => $name, 'url' => $link];
            
            // dd(['name' => $category->name, 'url' => $link]);

        }
        else{
            if($slug == 'about'){        
                return ['name' => 'About Us', 'url' => $link];
            }elseif($slug == 'about'){   
                return ['name' => 'About Us', 'url' => $link];
            }elseif($slug == 'products' || $slug == 'products'){   
                return ['name' => 'INDUSTRIAL INFLATABLE PRODUCTS', 'url' => $link];
            }
            elseif($slug == 'testimonials'){
                return ['name' => 'Testimonials', 'url' => $link];
            }
            elseif($slug == 'videos'){   
                return ['name' => 'Videos', 'url' => $link];
            }
            elseif($slug == 'contact-us'){   
                return ['name' => 'Contact Us', 'url' => $link];
            }
            elseif($slug == 'blog'){   
                return ['name' => 'Blog', 'url' => $link];
            }
            elseif($slug == 'blog'){   
                return ['name' => 'Blog', 'url' => $link];
            }
            elseif($slug == 'case-studies'){   
                return ['name' => 'Case Studies', 'url' => $link];
            }
            elseif($slug == 'updates'){   
                return ['name' => 'Updates', 'url' => $link];
            }
            elseif($slug == 'client'){   
                return ['name' => 'client', 'url' => $link];
            }
            elseif($slug == 'awards'){   
                return ['name' => 'awards', 'url' => $link];
            }
            elseif($slug == 'videos'){   
                return ['name' => 'videos', 'url' => $link];
            }
            elseif($slug == 'news-letters'){   
                return ['name' => 'NEWSLETTERS', 'url' => $link];
            }
            elseif($slug == 'partenrs'){   
                return ['name' => 'partenrs', 'url' => $link];
            }
            else {
                return null;
            }
        }
    }

}

function getParentCategory($id){
    $category = Category::find($id);

    if(isset($id)){
        if(isset($category->parent_id) && $category->parent_id == 0){
            return (['category'=>$category, 'subcategory' => null, 'subcategory2' => null]);
        }
        else{
            $subcategory = Category::find($category['parent_id']);
            if(isset($subcategory)){
                if($subcategory->parent_id == 0){
                    return (['category'=>$subcategory, 'subcategory' => $category, 'subcategory2' => null]);
                }else{
                $subcategory2 = Category::find($subcategory->parent_id);
                    return(['category'=>$subcategory2, 'subcategory' => $subcategory, 'subcategory2' => $category]);
                }
            }else{
                return (['category'=>$subcategory, 'subcategory' => $category, 'subcategory2' => null]);
            }
        }
    }else{
        return(['category'=>null, 'subcategory' => null, 'subcategory2' => null]);
    }
}


// function getParentCategory($id){
//     $category = Category::find($id);

//     if(isset($id)){
//         if($category->parent_id == 0){

//             return (['category'=>$category, 'subcategory' => null, 'subcategory2' => null]);

//         }
//         else{
//             $subcategory = Category::find($category->parent_id);
//             if($subcategory->parent_id == 0){
//                 return (['category'=>$subcategory, 'subcategory' => $category, 'subcategory2' => null]);
//             }else{
//             $subcategory2 = Category::find($subcategory->parent_id);
//                 return(['category'=>$subcategory2, 'subcategory' => $subcategory, 'subcategory2' => $category]);
//             }
//         }
//     }else{
//         return(['category'=>null, 'subcategory' => null, 'subcategory2' => null]);
//     }
// }

function getChildCategory($id){
    // $check
    $category = Category::find($id);
    if(isset($id)){
        if($category->parent_id == 0){

            return (['category'=>$category, 'subcategory' => null, 'subcategory2' => null]);

        }
        else{
            $subcategory = Category::find($category->parent_id);
            if($subcategory->parent_id == 0){
                return (['category'=>$subcategory, 'subcategory' => $category, 'subcategory2' => null]);
            }else{
            $subcategory2 = Category::find($subcategory->parent_id);
                return(['category'=>$subcategory2, 'subcategory' => $subcategory, 'subcategory2' => $category]);
            }
        }
    }else{
        return(['category'=>null, 'subcategory' => null, 'subcategory2' => null]);
    }
}

function getChildCategoryCount($id, $type){
    if($type == 'image'){
        if(Category::where('parent_id',2)->count() == 0){
            return false;
        }else{
            return true;
        }
    }
    elseif($type == 'childcategory|image'){
        
        $subCategories = DB::table('categories')
        ->join('media', 'media.media_id', '=', 'categories.id')
        ->where(['categories.parent_id' => $id, 'categories.status' => 1])
        ->orderBy('media.id', 'DESC')->count();
        // dd($subCategories);

        if($subCategories == 0){
            return false;
        }else{
            return true;
        }
    }
}


function getActiveChildCategoryWithImage($id, $type){
    if($type == 'image'){
        if(Category::where('parent_id',2)->count() == 0){
            return false;
        }else{
            return true;
        }
    }
    elseif($type == 'childcategory|image'){
        
        // $subCategories = DB::table('categories')
        // ->join('media', 'media.media_id', '=', 'categories.id')
        // ->where(['categories.parent_id' => $id, 'categories.status' => 1])
        // ->select('categories.*')
        // ->orderBy('media.id', 'DESC')->get();
        

        // dd($subCategories);

        if($subCategories == 0){
            return false;
        }else{
            return true;
        }
    }
}


function getMainCategory($id){
    $isMain = Category::where('id',$id)->first();
    if($isMain->parent_id == 0){
        return ['mainCat' => Category::where('id',$id)->first()];
    }else{
        $subCat = Category::where('id',$id)->first();
        $mainCat = Category::where('id',$subCat->parent_id)->first();
        return ['mainCat' => $mainCat, 'subCat' => $subCat];
    }
}

function getTableData($table, $id){
    return DB::table($table)->where('id', $id)->first();
}

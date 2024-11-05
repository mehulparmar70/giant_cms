<?php
use App\Models\admin\TaskComment;
use App\Models\admin\Category;
use App\Models\admin\SocialMedia;
use App\Models\admin\Product;
use App\Models\admin\Blog;
use App\Models\admin\Testimonials;
use App\Models\admin\Video;
use App\Models\admin\CustomCode;
use App\Models\admin\WebsiteOption;
use App\Models\admin\UrlList;
use App\Models\admin\CriteriaMeta;
use App\Models\admin\Media;


// use Illuminate\Support\Facades\DB;

function getWebsiteOptions(){

    $data = [
        'website_logo' =>  WebsiteOption::where('option_name', 'logo')->first(),
        'website_favicon' =>  WebsiteOption::where('option_name', 'favicon')->first(),
    ];   
    return $data; 
}

function getImagesFromSubCategory($id){

    $productId = DB::table('categories')->where('id', $id)->first();
    
    if(isset($productId)){
        return Media::where('media_id', $productId->id)->orderBy('item_no','asc')->get();
    }else{
        return [];
    }
    
}
function getImages($id){

    $productImages = Media::where('media_id', $id)->orderBy('item_no','asc')->get();
    
    if(isset($productImages)){
        return $productImages;
    }else{
        return [];
    }
    
}

function getMainCategoryFromSubCategory($parent_id){
    return DB::table('categories')->where('id', $parent_id)->first();
}

function checkIsProductAvailable($id){
    return  DB::table('products')->whereNotIn('categories', $id);
  }
  
  function getSubCategoryImages($id, $limit=0, $order = 'DESC'){
    if($limit == 0){
        return Media::where('media_id', $id)->orderBy('item_no')->orderBy('id', 'DESC')->get();
    }
    else{
        return Media::where('media_id', $id)->limit($limit)->orderBy('item_no')->get();
    }
}


function getProductImages($id, $limit=0, $order = 'asc'){
    
    if($limit == 0){
        return Media::where('image_type', 'product')->where('media_id', $id)->orderBy('id',$order)->get();
    }else{
        return Media::where('image_type', 'product')->where('media_id', $id)->limit($limit)->orderBy('id',$order)->get();
    }
}

function getSeoOptions(){

    $data = [
        'website_logo' =>  WebsiteOption::where('option_name', 'logo')->first(),
        'website_favicon' =>  WebsiteOption::where('option_name', 'favicon')->first(),
    ];   
    return $data; 
}

function getImageFromCategory($id){
    $subCategories = DB::table('categories')
    ->join('media', 'media.media_id', '=', 'categories.id')
            
    ->where(['categories.parent_id' => $id])
    ->orderBy('categories.id', 'ASC')->get();
    
    
    // dd($subCategories);
    return  $subCategories;

}

function getProductImageFromCategory($id, $limit){
    $subCategories = DB::table('categories')
    ->join('products', 'products.category_id', '=', 'categories.id')
    ->join('media', 'media.media_id', '=', 'products.id')
            
    ->where(['categories.parent_id' => $id])
    ->orderBy('media.id', 'DESC')->limit(8)->get();
    
    
    // dd($subCategories);
    return  $subCategories;

}



function getItemCount(){
    $data = [
        'totalMainCategories' => Category::where('parent_id', 0)->count(),
        
        'totalSubCategories' => Category::whereNotIn('parent_id', [0])->count(),
        
        'totalProducts' => Product::count(),
        'totalBlogs' => Blog::count(),
        'totalTestimonials' => Testimonials::count(),
        'totalVideos' => Video::count(),
        'totalVideos' => Category::count(),
    
    ];
    return $data;
}


function getCustomCode(){
    // TaskComment::where('admin_id', session('LoggedUser')->id);session('LoggedUser')->id
    
    $data = [
        'headerJs' =>  CustomCode::where('type', 'header-code')->first(),
        'footerJs' =>  CustomCode::where('type', 'footer-code')->first()
    ];

    return $data;
}

function getFooterLinks(){
    
    $categoryLinks = DB::table('url_list')
    ->join('categories', 'categories.id', '=', 'url_list.item_id')
    ->where(['url_list.type' => 'category_link', 'categories.status'=>1, 'url_list.status' => 1])
    ->select('categories.name as name', 'url_list.name as display_name', 'categories.slug as slug',
            'url_list.item_id as item_id')
    ->orderBy('url_list.item_no')->limit(8)->get();
    
    $productLinks = DB::table('url_list')
    ->join('products', 'products.id', '=', 'url_list.item_id')
    ->where(['url_list.type' => 'product_link', 'products.status'=>1, 'url_list.status' => 1])
    ->select('products.name as name', 'url_list.name as display_name', 'products.slug as slug',
            'url_list.item_id as item_id')
    ->orderBy('url_list.item_no')->limit(8)->get();
   

    $blogLinks = DB::table('blogs')
    ->where(['status'=>1])
    ->orderBy('item_no')->limit(8)->get();

    $testimonialLinks = DB::table('testimonials')
    ->where(['status'=>1])
    ->orderBy('item_no')->limit(8)->get();

    // $blogLinks = DB::table('url_list')
    // ->join('blogs', 'blogs.id', '=', 'url_list.item_id')
    // ->where(['url_list.type' => 'blog_link', 'blogs.status'=>1, 'url_list.status' => 1])
    // ->select('blogs.title as name', 'url_list.name as display_name', 'blogs.slug as slug',
    //         'url_list.item_id as item_id')
    // ->orderBy('url_list.item_no')->limit(8)->get();
    

    // $testimonialLinks = DB::table('url_list')
    // ->join('testimonials', 'testimonials.id', '=', 'url_list.item_id')
    // ->where(['url_list.type' => 'testimonial_link', 'testimonials.status'=>1, 'url_list.status' => 1])
    // ->select('testimonials.title as name', 'url_list.name as display_name', 'testimonials.slug as slug',
    //         'url_list.item_id as item_id')
    // ->orderBy('url_list.item_no')->limit(8)->get();


    // $testimonialLinks = DB::table('url_list')
    // ->join('testimonials', 'testimonials.id', '=', 'url_list.item_id')
    // // ->where(['url_list.type' => 'testimonial_link'])
    // ->where(['url_list.type' => 'testimonial_link', 'testimonials.status'=>1, 'url_list.status' => 1])
    // ->select('testimonials.title as name', 'url_list.name as display_name', 'testimonials.slug as slug',
    //         'url_list.item_id as item_id')

    // ->orderBy('url_list.item_no')->limit(8)->get();



    $data = [
        'pageLinks' =>  UrlList::where(['type' => 'page_link', 'status' => 1])->orderBy('item_no')->get(),
        'categoryLinks' =>  $categoryLinks,
        'productLinks' =>  $productLinks,
        'blogLinks' =>  $blogLinks,
        'testimonialLinks' =>  $testimonialLinks
    ];
    return $data;


}

function getTaskComments(){
    // TaskComment::where('admin_id', session('LoggedUser')->id);session('LoggedUser')->id
    
    $taskComments = DB::table('task_comments')
        ->join('task_assign', 'task_assign.id', '=', 'task_comments.task_assign_id')
        ->join('admins', 'admins.id', '=', 'task_comments.admin_id')
        ->join('task_status', 'task_status.task_assign_id', '=', 'task_comments.task_assign_id')
        ->join('status', 'status.id', '=', 'task_status.status_id')
        ->select('task_assign.id as task_assign_id', 'task_assign.description as task_assign_description',
                'admins.name as admin_name', 'task_assign.description as task_assign_description',
                'task_comments.comment as comment', 'task_comments.seen as comment_seen',
                'task_comments.seen_time as comment_seen_time', 'task_comments.type as comment_type',
                'task_comments.created_at as comment_created_at',
                'status.name as status_name', 'admins.image as admin_image'

            )
        ->where('task_comments.admin_id', '!=', session('LoggedUser')->id)
        ->where(['task_comments.seen' => 0])
        ->orderBy('task_comments.id', 'DESC')
        ->get();
    return $taskComments;
}

function getTaskAssign(){
    $taskAssign = DB::table('task_assign')
        ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
        ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
        ->join('categories', 'categories.id', '=', 'tasks.category_id')

        ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
                'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
                'task_assign.created_at as task_created_at','tasks.name as task_name'

            )
        ->where('task_assign.admin_id', session('LoggedUser')->id)
        ->where(['task_assign.seen' => 0])
        ->orderBy('task_assign.id', 'DESC')

        ->get();

    return $taskAssign;
}



function checkIfCriteriaMetaDataDeleted($id, $table){

    // dd($id);

   $criteriaMeta = CriteriaMeta::whereRaw($table, [$id])->get();
   
//    $criteriaMeta = CriteriaMeta::whereRaw('categories', [270])->get();

//    dd($criteriaMeta);
//    $products = CriteriaMeta::all();

//    $products = DB::table($table)->where('id', $categoryArr)->count();
    // print_r($criteriaMeta);

    // dd($products);
    // echo 'helper';
    $arr = array();
    $res = array();
    
    if($table == 'categories'){
        if(sizeof($res) == 0){
            $criteriaMeta->categories = null;
        }else{
            $criteriaMeta->categories = implode(",",$res);
        }
    } 
    elseif($table == 'products'){

        if(sizeof($res) == 0){
            $criteriaMeta->products = null;
        }else{
            $criteriaMeta->products = implode(",",$res);
        }
    }

}

function checkIfCriteriaMetaDataAvailable($id, $list, $table){

    $categoryArrs = explode(',', $list);
    $arr = array();
    $res = array();
    
    foreach($categoryArrs as $categoryArr){
         $check = DB::table($table)->where('id', $categoryArr)->count();
         $checkRes = DB::table($table)->where('id', $categoryArr)->first();
            if( $check != 0 ){  
                $res[] = $checkRes->id; 
            }
    }
    $criteriaMeta = CriteriaMeta::where('id',$id)->first();
    if($table == 'categories'){

        if(sizeof($res) == 0){
            $criteriaMeta->categories = null;
        }else{
            $criteriaMeta->categories = implode(",",$res);
        }
    } 
    elseif($table == 'products'){

        if(sizeof($res) == 0){
            $criteriaMeta->products = null;
        }else{
            $criteriaMeta->products = implode(",",$res);
        }
    }
    $criteriaMeta->save();
    
}

function getTaskStatus($id){

    $taskStatus = DB::table('status')->where('id', $id)->first();
    return $taskStatus;
}


function getSocialMedia(){
    $data = SocialMedia::first();
    return $data;
}

function checkSlug($category, $slug){
    
    
    
    $checkSlugProduct = Product::where('slug', $slug)->first();
    $checkSlugCategory = Category::where('slug', $slug)->first();
    
    if($checkSlugProduct){
        // return 'product'.$allCategory;
        return $checkSlugProduct;
    }
    elseif($checkSlugCategory){
        
        $isExistParentCategory = Category::where('parent_id', $checkSlugCategory->id)->first();
            if($isExistParentCategory){
                
                return ['isExistParentCategory' => 'true', 'data' => $checkSlugCategory];
        }else{
            $productList = Product::where('category_id', $checkSlugCategory->id)->get();
            return ['isExistParentCategory' => 'false', 'data' => $productList];
        }
    }
    else{
        $allCategory = Category::where('slug', $slug)->get();
    
        return 'all category'.$allCategory;
    }


}

function getCategoryData($id){
    return DB::table('categories')->where(['id' => $id, 'status' => 1])->first();
}

function getProductData($id){
    return DB::table('products')->where('id', $id)->first();
}


function getCategoryTreeData($parent_id){
    // dd($parent_id);
    $catArray = [];
    $cat =  DB::table('categories')->where('id', $parent_id)->orderBy('name', 'DESC')->first();
    $catArray[] = $cat;
    $cats1 =  DB::table('categories')->where('parent_id', $parent_id)->orderBy('name', 'DESC')->get();
    foreach($cats1 as $cat1){
  
      $catArray[] = $cat1;
      
      $cats2 =  DB::table('categories')->where('parent_id', $cat1->id)->orderBy('name', 'DESC')->get();
      if(isset($cats2)){
        foreach($cats2 as $cat2){
          $catArray[] = $cat2;
        }
      }
    }
    return $catArray;
}


function getMainCategories($skip = 0, $limit = null){
    $catArray = [];
    $cats1 =  DB::table('categories')->where('parent_id', 0)->orderBy('item_no', 'ASC')->orderBy('id', 'DESC')->get();
    foreach($cats1 as $cat1){
      $cats2 =  DB::table('categories')->where('parent_id', $cat1->id)->orderBy('item_no', 'ASC')->orderBy('id', 'DESC')->get();
   
      if(count($cats2) > 0){
        foreach($cats2 as $cat2){
            $medias = Media::where('media_id', $cat2->id)->get();
            if(count($medias) > 0){
                $catArray[] = $cat1;
                break;
            }
        }
      }
    }
    return $catArray;
    

    if(isset($limit)){
        // Category::where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->get()
        return DB::table('categories')->where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->orderBy('id', 'DESC')
        ->limit($limit)->select('id','name','slug')->get();
    }else{
        return DB::table('categories')->where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->orderBy('id', 'DESC')
        ->select('id','name','slug')->get();
    }

}

function customMainCat($skip = 0, $limit = null){
    $catArray = [];
    $cats1 =  DB::table('categories')->where('parent_id', 0)->where('status', 1)->orderBy('item_no', 'ASC')->orderBy('id', 'DESC')->get();
    foreach($cats1 as $cat1){
      $catArray[] = $cat1;
    }
    return $catArray;
}


function getSubCategoriesWithImage($id){
    $subCategoryArr = [];

    $subCategories = DB::table('categories')
    ->where(['parent_id' => $id, 'status' => 1])
    ->get();
    foreach($subCategories as $subCategory){
        $isMedia = DB::table('media')->where('media_id', $subCategory->id)->first();
        if(isset($isMedia)){
            $subCategoryArr = $subCategory;
        }else{
            $subCategoryArr = null;
        }
    }
    return $subCategoryArr;
}

function getSubCategories($id, $limit = null){
    $catArray = [];
    $cats1 =  DB::table('categories')->where('parent_id', $id)->orderBy('item_no', 'ASC')->orderBy('id', 'DESC')->limit($limit)->get();
    foreach($cats1 as $cat1){
   
      if(isset($cat1)){
            $medias = Media::where('media_id', $cat1->id)->get();
            if(count($medias) > 0){
                $catArray[] = $cat1;
            }
      }
    }
    // dd($catArray);
    return $catArray;
}

function getCustomSubCategories($id, $limit = null){
    $catArray = [];
    $cats1 =  DB::table('categories')->where('parent_id', $id)->where('status', 1)->orderBy('item_no', 'ASC')->orderBy('id', 'DESC')->limit($limit)->get();
    foreach($cats1 as $cat1){
      $catArray[] = $cat1;
    }
    // dd($catArray);
    return $catArray;
}

function getAllSubCategories($id){
    return Category::where(['parent_id' => $id, 'status' => 1])->get();
 }

function getTableFromType($type){
        
    switch ($type) {
        case 'testimonial_link':
            $table = 'testimonials';
            break;
        case 'video_link':
            $table = 'videos';
            break;
            
        case 'category_link':
            $table = 'categories';
        break;
        
        case 'blog_link':
            $table = 'blogs';
        break;
        
        case 'product_link':
            $table = 'products';
        break;

        default:               
            return 'something went wrong, wrong table';
        break;

}
return $type;
}

function deleteUrlList($id, $type){
    
    DB::table('url_list')->where(['id' => $id, 'type' => getTableFromType($type)]);
}

function deleteTableUrlData($id, $type ){
    // dd($id);
    
    DB::table('url_list')->where(['item_id' => $id, 'type' => $type])->delete();
}
    
function checkProductIsEXist($id){
    $products = DB::table('products')->where('category_id', $id)->get();
    // dd($products);
    if($products){
     foreach($products as $product){
        deleteBulkImage($product->image);
         $del = DB::table('products')->where('id', $product->id)->delete();
     }
    }else{

    }
 }

 function deleteCategoryMedia($image){
    
 }

 function getDataObjects($table, $limit, $order){
    return DB::table($table)->orderBy('id', $order)->limit($limit)->get();
 }
 

function getPageData($type){
    return DB::table('pages')->where('type', $type)->first();
}
function getProductUrl($id){
    $url1 = DB::table('categories')->where('id', $id)->first();
    // dd($url1);
    if($url1->parent_id == 0 && $url1->parent_id == null){
        return $url1->slug;
    }
    else{
        $url2 = DB::table('categories')->where('id', $url1->parent_id)->first();
        if($url2->parent_id == 0 && $url2->parent_id == null){
            return $url2->slug.'/'.$url1->slug;
        }
        else{
            $url3 = DB::table('categories')->where('id', $url2->parent_id)->first();

            if(isset($url3)){
                return $url3->slug.'/'.$url2->slug.'/'.$url1->slug;
            }else{
                return $url3->slug.'/'.$url2->slug.'/'.$url1->slug;
            }

        }
    }
    return DB::table('products')->where('id', $id)->first();
}

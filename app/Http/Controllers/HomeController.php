<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Slider;
use App\Models\admin\TopInflatables;
use App\Models\admin\UrlList;
use App\Models\admin\Pages;
use App\Models\admin\Video;
use App\Models\admin\Blog;
use App\Models\admin\Testimonials;
use App\Models\admin\Industries;
use App\Models\admin\Partners;
use App\Models\admin\Client;
use App\Models\admin\CaseStudies;
use App\Models\admin\Product;
use App\Models\admin\Media;
use App\Models\admin\Category;
use App\Models\admin\CriteriaMeta;
use App\Models\admin\Criteria;
use App\Models\admin\Award;
use App\Models\admin\Newsletter;
use Illuminate\Support\Str;
use Session;
use DB;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
            
        $this->footerTestimonial = testimonials::where(['status' => 1])->orderBy('item_no')->orderBy('id','DESC')->first();
        
        $this->footerVideo = Video::where(['status' => 1])->orderBy('item_no')->first();
        $this->footerBlog = Blog::where(['status' => 1])->orderBy('id','DESC')->orderBy('id','DESC')->first();

        $this->footerCategories = Category::where(['parent_id'=>0, 'status' => 1])->orderBy('id','DESC')->limit(8)->get();
        $this->footerCaseStudies = CaseStudies::where(['status' => 1])->orderBy('id','DESC')->limit(8)->get();
        $this->footerProducts= Product::where(['status' => 1])->orderBy('id','DESC')->limit(8)->get();
        $this->footerBlogs = Blog::where(['status' => 1])->orderBy('id','DESC')->orderBy('id','DESC')->limit(8)->get();
        $this->footerAllProduct = Category::where(['parent_id'=>0, 'status' => 1])->orderBy('id','DESC')->limit(8)->get();

        $this->footerTestimonials = testimonials::orderBy('item_no')->limit(8)->get();
        $this->footerOurPartners = Partners::orderBy('item_no')->limit(8)->get();
        
        $this->parent_categories = Category::where(['parent_id'=>0])->orderBy('id','DESC')->get();
        $this->topCategories = Category::where(['parent_id'=>0])->orderBy('id','DESC')->limit(10)->get();
        $this->topCategories1 = Category::where(['parent_id'=>0])->orderBy('id','DESC')->skip(0)->take(5)->get();
        $this->topCategories2 = Category::where(['parent_id'=>0])->orderBy('id','DESC')->skip(5)->take(10)->get();
        
        $this->criteriaMetas = DB::table('criteria_metas')
                ->join('criterias', 'criterias.id', '=', 'criteria_metas.criteria_id')
                ->whereNotNull('criteria_metas.categories')
                ->where(['criteria_metas.status'=>1, 'criterias.status'=>1])

                ->select('criteria_metas.id as id', 'criteria_metas.categories as categories',
                'criterias.title as name', 'criterias.slug as slug', 'criteria_metas.criteria_id as criteria_id', 
                 'criteria_metas.status as status')
                ->orderBy('criteria_metas.item_no')->take(10)->get();
                
        $AllActiveMainCategories = 
            Category::where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->get();
        
        foreach($AllActiveMainCategories as $AllActiveMainCategory){
            $subCatWithImages = DB::table('categories')->where('parent_id', $AllActiveMainCategory->id)->first();    
        }
    

        $this->topInflatables1 = Category::where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->skip(0)->take(3)->get();
        $this->topInflatables2 = Category::where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->skip(3)->take(3)->get();
        $this->topInflatables3 = Category::where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->skip(6)->take(3)->get();
        $this->topInflatables4 = Category::where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->skip(9)->take(3)->get();
        
        $this->topInflatableAll = $AllActiveMainCategories;

        $isYoutubeSlider = Slider::orderBy('slider_no')->where('status', 1)->first();

        if(isset($isYoutubeSlider->youtube_embed)){
            $this->sliders = Slider::orderBy('slider_no')->where('status', 1)->first();
        }else{
            $this->sliders = Slider::orderBy('slider_no')->where('status', 1)->get();
        }

    }

    
    public function index()
    {
        
        $data = [
            'criteriaMetas' => $this->criteriaMetas,
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'sliders' =>   $this->sliders,
            'slider' =>   Slider::orderBy('slider_no')->first(),

            'topInflatables1' =>  $this->topInflatables1,
            'topInflatables2' =>  $this->topInflatables2,
            'topInflatables3' =>  $this->topInflatables3,
            'topInflatables4' =>  $this->topInflatables4,

            'topInflatableAll' =>  $this->topInflatableAll,
            'testimonials' =>  Testimonials::where(['status' => 1])->orderBy('item_no')->orderBy('id','DESC')->limit(50)->get(),
            'blogsSlider' => Blog::where('status', 1)->limit(5)->orderBy('item_no')->get(),
            'industries' =>  Industries::where(['status' => 1])->orderBy('id','DESC')->orderBy('item_no','ASC')->limit(50)->get(),
            'homeUrls1' =>  UrlList::where('type', 'home_url1')->where('status',1)->get(),
            'homeAbout' =>  Pages::where('type', 'home_page')->first(),
            'productTitle' =>  Pages::where('type', 'product_page')->first(),
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->orderBy('id','DESC')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->orderBy('id','DESC')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->orderBy('id','DESC')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->orderBy('id','DESC')->get(),
            'pageData' =>  Pages::where('type', 'home_page')->first(),
            'aboutPageData' =>  Pages::where('type', 'about_page')->first(),
            'topCategories' => $this->topCategories,
            // 'topInflatables' => TopInflatables::where('status', 1)->orderBy('item_no')->skip(0)->take(5)->get(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,

            
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];
        
        return response()->view('index', $data, 200)->header('Cache-Control:public', 'max-age=31536000');

    }
    public function product(Request $request)
    {
        //Session::forget('homePageCatId');
        $searach_criteria = $request->inflatable;
        // dd($searach_criteria);
        
        $criteriaData = Criteria::where('slug', $searach_criteria)->first();

        if($searach_criteria){
            $searchData = CriteriaMeta::where('criteria_id', $criteriaData->id)->first();
        }else{
            $searchData = null;
        }

        $data = [
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'criteriaData' => $criteriaData,
            'criteriaMetaData' => $searchData,
            'criteriaMetas' => $this->criteriaMetas,
            'searchData' => $searchData,
            'testimonials' =>  Testimonials::where(['status' => 1])->orderBy('item_no')->orderBy('id','DESC')->limit(50)->get(),
            'pageData' =>  Pages::where('type', 'product_page')->first(),
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'blogsSlider' => Blog::where('status', 1)->limit(5)->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'topInflatables1' =>  $this->topInflatables1,
            'topInflatables2' =>  $this->topInflatables2,
            'topInflatables3' =>  $this->topInflatables3,
            'topInflatables4' =>  $this->topInflatables4,
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'topInflatableAll' =>  $this->topInflatableAll,
            'productTitle' =>  Pages::where('type', 'product_page')->first(),
            'products1' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->skip(0)->take(3)->get(),
            'products2' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->skip(3)->take(3)->get(),
            'products3' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->skip(6)->take(3)->get(),

            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'topCategories' => $this->topCategories,

            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];
        if($searach_criteria){
            return response()->view('theme::search', $data)->header('Cache-Control:public', 'max-age=31536000');

        }else{

        return response()->view('theme::product', $data, 200)->header('Cache-Control:public', 'max-age=31536000');

        }
    }

    public function category_list()
    {
        //Session::forget('homePageCatId');
        $data = [
            'current_page' =>  'category_list_page',
            'pageData' =>  Pages::where('type', 'product_page')->first(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,
            'productTitle' =>  Pages::where('type', 'product_page')->first(),
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'blogsSlider' => Blog::where('status', 1)->limit(5)->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
        ];
        
        return view('theme::product-internal', $data);
    }
    
    public function product_internal($slug)
    {
        //Session::forget('homePageCatId');
        $current_cat = Category::where(['slug' => $slug, 'status' => 1])->whereNotIn('parent_id', [0])->first();

        if(isset($current_cat)){
            // dd($current_cat);
            if(!isset($current_cat)){
                return redirect(url('products'));
            }
            
            if($current_cat->status == 0){
                return redirect(url('products'));
            }
            $mainCategory = Category::find($current_cat->parent_id);
            $subCategory = Category::where(['parent_id' => $mainCategory->id, 'status' => 1])->get();

            $isCheckCategory = Category::where(['slug' => $slug, 'status' => 1])->first();
            $current_sub_cat = DB::table('categories')
            ->where('categories.id', $current_cat->id)->select('id','name','slug')
            ->first();
            
            $current_sub_categories = DB::table('categories')
            ->where('parent_id', $mainCategory->id)->select('id','name','slug')
            ->get();
            
            $subCategories = Category::where(['parent_id' => $isCheckCategory->id, 'status' => 1])->get();

            $data = [
                'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
                'pageData' =>  $isCheckCategory,
                'topCategories' => $this->topCategories,
                'subCategory' => $subCategory,
                'testimonials' =>  Testimonials::where(['status' => 1])->orderBy('item_no')->orderBy('id','DESC')->limit(50)->get(),
                'productDetail' =>  $isCheckCategory,
                'productImages' =>  Media::where('media_id', $current_cat->id)->orderBy('item_no','asc')->get(),
                'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
                'type' => 'maincategory_product',
                'mainCategory' => $mainCategory,
                'current_cat' =>  $current_cat,
                'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
                'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
                'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
                'blogsSlider' => Blog::where('status', 1)->limit(5)->orderBy('item_no')->get(),
                'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
                'topCategories1' => $this->topCategories1,
                'topCategories2' => $this->topCategories2,

                'current_sub_categories' => $current_sub_categories,
                'subCategories' => $current_sub_cat,
                'footerTestimonial' =>  $this->footerTestimonial,
                'footerVideo' =>   $this->footerVideo,
                'footerBlog' =>   $this->footerBlog,

                'footerCategories' =>   $this->footerCategories,
                'footerProducts' =>   $this->footerProducts,
                'footerBlogs' =>   $this->footerBlogs,
                'footerTestimonials' =>   $this->footerTestimonials,
                'footerOurPartners' =>   $this->footerOurPartners,
                'footerCaseStudies' =>   $this->footerCaseStudies,
                'productTitle' =>  Pages::where('type', 'product_page')->first(),

            ];
            return response()->view('theme::product-detail', $data, 200)->header('Cache-Control:public', 'max-age=31536000');

        }
        

        $current_cat = Category::where(['slug' => $slug, 'status' => 1])->first();
        // dd($current_cat);
        if(!isset($current_cat)){
            return redirect(url('products'));
        }
        if($current_cat->status == 0){
            return redirect(url('products'));
        }

        $criteriaData = Criteria::where('slug', $slug)->first();
        
        $current_sub_cat = Category::where(['parent_id' => $current_cat->id, 'status' => 1])
        ->select('id','name','slug')->limit(20)->get();
        
        /*echo "<pre>";
        print_r($current_sub_cat);
        exit();*/
        $isCheckProductCategory = Product::where(['category_id' => $current_cat->id, 'status' => 1])->get();

        if($isCheckProductCategory){
            $list1 = Category::where(['status' => 1, 'parent_id' => $current_cat->id])->orderBy('item_no')->skip(0)->take(3)->get();
            $list2 = Category::where(['status' => 1, 'parent_id' => $current_cat->id])->orderBy('item_no')->skip(3)->take(3)->get();
            $list3 = Category::where(['status' => 1, 'parent_id' => $current_cat->id])->orderBy('item_no')->skip(6)->take(3)->get();
            $list4 = Category::where(['status' => 1, 'parent_id' => $current_cat->id])->orderBy('item_no')->skip(9)->take(3)->get();
            $list5 = Category::where(['status' => 1, 'parent_id' => $current_cat->id])->orderBy('item_no')->skip(12)->take(3)->get();
        }else{
            
            $list1 = Category::where(['status' => 1, 'parent_id' => $current_cat->id])->orderBy('item_no')->skip(0)->take(3)->get();
            $list2 = Category::where(['status' => 1, 'parent_id' => $current_cat->id])->orderBy('item_no')->skip(3)->take(3)->get();
            $list3 = Category::where(['status' => 1, 'parent_id' => $current_cat->id])->orderBy('item_no')->skip(6)->take(3)->get();
            $list4 = Category::where(['status' => 1, 'parent_id' => $current_cat->id])->orderBy('item_no')->skip(9)->take(3)->get();
            $list5 = Category::where(['status' => 1, 'parent_id' => $current_cat->id])->orderBy('item_no')->skip(12)->take(3)->get();
        }
        $mainCategory = Category::find($current_cat->id);
        $data = [
            'pageData' =>  ['type' => 'category_page', 'featured_image' => $current_cat->image,  'image_alt' => $current_cat->name,
                            'image_title' => $current_cat->name, 'featured_image' => $current_cat->image,
                            'meta_description' => $current_cat->meta_description, 'meta_keyword' => $current_cat->meta_keyword,
                            'meta_title' => $current_cat->meta_title, 'meta_keyword' => $current_cat->meta_keyword,
                            'search_index' => $current_cat->search_index, 'search_follow' => $current_cat->search_follow,
                            'canonical_url' => $current_cat->canonical_url
                        ],
            'testimonials' =>  Testimonials::where(['status' => 1])->orderBy('item_no')->orderBy('id','DESC')->limit(50)->get(),
            // 'pageData' =>  $current_cat,
            'criteriaData' => $criteriaData,
            'criteriaMetas' => $this->criteriaMetas,
            'current_cat' =>  $current_cat,
            'current_sub_categories' =>  $current_sub_cat,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'blogsSlider' => Blog::where('status', 1)->limit(5)->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'list1' => $list1,
            'list2' => $list2,
            'list3' => $list3,
            'list4' => $list4,
            'list5' => $list5,
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'type' => 'category',
            'mainCategory' => $mainCategory,
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'footerTestimonial' =>  $this->footerTestimonial,

            'topCategories1' => $this->topCategories1,
            'topCategories2' => $this->topCategories2,

            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,
            'productTitle' =>  Pages::where('type', 'product_page')->first(),

        ];
        // dd($data);
        return response()->view('theme::product-internal', $data, 200)->header('Cache-Control:public', 'max-age=31536000');

    }


    public function product_details($slug)
    {
        //Session::forget('homePageCatId');
        $product = Product::where(['slug' => $slug])->first();

        if(isset($product->category_id)){
            $category_id = getParentCategory($product->category_id)['category']->id;
            
            $subCategories = Category::where(['parent_id'=> $product->category_id, 'status' => 1])->limit(10)->get();
        }else{
            $noCategory = Category::first();
            $subCategories = Category::limit(10)->orderBy('id', 'DESC')->where(['parent_id'=> $product->category_id, 'status' => 1])->get();        
        }
    
        $criteriaData = Criteria::where('slug', $searach_criteria)->first();
        

        $product->id;

        $taskComments = DB::table('category')
        ->join('products', 'products.category_id', '=', 'category.id')
        ->where('category', 'category.slug', '=', $slug)
        ->select('task_assign.id as task_assign_id', 'task_assign.description as task_assign_description',
                'admins.name as admin_name', 'task_assign.description as task_assign_description',
                'task_comments.comment as comment', 'task_comments.seen as comment_seen',
                'task_comments.seen_time as comment_seen_time', 'task_comments.type as comment_type',
                'task_comments.created_at as comment_created_at',
                'status.name as status_name', 'admins.image as admin_image'

            )
        ->where(['task_comments.seen' => 0])

       
        ->orderBy('task_comments.id', 'DESC')

        ->get();

        $list1 = Category::where(['status' => 1, 'parent_id' => $current_cat->id])->orderBy('item_no')->skip(0)->take(3)->get();
        $list2 = Category::where(['status' => 1, 'parent_id' => $current_cat->id])->orderBy('item_no')->skip(3)->take(3)->get();
        $list3 = Category::where(['status' => 1, 'parent_id' => $current_cat->id])->orderBy('item_no')->skip(6)->take(3)->get();
        $list4 = Category::where(['status' => 1, 'parent_id' => $current_cat->id])->orderBy('item_no')->skip(9)->take(3)->get();
        $list5 = Category::where(['status' => 1, 'parent_id' => $current_cat->id])->orderBy('item_no')->skip(12)->take(3)->get();
   

        $category = Category::where('id', $product->category_id)->first();
        // dd('cat-'.$list1);

        $data = [
            'criteriaData' => $criteriaData,
            'criteriaMetas' => $this->criteriaMetas,
            'pageData' =>  ['type' => 'category_page', 'featured_image' => $category->image],
            'topCategories' => $this->topCategories,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'blogsSlider' => Blog::where('status', 1)->limit(5)->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'list1' => $list1,
            'list2' => $list2,
            'list3' => $list3,
            'list4' => $list4,
            'list5' => $list5,
            'type' => 'product',
            'mainCategory' => $category->slug,
            'current_sub_categories' => $subCategories,
            'subCategories' => $subCategories,
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];
        
        
        return response()->view('theme::product-detail', $data, 200)->header('Cache-Control:public', 'max-age=31536000');

    }

    public function category_product($category, $slug)
    {
        //Session::forget('homePageCatId');
        $current_cat = Category::where(['slug' => $slug, 'status' => 1])->first();
        if(isset($current_cat)){
            return redirect(url('').'/'.$slug);
        }
        else{
            return redirect(url('products'));
        }

        if($current_cat->status == 0){
            return redirect(url('products'));
        }

        $mainCategory = Category::find($current_cat->parent_id);
        $subCategory = Category::where(['parent_id' => $mainCategory->id, 'status' => 1])->get();


        $isCheckCategory = Category::where(['slug' => $slug, 'status' => 1])->first();
        
        $current_sub_cat = DB::table('categories')
        ->where('categories.id', $current_cat->id)->select('id','name','slug')
        ->first();
        
        $current_sub_categories = DB::table('categories')
        ->where('parent_id', $mainCategory->id)->select('id','name','slug')
        ->get();
        
        $subCategories = Category::where(['parent_id' => $isCheckCategory->id, 'status' => 1])->get();

        $data = [
            'pageData' =>  $isCheckCategory,
            'topCategories' => $this->topCategories,
            'subCategory' => $subCategory,
            'productDetail' =>  $isCheckCategory,
            'productImages' =>  Media::where('media_id', $current_cat->id)->orderBy('item_no','asc')->get(),
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'blogsSlider' => Blog::where('status', 1)->limit(5)->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'type' => 'maincategory_product',
            'mainCategory' => $mainCategory,
            'current_cat' =>  $current_cat,
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'topCategories1' => $this->topCategories1,
            'topCategories2' => $this->topCategories2,

            'current_sub_categories' => $current_sub_categories,
            'subCategories' => $current_sub_cat,
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,

            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];
        
        return response()->view('theme::product-detail', $data, 200)->header('Cache-Control:public', 'max-age=31536000');


    }

    public function sitemap()
    {
        $data = [
            'urls' => UrlList::where('type', 'page_link')->get(), 
            'mainCategories' => Category::where('parent_id', 0)->orderBy('item_no')->get(),
            'blogs' => Blog::where('status', 1)->orderBy('item_no')->get(),
            'pageData' => Pages::where('type', 'home_page')->first(),
            'footerTestimonial' => $this->footerTestimonial,
            'footerVideo' => $this->footerVideo,
            'footerBlog' => $this->footerBlog,
            'topCategories' => $this->topCategories,
            'clients' => Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' => Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' => CaseStudies::where('status', 1)->orderBy('item_no')->get(),
            'blogsSlider' => Blog::where('status', 1)->limit(5)->orderBy('item_no')->get(),
            'newsletterSlider' => Newsletter::where('status', 1)->orderBy('item_no')->get(),
        ];
    
        // Return the sitemap view with XML header
        return response()->view('sitemap', $data, 200)
                         ->header('Content-Type', 'application/xml');
    }
    
    public function sitemapEdit()
    {    $type = 'sitemap';
        $data = [
            'mainCategories' => Category::where('parent_id', 0)->orderBy('item_no')->get(),
            'blogs' => Blog::where('status', 1)->orderBy('item_no')->get(),
            'pageData' =>  Pages::where('type', 'home_page')->first(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'topCategories' => $this->topCategories,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'blogsSlider' => Blog::where('status', 1)->limit(5)->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'topInflatables' =>  TopInflatables::orderBy('id', 'DESC')->where('status',1)->get(),
            'homeAbout' =>  Pages::where('type', 'home_page')->first(),
            'homeUrls1' =>  UrlList::where('type', 'home_url1')->get(),
            'urls' => UrlList::where('type', 'page_link')->get(), 
            'type' => $type,
            'pageData' =>  Pages::where('type', 'home_page')->first(),
        ];
        return view('admin.home-editor.popup-page', $data);
    }
    public function slugChecker4($category, $subCategory, $slug, $image)
    {
        return 'image'.$image;
        
    }

    public function category_subcategory_product($category, $subCategory, $slug)
    {
        //Session::forget('homePageCatId');

        $isProductDetails = Category::where('slug', $slug)->first();
        
        $criteriaData = Criteria::where('slug', $slug)->first();

        
        $current_sub_cat = Category::where(['parent_id' => $isProductDetails->id])->get();

        // $current_sub_cat = DB::table('categories')
        // ->join('products', 'products.category_id', '=', 'categories.id')
        // ->orderBy('products.id', 'desc')
        // ->where('categories.slug', $slug)
        // ->get();

            // dd($current_sub_cat);


        if($isProductDetails){
            // dd($mainCategory);
            
        $data = [
            'criteriaData' => $criteriaData,
            'criteriaMetas' => $this->criteriaMetas,
            'pageData' =>  $isCheckProduct,
            'productDetail' =>  $isCheckProduct,
            'productImages' =>  Media::where('image_type', 'product')->where('media_id', $isCheckProduct->id)->orderBy('item_no','asc')->get(),
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'topCategories' => $this->topCategories,
            
                'type' => 'category',
                'mainCategory' => $mainCategory,
                'current_cat' =>  $current_cat,

            'type' => 'maincategory_subcategory_product',
            'mainCategory' => $mainCategory,

            'topCategories1' => $this->topCategories1,
            'topCategories2' => $this->topCategories2,

            'current_sub_categories' => $current_sub_categories,
            'subCategories' => $current_sub_categories,
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'blogsSlider' => Blog::where('status', 1)->limit(5)->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];
        return response()->view('theme::product-detail', $data, 200)->header('Cache-Control:public', 'max-age=31536000');


        }
        else{

            return redirect(url('products'));
        }
    }
    
    public function blog_details($slug)
    {
        //Session::forget('homePageCatId');
        $blog = Blog::where(['slug' => $slug, 'status' => 1])->first();
        if(!isset($blog)){
            return redirect(url('blog'));
        }

        $data = [
            'pageData' =>  Blog::where('slug', $slug)->first(),
            'latestUpdates' =>  Partners::where('status',1)->where('slug', '!=' ,$slug)->limit(3)->get(),
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'blogDetail' =>  Blog::where('slug', $slug)->first(),
            'latestBlogs' =>  Blog::where('status',1)->limit(6)->get(),
            'topCategories' => $this->topCategories,
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'blogsSlider' => Blog::where('status', 1)->limit(5)->orderBy('item_no')->get(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];

        return response()->view('blog-detail', $data, 200)->header('Cache-Control:public', 'max-age=31536000');
    }

    public function casestudies_details ($slug)
    {
        //Session::forget('homePageCatId');
        $blog = CaseStudies::where(['slug' => $slug, 'status' => 1])->first();
        if(!isset($blog)){
            return redirect(url('blog'));
        }

        $data = [
            'pageData' =>  CaseStudies::where('slug', $slug)->first(),
            'latestUpdates' =>  Partners::where('status',1)->where('slug', '!=' ,$slug)->limit(3)->get(),
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'blogDetail' =>  CaseStudies::where('slug', $slug)->first(),
            'latestBlogs' =>  CaseStudies::where('status',1)->limit(6)->get(),
            'topCategories' => $this->topCategories,
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'blogsSlider' => Blog::where('status', 1)->limit(5)->orderBy('item_no')->get(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];

        return response()->view('casestudies-detail', $data, 200)->header('Cache-Control:public', 'max-age=31536000');
    }

    public function partners_details($slug)
    {
        //Session::forget('homePageCatId');
        $blog = Partners::where(['slug' => $slug, 'status' => 1])->first();
        if(!isset($blog)){
            return redirect(url('partenrs'));
        }

        $data = [
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'pageData' =>  Partners::where('slug', $slug)->first(),
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'blogDetail' =>  Partners::where('slug', $slug)->first(),
            'latestBlogs' =>  Partners::where('status',1)->limit(6)->get(),
            'topCategories' => $this->topCategories,
            'latestUpdates' =>  Partners::where('status',1)->where('slug', '!=' ,$slug)->limit(3)->get(),
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];

        return response()->view('partners-detail', $data, 200)->header('Cache-Control:public', 'max-age=31536000');
    }

    public function updates_details($slug)
    {
        //Session::forget('homePageCatId');
        $blog = Blog::where(['slug' => $slug, 'status' => 1])->first();
        if(!isset($blog)){
            return redirect(url('blog'));
        }

        $data = [
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'pageData' =>  Blog::where('slug', $slug)->first(),
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'blogDetail' =>  Blog::where('slug', $slug)->first(),
            'latestBlogs' =>  Blog::where('status',1)->limit(6)->get(),
            'topCategories' => $this->topCategories,
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'latestUpdates' =>  Blog::where('status',1)->where('slug', '!=' ,$slug)->limit(3)->get(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];
        return response()->view('update-detail', $data, 200)->header('Cache-Control:public', 'max-age=31536000');
    }

    public function newsletters_details($slug)
    {
        //Session::forget('homePageCatId');
        $blog = Newsletter::where(['slug' => $slug, 'status' => 1])->first();
        if(!isset($blog)){
            return redirect(url('newsletters'));
        }

        $data = [
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'pageData' =>  Newsletter::where('slug', $slug)->first(),
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'blogDetail' =>  Newsletter::where('slug', $slug)->first(),
            'latestBlogs' =>  Newsletter::where('status',1)->limit(6)->get(),
            'topCategories' => $this->topCategories,
            'latestUpdates' =>  Newsletter::where('status',1)->where('slug', '!=' ,$slug)->limit(3)->get(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
        ];

        return response()->view('newsletters-details', $data, 200)->header('Cache-Control:public', 'max-age=31536000');
    }
    

    public function about()
    {
        //Session::forget('homePageCatId');
        $data = [
            'pageData' =>  Pages::where('type', 'about_page')->first(),
            'blogsSlider' => Blog::where('status', 1)->limit(5)->orderBy('item_no')->get(),
            'testimonials' =>  Testimonials::where(['status' => 1])->orderBy('item_no')->orderBy('id','DESC')->limit(50)->get(),
            'pageData' =>  Pages::where('type', 'contact_page')->first(),
            'industriesData' =>  Pages::where('type', 'industrie_page')->first(),
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'topCategories' => $this->topCategories,
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'topInflatables1' =>  $this->topInflatables1,
            'topInflatables2' =>  $this->topInflatables2,
            'topInflatables3' =>  $this->topInflatables3,
            'topInflatables4' =>  $this->topInflatables4,
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'topInflatableAll' =>  $this->topInflatableAll,
            
            'products1' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(0)->take(5)->get(),
            'products2' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(5)->take(10)->get(),
            'products3' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(10)->take(15)->get(),

            
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];
        return response()->view('theme::about', $data, 200)->header('Cache-Control:public', 'max-age=31536000');

    }

    public function newsletters()
    {
        //Session::forget('homePageCatId');
        $data = [
            'pageData' =>  Pages::where('type', 'newsletter_page')->first(),
            'industriesData' =>  Pages::where('type', 'industrie_page')->first(),
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'newsletter' =>  Newsletter::where('status', 1)->orderBy('item_no')->get(),
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'topCategories' => $this->topCategories,
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'topInflatables1' =>  $this->topInflatables1,
            'topInflatables2' =>  $this->topInflatables2,
            'topInflatables3' =>  $this->topInflatables3,
            'topInflatables4' =>  $this->topInflatables4,

            'topInflatableAll' =>  $this->topInflatableAll,
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'products1' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(0)->take(5)->get(),
            'products2' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(5)->take(10)->get(),
            'products3' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(10)->take(15)->get(),

            
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];
        return response()->view('newsletters', $data, 200)->header('Cache-Control:public', 'max-age=31536000');

    }

    public function casestudies()
    {
        //Session::forget('homePageCatId');
        $data = [
            'pageData' =>  Pages::where('type', 'casestudies_page')->first(),
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'caseStudies' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->paginate(6),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'topCategories' => $this->topCategories,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),

            'topInflatables1' =>  $this->topInflatables1,
            'topInflatables2' =>  $this->topInflatables2,
            'topInflatables3' =>  $this->topInflatables3,
            'topInflatables4' =>  $this->topInflatables4,

            'topInflatableAll' =>  $this->topInflatableAll,
            
            'products1' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(0)->take(5)->get(),
            'products2' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(5)->take(10)->get(),
            'products3' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(10)->take(15)->get(),
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];

        return response()->view('casestudies', $data, 200)->header('Cache-Control:public', 'max-age=31536000');

    }

    public function client()
    {
        //Session::forget('homePageCatId');
        $data = [
            'pageData' =>  Pages::where('type', 'client_page')->first(),
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'topCategories' => $this->topCategories,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'topInflatables1' =>  $this->topInflatables1,
            'topInflatables2' =>  $this->topInflatables2,
            'topInflatables3' =>  $this->topInflatables3,
            'topInflatables4' =>  $this->topInflatables4,
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            // 'clients' =>  Client::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'topInflatableAll' =>  $this->topInflatableAll,
            
            'products1' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(0)->take(5)->get(),
            'products2' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(5)->take(10)->get(),
            'products3' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(10)->take(15)->get(),

            
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];

        return response()->view('client.client', $data, 200)->header('Cache-Control:public', 'max-age=31536000');

    }
    public function awards()
    {
        //Session::forget('homePageCatId');
        $data = [
            'pageData' =>  Pages::where('type', 'award_page')->first(),
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'topCategories' => $this->topCategories,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awards' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'topInflatables1' =>  $this->topInflatables1,
            'topInflatables2' =>  $this->topInflatables2,
            'topInflatables3' =>  $this->topInflatables3,
            'topInflatables4' =>  $this->topInflatables4,

            'topInflatableAll' =>  $this->topInflatableAll,
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'products1' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(0)->take(5)->get(),
            'products2' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(5)->take(10)->get(),
            'products3' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(10)->take(15)->get(),

            
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];

        return response()->view('award.awards', $data, 200)->header('Cache-Control:public', 'max-age=31536000');

    }

    public function updates()
    {
        //Session::forget('homePageCatId');
        $data = [
            'pageData' =>  Pages::where('type', 'blog_page')->first(),
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'updates' =>  Blog::where(['status' => 1])->orderBy('item_no')->orderBy('id','DESC')->paginate(6),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'topCategories' => $this->topCategories,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'topInflatables1' =>  $this->topInflatables1,
            'topInflatables2' =>  $this->topInflatables2,
            'topInflatables3' =>  $this->topInflatables3,
            'topInflatables4' =>  $this->topInflatables4,
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'topInflatableAll' =>  $this->topInflatableAll,
            
            'products1' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(0)->take(5)->get(),
            'products2' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(5)->take(10)->get(),
            'products3' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(10)->take(15)->get(),

            
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];

        return response()->view('updates', $data, 200)->header('Cache-Control:public', 'max-age=31536000');

    }
    public function partenrs()
    {
        //Session::forget('homePageCatId');
        $data = [
            'pageData' =>  Pages::where('type', 'partenr_page')->first(),
            'industriesData' =>  Pages::where('type', 'industrie_page')->first(),
            'partenrs' =>  Partners::where('status', 1)->orderBy('item_no')->paginate(9),
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'topCategories' => $this->topCategories,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'topInflatables1' =>  $this->topInflatables1,
            'topInflatables2' =>  $this->topInflatables2,
            'topInflatables3' =>  $this->topInflatables3,
            'topInflatables4' =>  $this->topInflatables4,
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'topInflatableAll' =>  $this->topInflatableAll,
            
            'products1' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(0)->take(5)->get(),
            'products2' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(5)->take(10)->get(),
            'products3' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(10)->take(15)->get(),

            
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];

        return response()->view('partenrs', $data, 200)->header('Cache-Control:public', 'max-age=31536000');

    }
    public function search_criteria(Request $request){
        $search = $request->search;
        $searchData = array();
        
        $getBlog = Blog::where('title', 'like', '%'.$search.'%')->orderBy('item_no')->get();
        $getCategory = Category::where('name', 'like', '%'.$search.'%')->orderBy('item_no')->get();
        $getCaseStudies = CaseStudies::where('title', 'like', '%'.$search.'%')->orderBy('item_no')->get();
        $searchKey = 0;
        if (count($getBlog) > 0) {
            foreach ($getBlog as $key => $value) {
                $searchData[$searchKey]['Image'] = url('/').'/images/'.$value->image;
                $searchData[$searchKey]['Description'] = $value->short_description;
                $searchData[$searchKey]['Title'] = $value->title;
                $searchData[$searchKey]['Slug'] = 'updates/'.$value->slug;
                $searchKey++;
            }
        }
        if (count($getCategory) > 0) {
            foreach ($getCategory as $key => $value) {
                $searchData[$searchKey]['Image'] = asset('/').'/images/'.getImageFromCategory($value->id)[0]->image;
                $searchData[$searchKey]['Description'] = $value->meta_description;
                $searchData[$searchKey]['Title'] = $value->name;
                $searchData[$searchKey]['Slug'] = $value->slug;
                $searchKey++;
            }
        }
        if (count($getCaseStudies) > 0) {
            foreach ($getCaseStudies as $key => $value) {
                $searchData[$searchKey]['Image'] = url('/').'/images/'.$value->image;
                $searchData[$searchKey]['Description'] = $value->meta_description;
                $searchData[$searchKey]['Title'] = $value->title;
                $searchData[$searchKey]['Slug'] = 'case-studies/'.$value->slug;
                $searchKey++;
            }
        }
        
        $data = [
            'pageData' =>  Pages::where('type', 'partenr_page')->first(),
            'industriesData' =>  Pages::where('type', 'industrie_page')->first(),
            'partenrs' =>  Partners::where('status', 1)->orderBy('item_no')->paginate(9),
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),

            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'topCategories' => $this->topCategories,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'topInflatables1' =>  $this->topInflatables1,
            'topInflatables2' =>  $this->topInflatables2,
            'topInflatables3' =>  $this->topInflatables3,
            'topInflatables4' =>  $this->topInflatables4,
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
            'topInflatableAll' =>  $this->topInflatableAll,
            
            'products1' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(0)->take(5)->get(),
            'products2' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(5)->take(10)->get(),
            'products3' => Category::where(['status' => 1, 'parent_id' => 0])->orderBy('id', 'DESC')->skip(10)->take(15)->get(),
            'blogsSlider' => Blog::where('status', 1)->limit(5)->orderBy('item_no')->get(),

            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,
            'searchTitle' =>   $search,
            'searchData' =>   $searchData,
        ];
        
        return response()->view('search', $data)->header('Cache-Control:public', 'max-age=31536000');
    }
    public function testimonials(Request $request)
    {
        $id = $request->query('testimonial');
        /*$getData = Testimonials::where(['id' => $id])->first();
        print_r($getData);
        exit();*/
        $data = [
            'testimonials' =>  Testimonials::where(['status' => 1])->orderBy('item_no')->orderBy('id','DESC')->paginate(10),
            'testimonialDetail' =>  Testimonials::where(['id' => $id])->first(),
            'pageData' =>  Pages::where('type', 'testimonial_page')->first(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'topCategories' => $this->topCategories,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
        ];
        return response()->view('testimonials', $data, 200)->header('Cache-Control:public', 'max-age=31536000');

    }
    public function videos()
    {
        $data = [
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->paginate(6),
            'pageData' =>  Pages::where('type', 'video_page')->first(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'topCategories' => $this->topCategories,
            'clients' =>  Client::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'awardSlider' =>  Award::where('status', 1)->limit(20)->orderBy('item_no')->get(),
            'caseStudiesSlider' =>  CaseStudies::where(['status' => 1])->orderBy('item_no')->get(),
            'newsletterSlider' =>  Newsletter::where(['status' => 1])->orderBy('item_no')->get(),
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,
            'industriesData' =>  Pages::where('type', 'industrie_page')->first(),
            'testimonials' =>  Testimonials::where(['status' => 1])->orderBy('item_no')->orderBy('id','DESC')->limit(50)->get(),
            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
        ];
        return response()->view('videos', $data, 200)->header('Cache-Control:public', 'max-age=31536000');

    }

    public function blog()
    {
        $data = [
            'blogs' =>  Blog::where('status', 1)->orderBy('item_no')->get(),
            'pageData' =>  Pages::where('type', 'blog_page')->first(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'topCategories' => $this->topCategories,

            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

        ];
        return response()->view('blog', $data, 200)->header('Cache-Control:public', 'max-age=31536000');

    }

    public function contact()
    {
        $data = [
            'current_page' =>  'contact',
            'pageData' =>  Pages::where('type', 'contact_page')->first(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'topCategories' => $this->topCategories,
            'videos' =>  Video::where(['status' => 1])->orderBy('item_no')->get(),
            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
        ];
        return response()->view('contact-us', $data, 200)->header('Cache-Control:public', 'max-age=31536000');
    }

    public function thankyou()
    {

        $data = [
            'current_page' =>  'contact',
            'pageData' =>  Pages::where('type', 'contact_page')->first(),
            'footerTestimonial' =>  $this->footerTestimonial,
            'footerVideo' =>   $this->footerVideo,
            'footerBlog' =>   $this->footerBlog,
            'topCategories' => $this->topCategories,

            'footerCategories' =>   $this->footerCategories,
            'footerProducts' =>   $this->footerProducts,
            'footerBlogs' =>   $this->footerBlogs,
            'footerTestimonials' =>   $this->footerTestimonials,
            'footerOurPartners' =>   $this->footerOurPartners,
            'footerCaseStudies' =>   $this->footerCaseStudies,

            'industries' =>  Industries::where(['status' => 1])->orderBy('item_no')->limit(50)->get(),
        ];
        return response()->view('thankyou', $data, 200)->header('Cache-Control:public', 'max-age=31536000');
    }

    public function getCatogery(Request $request){
        $response = $data = array();
        if (session('LoggedUser')) {
            $response['IsLogged'] = 1;
        }
        
        session()->put('homePageCatId',$request->id);
        if(count(getCustomSubCategories($request->id)) > 0){
            foreach(getCustomSubCategories($request->id) as $key => $topInflatableLp){
                if (count(getSubCategoryImages($topInflatableLp->id)) > 0) {
                    $imageName = getSubCategoryImages($topInflatableLp->id, 2, 'DESC')[0]['image'];
                    $response['categorieData'][$key]['Code'] = 200;
                    $response['categorieData'][$key]['Slug'] = url('').'/'.$topInflatableLp->slug;
                    $response['categorieData'][$key]['Create'] = route('admin.category.create').'?type=sub_category&onscreenCms=true&id='.$request->id;
                    $response['categorieData'][$key]['Link'] = route('admin.category.edit', $topInflatableLp->id).'?type=sub_category&onscreenCms=true&id='.$request->id;
                    $response['categorieData'][$key]['Delete'] = route('admin.index').'/category/delete/'.$topInflatableLp->id;
                    $response['categorieData'][$key]['Name'] = $topInflatableLp->name;
                    $response['categorieData'][$key]['Id'] = $topInflatableLp->id;
                    $response['categorieData'][$key]['CatogeryId'] = $request->id;

                    foreach(getSubCategoryImages($topInflatableLp->id, 10, 'DESC') as $imgKey => $productImage){
                        $response['categorieData'][$key]['Image'][$imgKey] = url('/').'/images/'.$productImage->image;
                    }
                } else {
                    $response['categorieData'][$key]['Code'] = 200;
                    $response['categorieData'][$key]['Image'][0] = url('/').'/images/noimage.png';
                    $response['categorieData'][$key]['Create'] = route('admin.category.create').'?type=sub_category&onscreenCms=true&id='.$request->id;
                    $response['categorieData'][$key]['Link'] = route('admin.category.edit', $topInflatableLp->id).'?type=sub_category&onscreenCms=true&id='.$request->id;
                    $response['categorieData'][$key]['Delete'] = route('admin.index').'/category/delete/'.$topInflatableLp->id;
                    $response['categorieData'][$key]['Slug'] = url('').'/'.$topInflatableLp->slug;
                    $response['categorieData'][$key]['Name'] = $topInflatableLp->name;
                    $response['categorieData'][$key]['Id'] = $topInflatableLp->id;
                    $response['categorieData'][$key]['CatogeryId'] = $request->id;
                    $response['categorieData'][$key]['Code'] = 400;
                }
            }
        } else {
            $response['MainCategoryData'] = Category::find($request->id);
            $response['MainCategoryData']['Image'] = url('/').'/images/noimage.png';
            $response['MainCategoryData']['Create'] = route('admin.category.create').'?type=sub_category&onscreenCms=true&id='.$request->id;
            $response['MainCategoryData']['Link'] = route('admin.category.edit', $request->id).'?type=main_category&onscreenCms=true';
            $response['MainCategoryData']['Delete'] = route('admin.index').'/category/delete/'.$request->id;
            $response['Code'] = 400;
        }
        echo json_encode($response);
    }
    public function industriesImages(Request $request)
    {
        // echo $request->id;
        $getImage = Media::where('media_id', $request->id)->where('image_type', $request->type)->orderBy('item_no','asc')->get();

        if (count($getImage) > 0) {
            // $response['Code'] = 200;
            $response = array();
            $data['caption'] = $request->caption;
            $data['title'] = 'Title First caption';
            foreach ($getImage as $image) {
                $response[] = array('src' => url('web').'/media/lg/'.$image->image,'opts' => $data);
            }
        } else {
            $response['Code'] = 400;
        }

        echo json_encode($response);
    }
    public function industriesImagesAjax(Request $request)
    {
        // echo $request->id;
        $getImage = Media::where('media_id', $request->id)->where('image_type', 'industries')->orderBy('item_no','asc')->get();

        if (count($getImage) > 0) {
            // $response['Code'] = 200;
            $response = array();
            foreach ($getImage as $image) {
                // $response[] = array('src' => url('web').'/media/lg/'.$image->image);
                // echo "<img src='".url('web').'/media/lg/'.$image->image."'>";
            }
        } else {
            $response['Code'] = 400;
        }

        // echo json_encode($response);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function destorySession()
    {
        Session::forget('success');
    }
}

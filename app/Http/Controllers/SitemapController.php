<?php

namespace App\Http\Controllers\home;

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
use App\Models\admin\SocialMedia;
use Illuminate\Support\Str;
use Session;
use DB;


class SitemapController extends Controller
{
    
    public function __construct()
    {
        $this->contact = SocialMedia::first();
        $this->allProduct = Category::select('main.name as parentname', 'main.slug as parentslug', 'sub.*')
            ->from('categories as sub')
            ->join('categories as main', 'sub.parent_id', '=', 'main.id')
            ->orderBy('sub.created_at', 'desc') // Assuming you have a timestamp field like 'created_at'
            ->take(8)
            ->where('sub.parent_id', '<>', 0)
            ->get();
        $this->footerTestimonial = testimonials::where(['status' => 1])->orderBy('item_no')->orderBy('id', 'DESC')->first();

        $this->footerVideo = Video::where(['status' => 1])->orderBy('item_no')->first();
        $this->footerBlog = Blog::where(['status' => 1])->orderBy('id', 'DESC')->orderBy('id', 'DESC')->get();

        $this->footerCategories = Category::where(['parent_id' => 0, 'status' => 1])->orderBy('id', 'DESC')->limit(8)->get();
        $this->footerCaseStudies = CaseStudies::where(['status' => 1])->orderBy('id', 'DESC')->limit(8)->get();
        $this->footerProducts = Product::where(['status' => 1])->orderBy('id', 'DESC')->limit(8)->get();
        $this->footerBlogs = Blog::where(['status' => 1])->orderBy('id', 'DESC')->orderBy('id', 'DESC')->limit(8)->get();
        $this->footerAllProduct = Category::where(['parent_id' => 0, 'status' => 1])->orderBy('id', 'DESC')->limit(8)->get();

        $this->footerTestimonials = testimonials::orderBy('item_no')->limit(8)->get();
        $this->footerOurPartners = Partners::orderBy('item_no')->limit(8)->get();

        $this->parent_categories = Category::where(['parent_id' => 0])->orderBy('id', 'DESC')->get();
        $this->topCategories = Category::where(['parent_id' => 0])->orderBy('id', 'DESC')->limit(10)->get();
        $this->topCategories1 = Category::where(['parent_id' => 0])->orderBy('id', 'DESC')->skip(0)->take(5)->get();
        $this->topCategories2 = Category::where(['parent_id' => 0])->orderBy('id', 'DESC')->skip(5)->take(10)->get();

        $this->criteriaMetas = DB::table('criteria_metas')
            ->join('criterias', 'criterias.id', '=', 'criteria_metas.criteria_id')
            ->whereNotNull('criteria_metas.categories')
            ->where(['criteria_metas.status' => 1, 'criterias.status' => 1])

            ->select(
                'criteria_metas.id as id',
                'criteria_metas.categories as categories',
                'criterias.title as name',
                'criterias.slug as slug',
                'criteria_metas.criteria_id as criteria_id',
                'criteria_metas.status as status'
            )
            ->orderBy('criteria_metas.item_no')->take(10)->get();

        $AllActiveMainCategories =
            Category::where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->get();

        foreach ($AllActiveMainCategories as $AllActiveMainCategory) {
            $subCatWithImages = DB::table('categories')->where('parent_id', $AllActiveMainCategory->id)->first();
        }


        $this->topInflatables1 = Category::where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->skip(0)->take(3)->get();
        $this->topInflatables2 = Category::where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->skip(3)->take(3)->get();
        $this->topInflatables3 = Category::where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->skip(6)->take(3)->get();
        $this->topInflatables4 = Category::where(['status' => 1, 'parent_id' => 0])->orderBy('item_no')->skip(9)->take(3)->get();

        $this->topInflatableAll = $AllActiveMainCategories;

        $isYoutubeSlider = Slider::orderBy('slider_no')->where('status', 1)->first();

        if (isset($isYoutubeSlider->youtube_embed)) {
            $this->sliders = Slider::orderBy('slider_no')->where('status', 1)->first();
        } else {
            $this->sliders = Slider::orderBy('slider_no')->where('status', 1)->get();
        }
    }
    
    const DATEFORMAT = 'Y-m-d\TH:i:s+00:00';
    const P1 = 1;
    const P8 = 0.8;
    const P6 = 0.6;

    public function siteMap()
    {
        $sitemapUrlLists = $this->getAllURLs();
        //dd($sitemapUrlLists);

        $data = [
            'sitemapUrlLists' => $sitemapUrlLists,
        'footerBlogs' => $this->footerBlogs,
        'topCategories' => $this->topCategories,
        'allProduct' => $this->allProduct,
        'contact' => $this->contact,
        'footerTestimonial' =>  $this->footerTestimonial,
        'footerTestimonials' =>  $this->footerTestimonials,
        'footerVideo' =>   $this->footerVideo,
        'footerBlog' =>   $this->footerBlog,
        'topCategories' => $this->topCategories,
        ];
        
        return view('site-map',compact('data'));
    }

    public function siteXml()
    {
        $urls = $this->getAllURLs(true);
        return response()->view('frunt.sitemap', compact('urls'))->header('Content-Type', 'text/xml');
        //return response(file_get_contents(resource_path('sitemap.xml')), 200, [
            //'Content-Type' => 'application/xml'
        //]);
       
        
    }

    private function _getAllLinks()
    {
        $defaultLastMod = gmdate(self::DATEFORMAT, strtotime(now()));
        $urls = [
            [ 
                'name' => 'Home',
                'link' => route('index'),
                'priority' => self::P1,
                'lastmod' => $defaultLastMod
            ],
            [ 
                'name' => 'About Us',
                'link' => route('aboutus'),
                'priority' => self::P8,
                'lastmod' => $defaultLastMod
            ],[ 
                'name' => 'Contact Us',
                'link' => route('contact'),
                'priority' => self::P8,
                'lastmod' => $defaultLastMod
            ],
            [
                'name' => 'Our Products',
                'link' => route('products.slug.productMain.nmdir'),
                'priority' => self::P8,
                'lastmod' => $defaultLastMod,
                'childs' => $this->_getMainCtaegory()
            ],
            [
                'name' => 'Latest',
                'link' => route('latest'),
                'priority' => self::P6,
                'lastmod' => $defaultLastMod,
                'childs' => $this->_getAllUpdate()
            ],
            /*[
                'name' => 'Case Studies',
                'link' => route('casestudy'),
                'priority' => self::P6,
                'lastmod' => $defaultLastMod,
                'childs' => $this->_getAllCaseStudies()
            ], */      
        ];      
        return array_merge($urls);
    }

    private function getAllURLs($flatten = false) 
    {
        $sitemapUrlLists = $this->_getAllLinks();
        if (!$flatten) {
            return $sitemapUrlLists;
        }

        $result = [];
        $i = 0;
        foreach ($sitemapUrlLists as $key => $val) {
            $childs = [];
            if (!empty($val['childs'])) {
                $childs = $val['childs'];
                unset($val['childs']);
            }
            $result[$i] = $val;
            $i++;

            if (!empty($childs)) {
                foreach ($childs as $cKey => $cVal) {
                    $subChilds = [];
                    if (!empty($cVal['childs'])) {
                        $subChilds = $cVal['childs'];
                        unset($cVal['childs']);
                    }
                    $result[$i] = $cVal;
                    $i++;
                    
                    if (!empty($subChilds)) {
                        foreach ($subChilds as $scKey => $scVal) {
                            $result[$i] = $scVal;
                            $i++;
                        }
                    }
                }
            }
        }

        return $result;
    }

    private function _getMainCtaegory()
    {       
        $categories = customMainCat(); //Category::where('parent_id', 0)->orderBy('item_no')->get();
        foreach ($categories as $key => $value) {   
            $mainCatUrlSet[] = [ 
                'name' => $value->name,
                //'link' => route('products.slug.nmdir'),
                'link' => route('index')."/".$value->slug,
                'last_updated' => $value->updated_at,
                'lastmod'=> gmdate(self::DATEFORMAT, strtotime($value->updated_at)),
                'priority' => self::P8,
                'childs' => $this->_getArticles($value->id)
            ];          
        }
        
        return $mainCatUrlSet;     
    }

    private function _getArticles($mainCategoryId)
    {
        $subcatUrlSet = [];
        if(count(getCustomSubCategories($mainCategoryId)) > 0 ) {
            foreach (getCustomSubCategories($mainCategoryId) as $key => $value) {
                 $subcatUrlSet[] = [ 
                    'name' => $value->name,
                   // 'link' => route('products.slug.nmdir'),
                    'link' => route('index')."/".$value->slug,
                    'last_updated' =>  $value->updated_at,
                    'lastmod'=> gmdate(self::DATEFORMAT, strtotime($value->updated_at)),
                    'priority' => self::P8
                ];
            }
        }
        return $subcatUrlSet;
    }

    private function _getAllUpdate()
    {
        $blogs = Blog::where('status', 1)->orderBy('item_no')->get();
        $blogsUrlSet = [];
        foreach ($blogs as $key => $value) {   
            $blogsUrlSet[] = [ 
                'name' => $value->title,
                'link' => route('blogSub', [$value->slug]),
                'last_updated' =>  $value->updated_at,
                'lastmod'=> gmdate(self::DATEFORMAT, strtotime($value->updated_at)),
                'priority' => self::P6
            ];          
        }
        
        return $blogsUrlSet;
    }

    /*private function _getAllCaseStudies()
    {
        $cs = CaseStudies::where('status', 1)->orderBy('item_no')->get();
        $csUrlSet = [];
        foreach ($cs as $key => $value) {   
            $csUrlSet[] = [ 
                'name' => $value->title,
                'link' => route('casestudy.details', [$value->slug]),
                'last_updated' =>  $value->updated_at,
                'lastmod'=> gmdate(self::DATEFORMAT, strtotime($value->updated_at)),
                'priority' => self::P6
            ];          
        }
        
        return $csUrlSet;
    } */

}
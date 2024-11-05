<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\TopInflatables;
use App\Models\admin\Product;
use App\Models\admin\UrlList;
use App\Models\admin\Client;
use App\Models\admin\Category;
use App\Models\admin\Pages;
use Intervention\Image\Facades\Image;

use DB;

class BlockControlController extends Controller
{

    public function __construct(){
        // $this->topInflatables = TopInflatables::orderBy('id','DESC')->get();

        $this->topInflatables = DB::table('top_inflatables')
        ->join('categories', 'categories.id', '=', 'top_inflatables.item_id')
        ->orderBy('top_inflatables.item_no')
        ->select('top_inflatables.id as id', 'categories.name as name',  'top_inflatables.item_no as item_no', 
        'categories.image as product_image', 'top_inflatables.status as status' )

        ->get();

        // dd($this->topInflatables);

    }
    
    public function topInflatableCreate()
    {
        $data = [
            'topInflatables' =>  $this->topInflatables,
            'categories' =>  Category::orderBy('id', 'DESC')->where(['status' => 1, 'parent_id' => 0])->get()
        ];
        return view('adm.pages.block-control.top-inflatable', $data);
    }

    public function topInflatableStore(Request $request)
    {
        $request->validate([
            'category_id' => 'required|unique:top_inflatables,item_id',
        ]);

        $item_no = TopInflatables::orderBy('item_no')->first();
        
        if($item_no){
            $item_no = $item_no->id + 1;
        }else{
            $item_no = 1;
        }
        
        if($request->status){
            $status = 1;
        }else{
            $status = 0;
        }

        $topInflatable = new TopInflatables;
        $topInflatable->item_no = $item_no;
        $topInflatable->item_id = $request->category_id;
        $topInflatable->status = $status;
               
        $save = $topInflatable->save();

        if($save){
            return back()->with('success', 'Top Inflatable Added...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }
    

    public function pageLinkCreate(Request $request)
    {
     
            // dd($request);
        if($request->type == 'edit'){
            $type = 'EditpageLink';
            $pageLink = DB::table('url_list')->where(['type'=> 'page_link', 'id'=> $request->id])->first();
            if(!$pageLink){
              return redirect(route('admin.pageLink.create'));  
            }else{
            $data = [
                'pageData' =>  Pages::where('type', 'client_page')->first(),
                'pageLink' =>  $pageLink,
                'type' => $type,
                'pageLinks' =>  DB::table('url_list')->where('type', 'page_link')->orderBy('item_no')->get(),
            ];

            return view('admin.home-editor.popup-page', $data);
            }

        }else{
            $type = 'pageLink';
            $data = [
                'pageData' =>  Pages::where('type', 'client_page')->first(),
                'pageLink' =>  'null',
                'type' => $type,
                'pageLinks' =>  DB::table('url_list')->where('type', 'page_link')->orderBy('item_no')->get(),
            ];

            return view('admin.home-editor.popup-page', $data);
        }
    }
    
    
    public function pageLinkStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
        ]);
        $item_no = UrlList::orderBy('item_no', 'desc')->first();
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

        $urlList = new UrlList;
        $urlList->item_no = $item_no;
        $urlList->name = $request->name;
        $urlList->type = $request->type;
        $urlList->url = $request->url;
        $urlList->status = $status;
        $save = $urlList->save();

        if($save){
            return back()->with('success', 'Page Url Added...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }
    
    public function pageLinkUpdate(Request $request)
    {
      
        
        if($request->status == 'on'){
            $status = 1;
        }else{
            $status = 0;
        }

        $urlList = UrlList::find($request->id);
        $urlList->name = $request->name;
        $urlList->url = $request->url;
        $urlList->status = $status;
        $save = $urlList->save();

        if($save){
            return response()->json([
                'success' => true,
                'message' => 'Page Url Updated...'
            ]);
            
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, try again later...'
            ]);
        }
    }
    
    public function commonLinkCreate( $pageType = null, Request $request)
    {
        if($pageType == 'category'){
            $tableDatas = DB::table('categories')->where(['status' => 1, 'parent_id' => 0])->get();
            $pageTitle = 'Category';
            $type = 'category_link';
            $table = 'categories';
            $pageSlug = 'category';
        }
        elseif($pageType == 'product'){
            $tableDatas = DB::table('products')->where('status', 1)->get();
            $pageTitle = 'Product';
            $type = 'product_link';
            $table = 'products';
            $pageSlug = 'product';
        }
        elseif($pageType == 'blog'){
            $tableDatas = DB::table('blogs')->where('status', 1)->get();
            $pageTitle = 'Blog';
            $type = 'blog_link';
            $table = 'blogs';
            $pageSlug = 'blog';
        }
        elseif($pageType == 'testimonial'){
            $tableDatas = DB::table('testimonials')->where('status', 1)->get();
            $pageTitle = 'Testimonial';
            $type = 'testimonial_link';
            $table = 'testimonials';
            $pageSlug = 'testimonial';
        }
        // dd($tableDatas);
        


        if($request->type == 'edit'){
            // dd($pageType);
            $currentData = DB::table('url_list')->where('id', $request->id)->first();
            if(!$currentData){
            //   return redirect(route('admin.pageLink.create'));  
            }

            $data = [
                'tableDatas' =>  $tableDatas,
                'pageTitle' =>  $pageTitle,
                'currentData' =>  $currentData,
                'linkDatas' =>  DB::table('url_list')->where('type', $type)->orderBy('item_no')->get(),
                'type' => $type,
                'table' => $table,
                'pageSlug' => $pageSlug
            ];
            return view('adm.pages.block-control.common-link-edit', $data);
        }else{

            $data = [
                'tableDatas' =>  $tableDatas,
                'pageTitle' =>  $pageTitle,
                'linkDatas' =>  DB::table('url_list')->where('type', $type)->orderBy('item_no')->get(),
                'type' => $type,
                'table' => $table,
                'pageSlug' => $pageSlug
            ];
            return view('adm.pages.block-control.common-link', $data);
        }
    }
    
    
    public function commonLinkStore(Request $request)
    {

        $request->validate([
            'item_id' => 'required',
        ]);

        $item_no = UrlList::where('type',$request->type)->orderBy('item_no', 'desc')->first();

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

        $urlList = new UrlList;
        $urlList->item_no = $item_no;
        $urlList->name = $request->name;
        $urlList->item_id = $request->item_id;
        $urlList->type = $request->type;
        $urlList->url = $request->url;
        $urlList->status = $status;
        $save = $urlList->save();

        if($save){
            return back()->with('success', 'Page Url Added...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }
    
    public function commonLinkUpdate(Request $request)
    {

        $request->validate([
            'item_id' => 'required',
        ]);

        $item_no = UrlList::where('type',$request->type)->orderBy('item_no')->first();

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

        $urlList = UrlList::find($request->id);
        $urlList->item_no = $item_no;
        $urlList->name = $request->name;
        $urlList->item_id = $request->item_id;
        $urlList->type = $request->type;
        $urlList->url = $request->url;
        $urlList->status = $status;
        $save = $urlList->save();

        if($save){
            return back()->with('success', 'Page Url Added...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }
    

    public function deleteBlockControl(Request $request){

        // dd($request->input());
    
        $id = $request->id;
        $data_slug =  $request->data_slug;

        switch ($data_slug) {
            case 'page':
                $table = 'url_list';                
                break;


                case 'blog':
                    $table = 'url_list';                
                    break;

                case 'category':
                    $table = 'url_list';                
                    break;

                case 'product':
                    $table = 'url_list';                
                    break;
                        
                case 'testimonial':
                    $table = 'url_list';
                    break;

                case 'video':
                    $table = 'url_list';
                    break;

                case 'top_inflatable':
                    $table = 'top_inflatables';
                    break;


            case 'url_list':
                $table = 'url_list';
            break;
                        

                default:               
                    $table = 'no-table';
                    break;


    }
    // $delete = DB::table($table)->where('id', $id)->delete();

    if(DB::table($table)->where('id', $id)->first()){
        $delete = DB::table($table)->where('id', $id)->delete();

        if($data_slug == 'page'){
            return redirect(route('admin.pageLink.create'))->with('success', 'Deleted Successfully...');
        }
        elseif($data_slug == 'url_list' || $data_slug == 'product' ||  $data_slug == 'category'
                || $data_slug == 'testimonial' || $data_slug == 'blog'){

            return redirect(route('admin.commonLink.create',$request->data_slug))->with('success', 'Deleted Successfully...');
        }
        elseif(DB::table($table)->where('id', $id)->count() == 0 && $data_slug != 'top_inflatables'){
            return redirect(route('admin.commonLink.create',$request->data_slug))->with('success', 'Deleted Successfully...');
        }
        else{
            return back()->with('success', 'Deleted Successfully...');
        }
    }else{            
        return back()->with('success', 'Deleted Successfully...');

    }

    }

}

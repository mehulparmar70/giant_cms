<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Category;
use App\Models\admin\Product;
use App\Models\admin\Media;
use App\Models\admin\Pages;
use Intervention\Image\Facades\Image;

use File;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    
    // public function __construct(){
    //     $this->parent_categories = category::where(['parent_id'=>0])->orderBy('id','DESC')->get();

    // }

    // public function index()
    // {
    //     // $data = ['parent_categories' =>  $this->parent_categories];
    //     // return view('adm.pages.product.index', $data);
    // }

    public function __construct(){
        $this->products = Product::orderBy('id','DESC')->get();
        $this->parent_categories = category::where(['parent_id'=>0])->orderBy('id','DESC')->get();

    }

    public function index(Request $request)
    {
        // dd($request);
        $type = 'Product_List';
        // dd($request->image);
        $product = Product::orderBy('id')->get();
       
            $data = [
                'products' => $product,
                'parent_categories' =>  $this->parent_categories,
                'subCategory' => $request->sub_category,
                'pageData' =>  Pages::where('type', 'product_page')->first(),
                'type' => $type
            ];
            
            return view('admin.home-editor.popup-page', $data);
        // }

    }
    public function list(Request $request)
    {
        $query = Product::query();

        // Filter by main category if provided
     
        // Filter by sub-category if provided
        if ($request->filled('sub_category')) {
            $query->where('category_id', $request->sub_category); // Assuming you have a `sub_category_id` column
        }
    
        // Filter to only active products (assuming `status = 1` is active)
        $query->where('status', 1);
    
        // Fetch the filtered products
        $products = $query->get();
    
        // Return the results to a partial view
        return view('product.product-search-results', compact('products'));

    }
    public function addform(Request $request)
    {
        $type = 'Product_Add';
        // dd($request->image);
        $product = Product::orderBy('id')->get();
       
            $data = [
                'products' => $product,
                'parent_categories' =>  $this->parent_categories,
                'subCategory' => $request->sub_category,
                'pageData' =>  Pages::where('type', 'product_page')->first(),
                'type' => $type
            ];
            
            return view('admin.home-editor.popup-page', $data);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $product = category::where('id', $request->subCategory)->first();
        $subCategory = category::where('id', $request->subCategory)->get();

        
        if(isset($product) && $request->image){
            return view('adm.pages.product.image', ['product' => $product]);
        }

        elseif($subCategory->count() > 0 && $request->subCategory){
            $isProductAvailable = DB::table('products')->where('category_id', $request->subCategory)->first();
            $data = [
                'parent_categories' =>  $this->parent_categories,
                'selectedSubCategory' =>  $this->subCategory,
                'seach_id' => $request->subCategory,
                'productDetail' => $isProductAvailable
            ];

            return view('adm.pages.product.create', $data);
        }
        else{
            $data = [
                'parent_categories' =>  $this->parent_categories,
                'products' => $subCategory,
                'seach_id' => null,
                'productDetail' => null
            ];
            return view('adm.pages.product.create', $data);
        }

        $data = ['parent_categories' =>  $this->parent_categories];
        return view('adm.pages.product.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        // dd($request->input());
        if($request->status){
            $status = 1;
        }else{
            $status = 0;
        }

       

        if ($request->file('image')) {
            $image = $request->file('image');
            $image_name = time() . '_' . $image->getClientOriginalName();

            // Compress and save the image
            $image_path =    public_path('images/' . $image_name);
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
        // $isProduct = Product::where('category_id', $request->sub_category)->first();
        // dd($isProduct);
        
        // if(isset($isProduct)){
        //     $data = [
        //         'name' => $request->name,
        //         'full_description' => $request->full_description,
        //         'slug' => $request->slug,
        //         'meta_title' => $request->meta_title,
        //         'meta_keyword' => $request->meta_keyword,
        //         'meta_description' => $request->meta_description,
        //         'search_index' => $request->search_index,
        //         'search_follow' => $request->search_follow,
        //         'canonical_url' => $request->canonical_url,
        //         'status' => 1,
        //         'category_id' => $request->sub_category,
        //     ];

        //     $save = DB::table('products')->where('id', $isProduct->id)->update($data);

            
        //             return redirect(route('admin.index').'/photo?page=manage&main_category='.$request->main_category.'&sub_category='.$request->sub_category)->with('success', 'Product Details Updated...');
                

        // }else{
            // $product = Product::where('category_id', $request->category_id)->first();
          
            $product = new Product;
            $product->name = $request->name;   
            $product->full_description = $request->main_desc;
            $product->slug  = $request->slug;
            $product->meta_title  = $request->meta_title;
            $product->meta_keyword  = $request->meta_keyword;
            $product->meta_description  = $request->meta_description;
            $product->image_alt  = $request->image_alt;
            $product->image_title  = $request->image_title;
            $product->image  = $image_name;
    
            $product->search_index = $request->search_index;      
            $product->search_follow = $request->search_follow;      
            $product->canonical_url = $request->canonical_url;    
    
            $product->category_id  = $request->sub_category;
            $product->status  = 1;
            $save = $product->save();

            if($save){
                return response()->json([
                    'success' => true,
                    'message' => 'Product Created...'
                ]);
                // return back()->with('success', 'Product Details Created...');
                // return redirect(route('admin.index').'/photo?page=manage&main_category='.$request->main_category.'&sub_category='.$request->sub_category)->with('success', 'Product Details Updated...');

            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong, try again later...'
                ]);
            }
        // }
        // dd($task->id);
    }
    

    public function productImage(Request $request){
        $product = Product::find($request->id);
        // dd($product);
        // echo $request->id;

        // dd(getParentCategory($product->category_id)['subcategory']->name);
        $data = [
            'main_categories' =>  $this->parent_categories,
            'products' => $productSearch,
            'seach_id' => null
        ];
        // dd($data);

        return view('adm.pages.product.image', $data);
        return $product;
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
        $type = 'product_edit';
        $product = Product::find($id);
        $data = [
            'product' =>  $product, 
            'pageData' =>  Pages::where('type', 'product_page')->first(),
            'parent_categories' => $this->parent_categories,
            'type' => $type
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

        $request->validate([
            'name' => 'required',
            'short_description' => 'required',
            'full_description' => 'required',
            'slug' => 'required',
            'category_id' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:'.getMaxUploadSide(),
            

        ]);

        if($request->file('image')){
            $image_name = uploadTinyImageThumb($request);
        }else{
            $image_name = $request->old_image;
        }
        
        if($request->status){
            $status = 1;
        }else{
            $status = 0;
        }
        

        $product =  Product::find($id);
        $product->name = $request->name;   
        $product->short_description = $request->short_description;             
        $product->full_description = $request->full_description;      
        $product->image  = $image_name ; 
        $product->image_alt = $request->image_alt;       
        $product->image_title  = $request->image_title;
        $product->slug  = $request->slug;
        $product->meta_title  = $request->meta_title;
        $product->meta_keyword  = $request->meta_keyword;
        $product->meta_description  = $request->meta_description;

        $product->search_index = $request->search_index;      
        $product->search_follow = $request->search_follow;      
        $product->canonical_url = $request->canonical_url;    

        $product->category_id  = $request->category_id;
        $product->status  = $status;

        $save = $product->save();

        if($save){

            return response()->json([
                'success' => true,
                'message' => 'Product Updated...'
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
    public function destroy(Product $product)
    {
         if(File::exists(public_path('/').'/images/'.$product->image)){
          unlink(public_path('/').'/images/'.$product->image);
          unlink(public_path('/').'/images/'.$product->image);
          unlink(public_path('/').'/images/'.$product->image);
          unlink(public_path('/').'/images/'.$product->image);
          unlink(public_path('/').'/images/'.$product->image);

          deleteTableUrlData($product->id,'product_link');
         $product = $product->delete();
        
         return response()->json([
            'success' => true,
            'message' => 'Client Deleted...'
        ]);
        }
        else{
            deleteTableUrlData($product->id, 'product_link');
            $product = $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Product Updated...'
            ]);
            
        }

       
    }


}

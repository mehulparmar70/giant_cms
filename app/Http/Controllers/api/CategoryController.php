<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\admin\Category;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getPetaKacheri($id){
        return response()->json(category::where('parent_id',$id)->get(), 200);
    }
    public function getDepartment($id){
        return response()->json(category::where('parent_id',$id)->get(), 200);
    }

    public function getSubcategoriesNoProducts($id){

        $getSubCategories = DB::table('categories')
        ->leftJoin('products','products.category_id', '=', 'categories.id' )         
        ->where('categories.parent_id', $id)
        ->where('products.category_id', null)
        ->select('categories.*')
        ->get();
    
        return $getSubCategories;


    // $getSubCategories = DB::table('categories')
    
    // ->join('products', 'products.category_id', '=', 'categories.id')
    // ->join('media', 'media.media_id', '=', 'products.id')
    
    // ->where('categories.parent_id', $id)->get();

    // return $getSubCategories;
        
    }
    
    public function checkIsProductAvailable($id){

    $getSubCategories = DB::table('categories')
    
    
    ->join('products', 'products.category_id', '=', 'categories.id')
    ->join('products.category_id', '!=', 'categories.id' )
    ->join('media', 'media.media_id', '=', 'products.id')
    
    ->where('categories.parent_id', $id)
    ->get();

    return $getSubCategories;

    //   return  DB::table('products')->whereNotIn('categories', $id);

    }


    public function getSubCategories($id){
        
        // dd($id);
    $getSubCategories = DB::table('products')
    
    ->join('categories', 'categories.id', '!=', 'products.category_id')
    ->where('categories.parent_id', $id)
    ->whereNotIn('products.category_id', [$id])
    ->orderBy('products.id')->get();


    // dd($getSubCategories);


    // $getSubCategories = DB::table('categories')
    // ->join('products', 'products.category_id', '=', 'categories.id')
    // // ->whereNotIn(['products.category_id' => $id])
    // ->whereNotIn('products.category_id', [$id])

    // ->orderBy('categories.id')->get();

    // dd($getSubCategories);

        return response()->json(category::where('parent_id',$id)->get(), 200);

    }

    public function getSubCategoriesList($id){
        
        $response = array();
        $checked = $status = '';
        $getSubCategories = category::where('parent_id',$id)->get();

        if (count($getSubCategories) > 0) {
            $response['Code'] = 200;
            foreach ($getSubCategories as $key => $sub_category) {
               $response['SubCategories'][$key] = $sub_category;
               $response['SubCategories'][$key]['Id'] = '<input type="checkbox" class="checkList" name="checkList[]" id="checkList" value="'.$sub_category->id.'" />';
               if(getImagesFromSubCategory($sub_category->id) && getImagesFromSubCategory($sub_category->id)->count() > 0){
                    foreach(getImagesFromSubCategory($sub_category->id) as $i => $productImage){
                        if($i < 1){
                            // $response['SubCategories'][$key]['Image'] = asset('web').'/media/sm/'.$productImage->image;
                            $response['SubCategories'][$key]['Image'] = '<img class="rounded img-block m-1"  width="200" src="'.asset('/').'/images/'.$productImage->image.'"/>';
                        } else {
                            break;
                        }
                    }
                } else {
                    $response['SubCategories'][$key]['Image'] = '<img class="rounded img-block m-1"  width="200" src="'.asset().'/img/no-item.jpeg'.'"/>';
                    // $response['SubCategories'][$key]['Image'] = asset(/).'/img/no-item.jpeg';
                }

                if($sub_category->status == 1){
                    $checked = 'checked';
                    $status  = '<h5> <span class="badge badge-success">Active</span></h5>';
                } else {
                    $status  = '<h5 for="status"> <span class="badge badge-danger">Inactive</span></h5>';
                }
                          
               $response['SubCategories'][$key]['MainCategory'] = getMainCategory($sub_category->parent_id)['mainCat']->name;
               $response['SubCategories'][$key]['Status'] = '<div class="form-check"> <input type="checkbox" class="form-check-input  pull-right" name="status" id="exampleCheck1" '.$checked.' onClick="updateStatus('.$sub_category->id.')"/>'.$status.' </div>';
               // $response['SubCategories'][$key]['EditAction'] = route('admin.category.edit',$sub_category->id).'?type=sub_category&id='.getMainCategory($sub_category->parent_id)['mainCat']->id;
               // $response['SubCategories'][$key]['Action'] = route('admin.index').'/category/delete/'.$sub_category->id;
               $response['SubCategories'][$key]['Action'] = '<div class="row"> <a class="btn btn-xs btn-dark" href="'.route('admin.category.edit',$sub_category->id).'?type=sub_category&id='.getMainCategory($sub_category->parent_id)['mainCat']->id.'"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-xs btn-danger del-modal"  title="Delete Category" data-id="'.route('admin.index').'/category/delete/'.$sub_category->id.'" data-title="'.$sub_category->name.'"  data-toggle="modal" data-target="#modal-default"><i class="fa fa-trash"></i> </button></div>';;
            }
        } else {
            $response['Code'] = 400;
        }
    /*$getSubCategories = DB::table('products')
    
    ->join('categories', 'categories.id', '!=', 'products.category_id')
    ->where('categories.parent_id', $id)
    ->whereNotIn('products.category_id', [$id])
    ->orderBy('products.id')->get();*/


    // dd($getSubCategories);


    // $getSubCategories = DB::table('categories')
    // ->join('products', 'products.category_id', '=', 'categories.id')
    // // ->whereNotIn(['products.category_id' => $id])
    // ->whereNotIn('products.category_id', [$id])

    // ->orderBy('categories.id')->get();

    // dd($getSubCategories);

        return response()->json($response);

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
        $close = $request->close;
        

        if($request->status){
            $status = $request->status;
        }else{
            $status = 0;
        }

        if(isset($request->category_parent_id)){
            $parent_id = $request->category_parent_id;
        }else{
            $parent_id = 0;
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
        $status = ($request->status == null ? 0 : 1);
        $category = new Category;
        $category->name = $request->name;
        $category->description  = $request->description;
        $category->short_description  = $request->short_description;
        
        $category->image  = $image_name ; 
        $category->image_alt = $request->image_alt;      
        $category->image_title = $request->image_title;      
        $category->slug  = $request->slug;
        $category->meta_title  = $request->meta_title;
        $category->meta_keyword  = $request->meta_keyword;
        $category->meta_description  = $request->meta_description;

        $category->search_index = $request->search_index;      
        $category->search_follow = $request->search_follow;      
        $category->canonical_url = $request->canonical_url;    

        $category->status  = $status;

        $category->parent_id  = $parent_id;

        $save = $category->save();
        if($save){
            // return back()->with('success', 'New Category Added...');

            if($request->page_type == 'main_category'){
                return response()->json([
                    'success' => true,
                    'message' => 'Category Updated...'
                ]);
            }
            elseif($request->page_type == 'sub_category'){
                return response()->json([
                    'success' => true,
                    'message' => 'Category Updated...'
                ]);
            }

            if(isset($_REQUEST['onscreenCms']) && $_REQUEST['onscreenCms'] == 'true')
            {
                if ($request->close == "1") {
                    return response()->json([
                        'success' => true,
                        'message' => 'Category Updated...'
                    ]);
                } else {
                    return response()->json([
                        'success' => true,
                        'message' => 'Category Updated...'
                    ]);
                }
            }
        
            return response()->json([
                'success' => true,
                'message' => 'Category Updated...'
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
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ItemPriority;
use DB;
use File;
use Session;

class ItemPriorityController extends Controller
{
    
    public function updateItemNo(Request $request){
        // dd($request->input());
        
        $positions = $request->position;
        $data = array();
        $ItemPriority = new ItemPriority;
        $ItemPriority->updateItemPriorityModel($positions, $request->table);
    }

    public function checkProductIsEXist($id){
        $products = DB::table('products')->where('category_id', $id)->get();
        if($products){
         foreach($products as $product){
             deleteBulkImage($product->image);
             $del = DB::table('products')->where('id', $product->id)->delete();
         }
        }
        else{
        }
     }

     public function ItemBulkDeleteNo(Request $request){
     
    }

    public function ItemBulkDelete(Request $request){

            if($request->action == 'delete'){
            if(isset($request->checkList) && $request->type == 'main_category'){

                foreach($request->checkList as $deleArr){

                    $mainCat = DB::table('categories')->where('id', $deleArr)->first();
                    if(isset($mainCat)){
                        DB::table('categories')->where('id', $mainCat->id)->delete();
                        checkProductIsEXist($mainCat->id);
                        deleteChildCategory($mainCat->id);
                        deleteTableUrlData($mainCat->id, 'category_link');

                        $subCategories = DB::table('categories')->where('parent_id', $mainCat->id)->get();

                        foreach($subCategories as $subCategory){
                            checkProductIsEXist($subCategory->id);
                            deleteChildCategory($subCategory->id);
                            deleteTableUrlData($subCategory->id, 'category_link');

                            DB::table('categories')->where('id', $subCategory->id)->delete();
                            $productRanges = DB::table('categories')->where('parent_id', $subCategory->id)->get();

                            foreach($productRanges as $productRange){
                                checkProductIsEXist($productRange->id);
                                deleteChildCategory($productRange->id);
                                deleteTableUrlData($productRange->id, 'category_link');
                                DB::table('categories')->where('id', $productRange->id)->delete();
                            }
                        }
                    }
                }
            }

            elseif(isset($request->checkList) && $request->type == 'sub_category'){
                foreach($request->checkList as $deleArr){
                    $subCat = DB::table('categories')->where('id', $deleArr)->first();
                    if(isset($subCat)){
                        deleteChildCategory($subCat->id);
                        deleteTableUrlData($subCat->id, 'category_link');
                        DB::table('categories')->where('id', $subCat->id)->delete();
                        checkProductIsEXist($subCat->id);

                        $productRanges = DB::table('categories')->where('parent_id', $subCat->id)->get();

                        foreach($productRanges as $productRange){
                            checkProductIsEXist($productRange->id);
                            deleteChildCategory($productRange->id);
                            deleteTableUrlData($productRange->id, 'category_link');
                            DB::table('categories')->where('id', $productRange->id)->delete();
                            $productRanges = DB::table('categories')->where('id', $productRange->id)->get();

                        }
                    }
                }
                    return back()->with('success', 'Categories Deleted...');
            }

            elseif(isset($request->checkList) && $request->type == 'product_range'){

                foreach($request->checkList as $deleArr){
                    $productRange = DB::table('categories')->where('id', $deleArr)->first();
                    if(isset($productRange)){
                        checkProductIsEXist($productRange->id);
                        deleteChildCategory($productRange->id);
                        deleteTableUrlData($productRange->id, 'category_link');
                        DB::table('categories')->where('id', $productRange->id)->delete();
                    }
                }
                    return back()->with('success', 'Categories Deleted...');
            }

            elseif(isset($request->checkList) && $request->type == 'product'){
                foreach($request->checkList as $deleArr){
                    $product = DB::table('products')->where('id', $deleArr)->first();
                    if(isset($product)){
                        DB::table('products')->where('id', $product->id)->delete();
                        deleteTableUrlData($product->id, 'product_link');
                        deleteBulkImage($product->image);
                    }
                }
                    return back()->with('success', 'Product Deleted...');
            }
        }
        elseif(($request->action == 'active' && $request->type == 'main_category') || 
        ($request->action == 'active' && $request->type == 'sub_category')){
            foreach($request->checkList as $activeArr){
                    DB::table('categories')->where('id', $activeArr)->update(['status' => 1]);
            }
            return back()->with('success', 'Category Activated...');
        }
        
        elseif($request->action == 'active'  && $request->type == 'product'){
            foreach($request->checkList as $activeArr){
                    DB::table('products')->where('id', $activeArr)->update(['status' => 1]);
            }
            return back()->with('success', 'Category Activated...');
        }
        
        elseif(($request->action == 'deactive' && $request->type == 'main_category') || 
                    ($request->action == 'deactive' && $request->type == 'sub_category')){

            foreach($request->checkList as $activeArr){
                    DB::table('categories')->where('id', $activeArr)->update(['status' => 0]);
            }
            return back()->with('success', 'Category Activated...');
        }

        elseif($request->action == 'deactive' && $request->type == 'product'){
            // dd($request->type);
            foreach($request->checkList as $activeArr){
                    DB::table('products')->where('id', $activeArr)->update(['status' => 0]);
            }
            return back()->with('success', 'Products Deactivated...');
        }
        else{
            dd($request->acti. '=' .$request->type);
        }
        return back()->with('success', 'Item not found...');
    }
    
    
}

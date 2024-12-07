<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Intervention\Image\Facades\Image;

class StatusController extends Controller
{
    public function checkChild($id){
        $childCategories1 = DB::table('categories')->where('parent_id', $id)->get();
        $mainCategory = DB::table('categories')->where('id', $id)->first();


        if($mainCategory->status == 1){
            
            $updateMain = DB::table('categories')->where('id', $id)->update(['status' => 0]);
            

            if($updateMain){
                $childProducts1 = DB::table('products')->where('category_id', $mainCategory->id)->update(['status'=> 0]);
                $childProducts1 = DB::table('products')->where('category_id', $id)->get();
                DB::table('categories')->where('parent_id', $id)->update(['status'=> 0]);
                
                foreach($childCategories1 as $childCategories11){
                        
                    $childCategories2 = DB::table('categories')->where('parent_id', $childCategories11->id)->get();
                    $childProducts2 = DB::table('products')->where('category_id', $childCategories11->id)->update(['status'=> 0]);
                    DB::table('categories')->where('parent_id', $childCategories11->id)->update(['status'=> 0]);


                    foreach($childCategories2 as $childCategories22){
                        $childCategories3 = DB::table('categories')->where('parent_id', $childCategories22->id)->get();
                        $childProducts3 = DB::table('products')->where('category_id', $childCategories22->id)->update(['status'=> 0]);
                    }

                }
                die();
            }
        }else{

            $mainCategory = DB::table('categories')->where('id', $id)->first();
            $childProducts1 = DB::table('products')->where('category_id', $mainCategory->id)->update(['status'=> 1]);

            $childProducts1 = DB::table('products')->where('category_id', $id)->get();

            DB::table('categories')->where('id', $id)->update(['status'=> 1]);
            DB::table('categories')->where('parent_id', $id)->update(['status'=> 1]);
            foreach($childCategories1 as $childCategories11){
                    
                $childCategories2 = DB::table('categories')->where('parent_id', $childCategories11->id)->get();
                $childProducts2 = DB::table('products')->where('category_id', $childCategories11->id)->update(['status'=> 1]);
                DB::table('categories')->where('parent_id', $childCategories11->id)->update(['status'=> 1]);

                foreach($childCategories2 as $childCategories22){
                    $childCategories3 = DB::table('categories')->where('parent_id', $childCategories22->id)->get();
                    $childProducts3 = DB::table('products')->where('category_id', $childCategories22->id)->update(['status'=> 1]);
                }

            }

            die();
        }

    }

    public function updateStatus(Request $request)
    {
        // dd($request);

        $id = $request->id;
        $table =  $request->table;

        switch ($table) {
            case 'testimonial':
                $table = 'testimonials';
                break;
            case 'video':
                $table = 'videos';
                break;
            case 'industries':
                $table = 'industries';
                break;
                
            case 'top_inflatable':
                $table = 'top_inflatables';
            break;
            
            case 'slider':
                $table = 'sliders';
            break;
            
            case 'category':
                $table = 'categories';
            break;
            
            case 'blog':
                $table = 'blogs';
            break;
            
            case 'client':
                $table = 'clients';
            break;
            
            case 'video':
                $table = 'videos';
            break;
            
            case 'testimonial':
                $table = 'testimonials';
            break;

            case 'product':
                $table = 'products';
            break;
            case 'award':
                $table = 'awards';
            break;
            
            
            case 'criteria':
                $table = 'criterias';
            break;
            
            case 'criteriaMeta':
                $table = 'criteria_metas';
            break;
            
            case 'url_list':
                $table = 'url_list';
            break;
            case 'newsletters':
                $table = 'newsletters';
            break;

            case 'case_studies':
                $table = 'case_studies';
            break;
            case 'partners':
                $table = 'partners';
            break;
                        
            
            default:               
                return 'something went wrong, wrong table';
                break;
        }
        // return $id;


        // if($this->checkChild($id))
        // dd($this->checkChild($id));

            // dd(getParentCategory($id));
        

        if($table == 'categories'){
            $this->checkChild($id);
            $data = DB::table($table)->where('id', $id)->first();

            if($data->status == 0){
                $save = DB::table($table)
                ->where('id',$id)
                ->update(['status'=>!$data->status]);
    
                if($save){
                    return response()->json(['status' => 'success', 'new_status' => !$data->status]);

                }else{
                    return 'Something went wrong, try again!!!';
                }
                
            }

        }
        else{
            
            $data = DB::table($table)->where('id', $id)->first();
            $save = DB::table($table)
            ->where('id',$id)
            ->update(['status'=>!$data->status]);
            if($save){
                return ['status' => 'Status Changed...'];
            }else{
                return 'Something went wrong, try again!!!';
            }
        }

    }

    public function update_item_no($id){
        $id = $request->id;
        $table =  $request->table;

        switch ($table) {
            case 'testimonial':
                $table = 'testimonials';
                break;
            case 'video':
                $table = 'videos';
                break;
                
            case 'top_inflatable':
                $table = 'top_inflatables';
            break;
            
            case 'slider':
                $table = 'sliders';
            break;
            
            case 'category':
                $table = 'categories';
            break;
            
            case 'client':
                $table = 'clients';
            break;
            
            case 'blog':
                $table = 'blogs';
            break;
            
            case 'video':
                $table = 'videos';
            break;
            
            case 'testimonial':
                $table = 'testimonials';
            break;

            
            case 'criteria':
                $table = 'criterias';
            break;
            
            case 'criteriaMeta':
                $table = 'criteria_metas';
            break;
            
            
            
            
            default:               
                return 'something went wrong, wrong table';
                break;
            }
                 
        $i=1;
        foreach ($data as $key => $value) {
              $slider = Slider::find($value);
              $slider->slider_no = $i;
              $slider->save();
          $i++;
      }
  }

}

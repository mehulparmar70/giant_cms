<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class CriteriaMeta extends Model
{
    use HasFactory;


    function criteria($id){
        // dd(DB::table('criterias')->where('id', $id)->first()->title);
        $title = DB::table('criterias')->where('id', $id)->first();

        return $title;
        // return json_decode($title, true);
    }


    function getCategories($list){
        if($list == null){
            return null;
        }
        else{
            $categoryArrs = explode(',', $list);
            $arr = array();
            foreach($categoryArrs as $categoryArr){
                if(DB::table('categories')->where('id', $categoryArr)->first()){
                    $arr[] = DB::table('categories')->where('id', $categoryArr)->first()->name;
                }
            }
            return $arr;
        }
    }


    function getProducts($list){
        if($list == null){
            return null;
        }
        else{
            $productArrs = explode(',', $list);
            $arr = array();
            foreach($productArrs as $productArr){
                $arr[] = DB::table('products')->where('id', $productArr)->first()->name;
            }
            return $arr;
        }
    }
        
}

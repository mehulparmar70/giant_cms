<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
}

function test(){
    return 'hello';
}

function category(){
    return $this->belongsTo(Category::class);
}

function getParent($id){
        
    $category = Category::find($id);

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
}
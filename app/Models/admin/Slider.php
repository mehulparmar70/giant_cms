<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Slider extends Model
{
    use HasFactory;

    function updateSlider($data = array()){ 

        $i=1;
        foreach ($data as $key => $value) {
              DB::table('sliders')
              ->where('id',$value)
              ->update(['slider_no'=>$i]);

          $i++;
      }
    }
}

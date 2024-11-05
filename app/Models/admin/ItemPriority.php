<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class ItemPriority extends Model
{
    use HasFactory;

    // function updateSlider($data = array()){ 

    function updateItemPriorityModel($data = array(), $table){
        
        switch ($table) {
            case 'testimonials':
                $table = 'testimonials';
                break;

            case 'blogs':
                $table = 'blogs';
                break;

                case 'videos':
                    $table = 'videos';
                    break;
                case 'top_inflatable':
                    $table = 'top_inflatables';
                    break;
                
                case 'criteria':
                    $table = 'criterias';
                    break;
                case 'main_category':
                    $table = 'categories';
                    break;
                            
                    
            case 'criteriaMeta':
                $table = 'criteria_metas';
            break;
                    
            case 'clients':
                $table = 'clients';
            break;
                    
            case 'url_list':
                $table = 'url_list';
            break;

            case 'products':
                $table = 'products';
            break;

            case 'categories':
                $table = 'categories';
            break;

            case 'media':
                $table = 'media';
            break;
            case 'industries':
                $table = 'industries';
            break;
            case 'awards':
                $table = 'awards';
            break;
            case 'case_studies':
                $table = 'case_studies';
            break;
            case 'newsletters':
                $table = 'newsletters';
            break;
            case 'partners':
                $table = 'partners';
            break;
                        
            default:               
                $table = 'no-table';
                break;
        }
        $i=1;
        foreach ($data as $key => $value) {
              DB::table($table)
              ->where('id',$value)
              ->update(['item_no'=>$i]);
          $i++;
      }
    }
}

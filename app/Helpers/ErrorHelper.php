<?php
use App\Models\admin\Category;

function editPageErrorHelper($modal, $id){
    
    // function recordCount($records){
    //     dd($records);
    // }

    switch ($modal) {
        case "category":
          return Category::findOrFail($id);
          break;
        case "blue":
          echo "Your favorite color is blue!";
          break;
        case "green":
          echo "Your favorite color is green!";
          break;
        default:
          echo "Your favorite color is neither red, blue, nor green!";
      }

      
    
}
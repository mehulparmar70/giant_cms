<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\admin\Category;
use App\Models\admin\Slider;
use DB;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
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
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function update_list_no(Request $request){
        $positions = $request->position;
            // dd($data);
        $data = array();
        
        $slider = new Slider;
        $slider->updateSlider($positions);
  	    
        // $i=1;
  		// foreach ($request->input() as $key => $value) {
        //         // echo  'test';
        //         print_r($value);

        //         // $slider = Slider::find($value);
        //         // $slider->slider_no = $i;
        //         // $slider->save();
                

        //         DB::table('sliders')
        //         ->where('id',$value)
        //         ->update(['slider_no'=>$i]);



  		// 	    //  $sql = "Update sliders SET slider_no=".$i." WHERE id=".$value;
  		// 	    //  //echo $sql.'<br>';

    	// 		// 	$query = $this->db->query($sql);

		// 	$i++;
		// }

        // dd($id);
        // $slider = Slider::find($id);
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

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\TopInflatables;
use App\Models\admin\Pages;
use App\Models\admin\UrlList;
use App\Models\admin\Client;
use App\Models\admin\Category;
use App\Models\admin\Blog;
use DB;
use Intervention\Image\Facades\Image;

class HomeEditorController extends Controller
{
    
    public function topInflatableCreate()
    {
        $data = [
            'topInflatables' =>  TopInflatables::orderBy('id', 'DESC')->where('status',1)->get()
        ];
        return view('adm.pages.home-editor.top-inflatable', $data);
    }

public function topInflatableStore(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'url' => 'url|max:255',
            'image' => 'image|mimes:jpg,png,jpeg|max:'.getMaxUploadSide()
        ]);

        $slider_no = TopInflatables::orderBy('created_at', 'desc')->first();
        if($slider_no){
            $slider_no = $slider_no->id + 1;
        }else{
            $slider_no = 1;
        }

        $image_name = uploadTinyImageThumb($request);
        $topInflatable = new TopInflatables;
        $topInflatable->slider_no = $slider_no;
        $topInflatable->image = $image_name;
        $topInflatable->title = $request->title;
        $topInflatable->url = $request->url;
        $topInflatable->status = $request->status;
               
        $save = $topInflatable->save();

        if($save){
            return response()->json([
                'success' => true,
                'message' => 'Top Inflatable Added...'
            ]);
           
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, try again later...'
            ]);
        }
    }
    public function topInflatableDelete($id)
    {
        // $topInflatable = $topInflatable->delete();
        $topInflatable = DB::table('top_inflatables')->where('id',$id)->delete();

        if($topInflatable){
            return response()->json([
                'success' => true,
                'message' => 'Top Inflatable Deleted...'
            ]);
            
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, try again later...'
            ]);
        }
    }


    public function homeEditorIndex()
    {    $type = 'homeedit';
        $data = [
            'topInflatables' =>  TopInflatables::orderBy('id', 'DESC')->where('status',1)->get(),
            'homeAbout' =>  Pages::where('type', 'home_page')->first(),
            'homeUrls1' =>  UrlList::where('type', 'home_url1')->get(),
            'url_list' => UrlList::where('type', 'page_link')->where('id', 95)->where('status', 1)->first(), 
            'clients' =>  Client::where('status', 1)->get(),
            'type' => $type,
            'pageData' =>  Pages::where('type', 'home_page')->first(),
        ];
        return view('admin.home-editor.popup-page', $data);
    }
 

    public function homeEditorAboutStore(Request $request)
    {   
        $ifExist = Pages::where('type', $request->type)->first();

        // dd($request->input());
        if($ifExist){

            $homeAbout = Pages::find($ifExist->id);
            $homeAbout->type = $request->type;
            $homeAbout->description = $request->description;
            $homeAbout->url = $request->url;
            $homeAbout->meta_title  = $request->meta_title;
            $homeAbout->meta_keyword  = $request->meta_keyword;
            $homeAbout->meta_description  = $request->meta_description;

            $homeAbout->status = 1;
            $save = $homeAbout->save();
            if($save){
                return back()->with('success', 'Home About Details Updated...');
            }else{
                return back()->with('fail', 'Something went wrong, try again later...');
            }
        }
        else{
            $homeAbout = new Pages;
            $homeAbout->type = $request->type;
            $homeAbout->description = $request->description;
            $homeAbout->url = $request->url;
            $homeAbout->meta_title  = $request->meta_title;
            $homeAbout->meta_keyword  = $request->meta_keyword;
            $homeAbout->meta_description  = $request->meta_description;

            $homeAbout->status = 1;
            $save = $homeAbout->save();
            if($save){
                return response()->json([
                    'success' => true,
                    'message' => 'Home About Details Added...'
                ]);
               
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong, try again later...'
                ]);
            }
        }
    }


    
    
    public function urlListStore1(Request $request){
        $urlList = new UrlList;
        $urlList->type = $request->type;
        $urlList->title = $request->title;
        $urlList->url = $request->url;
        $urlList->target = $request->target;
        $urlList->status = $request->status;
        $save = $urlList->save();

        if($save){
            return response()->json([
                'success' => true,
                'message' => 'Top Inflatable Added...'
            ]);
           
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, try again later...'
            ]);
        }
    }
    
    
    public function urlListDelete1($id){
        $urlList = DB::table('url_list')->where('id',$id)->delete();

        if($urlList){
            return response()->json([
                'success' => true,
                'message' => 'Url Deleted...'
            ]);
           
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, try again later...'
            ]);
        }
    }
    

}
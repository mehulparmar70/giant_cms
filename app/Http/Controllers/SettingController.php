<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\SocialMedia;
use App\Models\admin\WebsiteOption;
use Intervention\Image\Facades\Image;
use App\Models\admin\Pages;

class SettingController extends Controller
{
    
    public function socialMediaIndex()
    {
        $type = 'SocialMedia';
        $data = [
            'pageData' =>  Pages::where('type', 'client_page')->first(),
            'socialMedia' =>  SocialMedia::first(),
            'type' => $type
        ];
        return view('admin.home-editor.popup-page', $data);
    }


    
    public function seoManageIndex()
    {
        $type = 'SocialMediaManagers';
        $data = [
            'socialMedia' =>  SocialMedia::first(),
            'website_logo' =>  WebsiteOption::where('option_name', 'logo')->first(),
            'website_favicon' =>  WebsiteOption::where('option_name', 'favicon')->first(),
            'type' => $type
            
        ];

        return view('admin.home-editor.popup-page', $data);
    }

    public function seoManageStore(Request $request)
    {
      
        $sitemap = uploadAnyFile($request, $name = 'sitemap', $saveName = 'sitemap', $path = public_path('/'));
        $robots_txt = uploadAnyFile($request, $name = 'robots_txt', $saveName = 'robots', $path = public_path('/'));
        
        if($request->file('sitemap')){
            $websiteSitemap = WebsiteOption::where('option_name', 'sitemap')->update(['option_value' => $sitemap]);
        }

        if($request->file('robots_txt')){
            $website_robots_txt = WebsiteOption::where('option_name', 'robots_txt')->update(['option_value' => $robots_txt]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Website Sitemap & Robots.txt Updated...'
        ]);
        // return back()->with('success', 'Website Sitemap & Robots.txt Updated...');

    }

    public function seoManageImageStore(Request $request)
    {
      

        $logo_name = uploadAnyFile($request, $name = 'logo', $saveName = 'logo', $path = public_path('img').'');
        $favicon_name = uploadAnyFile($request, $name = 'favicon', $saveName = 'logo-icon', $path = public_path('img').'');

        // dd($logo_name.'---'.$favicon_name);

        if($request->file('logo')){
            $websiteLogo = WebsiteOption::where('option_name', 'logo')->update(['option_value' => $logo_name]);
        }
        else{
            $websiteLogo = $request->old_logo;
        }

        if($request->file('favicon')){
            $websiteFavicon = WebsiteOption::where('option_name', 'favicon')->update(['option_value' => $favicon_name]);
        }else{
            $websiteFavicon = $request->old_favicon;
        }


        return response()->json([
            'success' => true,
            'message' => 'Website Image & Favicon Updated...'
        ]);
        // return back()->with('success', 'Website Image & Favicon Updated...');

    }
    
    
    public function socialMediaStore(Request $request)
    {
       
        
        $socialMedia = new SocialMedia;
        $last_id = $socialMedia::orderBy('id','desc')->first();

        if ($socialMedia->count() != 0) {
            $socialMedia = SocialMedia::find($last_id->id);
        }
        
        $telegram = "https://t.me/joinchat";
        $mystring = $request->telegram_group;
        if(strpos($mystring, $telegram) !== false){
            $telegram = str_replace($telegram,"https://telegram.me/joinchat",$request->telegram_group);
        }else{
            $telegram = $request->telegram_group;
        }
        
        $socialMedia->facebook = $request->facebook;
        $socialMedia->instagram = $request->instagram;
        $socialMedia->twitter = $request->twitter;
        $socialMedia->youtube = $request->youtube;
        $socialMedia->linkedin = $request->linkedin;
        $socialMedia->pinterest = $request->pinterest;
        $socialMedia->skype = $request->skype;
        
        $socialMedia->email = $request->email;
        $socialMedia->phone = $request->phone;
        $socialMedia->whatsapp = $request->whatsapp;
        $socialMedia->whatsapp_group = $request->whatsapp_group;
        $socialMedia->address = $request->address;
        
        $socialMedia->address = $request->address;
        $socialMedia->facebook_embed = $request->facebook_embed;
        $socialMedia->youtube_embed = $request->youtube_embed;
        $socialMedia->tinypng = $request->tinypng;
        $socialMedia->map_embed = $request->map_embed;
        $socialMedia->product_title = $request->product_title;

        $save = $socialMedia->save();
        if($save){
            return response()->json([
                'success' => true,
                'message' => 'Social Media Updated...'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, try again later...'
            ]);
        }
    }
}

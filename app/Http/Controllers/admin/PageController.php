<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Pages;
use App\Models\admin\UrlList;
use Intervention\Image\Facades\Image;
use GeneaLabs\NovaGutenberg\Gutenberg;
use App\Models\admin\Partners;

use App\Models\admin\Video;


class PageController extends Controller
{
    public function productPageEditor(){
        $type = 'Product';
        $data = [
            'pageData' =>  Pages::where('type', 'product_page')->first(),
            'url_list' =>  UrlList::where('type', 'page_link')->where('id',96)->where('status',1)->first(),
            'type' => $type,
        ];
        return view('admin.home-editor.popup-page', $data);
    }

    public function aboutPageEditor(){
        $type = 'About';
        $data = [
            'pageData' =>  Pages::where('type', 'about_page')->first(),
            'url_list' =>  UrlList::where('type', 'page_link')->where('id',97)->where('status',1)->first(),
            'type' => $type,
        ];
        return view('admin.home-editor.popup-page', $data);
    }

    public function testimonialPageEditor(){
        $type = 'Testimonial';
        $data = [
            'pageData' =>  Pages::where('type', 'testimonial_page')->first(),
            'url_list' =>  UrlList::where('type', 'page_link')->where('id',98)->where('status',1)->first(),
            'type' => $type,
        ];
        return view('admin.home-editor.popup-page', $data);
    }
    
    public function videoPageEditor(){
        $type = 'Video_Page';
        $data = [
            'pageData' =>  Pages::where('type', 'video_page')->first(),
            'type' => $type,
            'url_list' =>  UrlList::where('type', 'page_link')->where('id',99)->where('status',1)->first(),
            'videos' =>  Video::orderBy('item_no')->get()
        ];
        return view('admin.home-editor.popup-page', $data);
    }

    public function blogPageEditor(){
        $type = 'Blog_Page';
        $data = [
            'pageData' =>  Pages::where('type', 'blog_page')->first(),
            'url_list' =>  UrlList::where('type', 'page_link')->where('id',113)->where('status',1)->first(),
            'type' => $type,
        ];
        return view('admin.home-editor.popup-page', $data);
    }

    public function partenrsPageEditor(){
        $type = 'partners';
        $data = [
            'pageData' =>  Pages::where('type', 'partenr_page')->first(),
            'type' => $type,
            'url_list' =>  UrlList::where('type', 'page_link')->where('id',106)->where('status',1)->first(),
            'blogs' =>  Partners::orderBy('item_no', 'ASC')->get()
        ];
        return view('admin.home-editor.popup-page', $data);
    }
    public function contactPageEditor(){
        $type = 'Contact';
        $data = [
            'pageData' =>  Pages::where('type', 'contact_page')->first(),
            'url_list' =>  UrlList::where('type', 'page_link')->where('id',101)->where('status',1)->first(),
            'type' => $type,
        ];
        return view('admin.home-editor.popup-page', $data);
    }
    public function casestudiesPageEditor(){
        $type = 'CaseStudies';
        $data = [
            'pageData' =>  Pages::where('type', 'casestudies_page')->first(),
            'url_list' =>  UrlList::where('type', 'page_link')->where('id',100)->where('status',1)->first(),
            'type' => $type,
        ];
        return view('admin.home-editor.popup-page', $data);
    }
    public function newsletterPageEditor(){
        $type = 'Editnewsletter';
   
        $data = [
            'pageData' =>  Pages::where('type', 'newsletter_page')->first(),
            'url_list' =>  UrlList::where('type', 'page_link')->where('id',105)->where('status',1)->first(),
            'type' => $type,
        ];
        return view('admin.home-editor.popup-page', $data);
    }
    public function industriePageEditor(){
        $type = 'IndustriesPage';
        $data = [
            'pageData' =>  Pages::where('type', 'industrie_page')->first(),
            'type' => $type,
        ];
        return view('admin.home-editor.popup-page', $data);
    }
    public function updatesPageEditor(){
        $data = [
            'pageData' =>  Pages::where('type', 'updates_page')->first(),
        ];
        return view('admin.home-editor.popup-page', $data);
    }
    public function clientPageEditor(){
        $type = 'EditClient';
        $data = [
            'type' => $type,
            'url_list' =>  UrlList::where('type', 'page_link')->where('id',102)->where('status',1)->first(),
            'pageData' =>  Pages::where('type', 'client_page')->first(),
        ];
        return view('admin.home-editor.popup-page', $data);
    }
    public function awardsPageEditor(){
        $type = 'EditAward';
        $data = [
            'url_list' =>  UrlList::where('type', 'page_link')->where('id',103)->where('status',1)->first(),
            'pageData' =>  Pages::where('type', 'award_page')->first(),
            'type' => $type,
        ];
        return view('admin.home-editor.popup-page', $data);
    }

    // public function pageEditorStore(Request $request){
        
    //     // dd($request);
    //     /*dd($request->all());
    //     exit();*/
        
    //     $page_title = $request->page_title;
    //     $ifExist = Pages::where('type', $request->type)->first();

    //     if($ifExist){
    //         if($request->file('image')){
    //             $image_name = uploadTinyImageThumb($request);
    //             // print_r($image_name.'---');
    //             // exit();
    //             deleteBulkImage($request->old_image);
    //         }else{
    //             $image_name = $request->old_image;
    //         }
    //         // print_r($image_name.'---12');
    //         // exit();
    //     // dd($request->file('image'));
    //         $pageEditor = Pages::find($ifExist->id);
    //         $pageEditor->type = $request->type;
    //         $pageEditor->description = $request->description;
    //         $pageEditor->url = $request->url;
    //         $pageEditor->featured_image = $image_name;
            
    //         $pageEditor->image_alt = $request->image_alt;      
    //         $pageEditor->image_title = $request->image_title;   

    //         $pageEditor->search_index = $request->search_index;   
    //         $pageEditor->search_follow = $request->search_follow;   
    //         $pageEditor->canonical_url = $request->canonical_url;   
    //         $pageEditor->page_title = isset($page_title)?$page_title:NULL;
            
    //         $pageEditor->meta_title  = $request->meta_title;
    //         $pageEditor->meta_keyword  = $request->meta_keyword;
    //         $pageEditor->meta_description  = $request->meta_description;
    //         $pageEditor->status = 1;
    //         $save = $pageEditor->save();
    //         if($save){
             
    //             if ($request->close == "1") {
    //                 $pageType = $request->type;
    //                 $pos = strpos($pageType, '_');
    //                 $pageType = substr($pageType, 0, $pos === false ? strlen($pageType) : $pos);
    //                 session()->put('success',$pageType.' Details Updated...');
    //                 // return(redirect(route('admin.close')));
    //                 return response()->json(['success' => true, 'message' => $message]);
    //             } else {
    //                 // exit();
    //                 return back()->with('success', $request->type.' Details Updated...');
    //             }
    //         }else{
    //             return back()->with('fail', 'Something went wrong, try again later...');
    //         }
    //     }
    //     else{
    //         if($request->file('image')){
    //             $image_name = uploadTinyImageThumb($request);
    //         }else{
    //             $image_name = $request->old_image;
    //         }

    //         // dd($image_name);
    //         $pageEditor = new Pages;
    //         $pageEditor->type = $request->type;
    //         $pageEditor->description = $request->description;
    //         $pageEditor->url = $request->url;
    //         $pageEditor->featured_image = $image_name;

    //         $pageEditor->image_alt = $request->image_alt;      
    //         $pageEditor->image_title = $request->image_title;   

    //         $pageEditor->meta_title  = $request->meta_title;
    //         $pageEditor->meta_keyword  = $request->meta_keyword;
    //         $pageEditor->meta_description  = $request->meta_description;
    //         $pageEditor->status = 1;
    //         $save = $pageEditor->save();
    //         if($save){
    //             if ($request->close == "1") {
    //                 $pageType = $request->type;
    //                 $pos = strpos($pageType, '_');
    //                 $pageType = substr($pageType, 0, $pos === false ? strlen($pageType) : $pos);
    //                 session()->put('success',$pageType.' Details Added...');
    //                 // return(redirect(route('admin.close')));
    //                 return response()->json(['success' => true, 'message' => $message]);
    //             } else {
    //                 return back()->with('success', $request->type.' Details Added...');
    //             }
    //         }else{
    //             return back()->with('fail', 'Something went wrong, try again later...');
    //         }
    //     }
    // }

    public function pageEditorStore(Request $request) {
        // dd($request);
        $newUrl = $request->page_url;
        $menuname = $request->name;
        $newName = $request->page_name;
        UrlList::where('type', 'page_link')
                ->where('name', $newName)
                ->where('status', 1)
                ->update(['url' => $newUrl,'name'=>$menuname]);


                $ifExist = Pages::where('type', $request->type)->first();

                if ($ifExist) {
                    // Check if a new image is uploaded
                    if ($request->file('image')) {
                        $image = $request->file('image');
                        $image_name = time() . '_' . $image->getClientOriginalName();
            
                        // Compress and save the image
                        $image_path = public_path('images/' . $image_name);
                        Image::make($image)
                            ->resize(1200, null, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            })
                            ->save($image_path, 75); // 75% quality
            
                        // Delete the old image if it exists
                        if ($request->old_image && file_exists(public_path('images/' . $request->old_image))) {
                            unlink(public_path('images/' . $request->old_image));
                        }
                    } else {
                        // If no new image is uploaded, use the old image
                        $image_name = $request->old_image;
                    }
            
                    // Update the existing page with new data
                    $pageEditor = Pages::find($ifExist->id);
                    $pageEditor->type = $request->type;
                    $pageEditor->description = $request->description;
                    $pageEditor->subtitle = $request->short_description;
                    $pageEditor->url = $request->page_urls;
                    $pageEditor->featured_image = $image_name;
                    $pageEditor->image_alt = $request->image_alt;
                    $pageEditor->image_title = $request->image_title;
                    $pageEditor->search_index = $request->search_index;
                    $pageEditor->search_follow = $request->search_follow;
                    $pageEditor->canonical_url = $request->canonical_url;
                    $pageEditor->page_title = isset($page_title) ? $page_title : NULL;
                    $pageEditor->meta_title = $request->meta_title;
                    $pageEditor->meta_keyword = $request->meta_keyword;
                    $pageEditor->meta_description = $request->meta_description;
                    $pageEditor->status = 1;
                    
                    $save = $pageEditor->save();
            
                    if ($save) {
                        if ($request->close == "1") {
                            $pageType = $request->type;
                            $pos = strpos($pageType, '_');
                            $pageType = substr($pageType, 0, $pos === false ? strlen($pageType) : $pos);
                            return response()->json([
                                'success' => true,
                                'message' => 'Detail Updated...'
                            ]);
                        } else {
                            return response()->json([
                                'success' => true,
                                'message' => 'Detail Updated...'
                            ]);
                        }
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Something went wrong, try again later...'
                        ]);
                    }
                } else {
                    // If no page exists, create a new one
                    if ($request->file('image')) {
                        $image = $request->file('image');
                        $image_name = time() . '_' . $image->getClientOriginalName();
            
                        // Compress and save the image
                        $image_path = public_path('images/' . $image_name);
                        Image::make($image)
                            ->resize(1200, null, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            })
                            ->save($image_path, 75); // 75% quality
                    } else {
                        $image_name = $request->old_image;
                    }
            
                    $pageEditor = new Pages;
                    $pageEditor->type = $request->type;
                    $pageEditor->description = $request->description;
                    $pageEditor->url = $request->url;
                    $pageEditor->subtitle = $request->short_description;
                    $pageEditor->featured_image = $image_name;
                    $pageEditor->image_alt = $request->image_alt;
                    $pageEditor->image_title = $request->image_title;
                    $pageEditor->meta_title = $request->meta_title;
                    $pageEditor->meta_keyword = $request->meta_keyword;
                    $pageEditor->meta_description = $request->meta_description;
                    $pageEditor->status = 1;
            
                    $save = $pageEditor->save();
            
                    if ($save) {
                        if ($request->close == "1") {
                            $pageType = $request->type;
                            $pos = strpos($pageType, '_');
                            $pageType = substr($pageType, 0, $pos === false ? strlen($pageType) : $pos);
                            return response()->json([
                                'success' => true,
                                'message' => 'Detail Added...'
                            ]);
                        } else {
                            return response()->json([
                                'success' => true,
                                'message' => 'Detail Added...'
                            ]);
                        }
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Something went wrong, try again later...'
                        ]);
                    }
                }

        // Get the page title from the request
        // $page_title = $request->page_title;
        
        // // Check if a page with the given type already exists
        // $ifExist = Pages::where('type', $request->type)->first();
    
        // if ($ifExist) {
        //     // Check if a new image is uploaded
        //     if ($request->file('image')) {
        //         $image = $request->file('image');
        //         $image_name = time() . '_' . $image->getClientOriginalName();
    
        //         // Compress and save the image
        //         $image_path = public_path('images/' . $image_name);
        //         Image::make($image)
        //             ->resize(1200, null, function ($constraint) {
        //                 $constraint->aspectRatio();
        //                 $constraint->upsize();
        //             })
        //             ->save($image_path, 75); // 75% quality
    
        //         // Delete the old image if it exists
        //         if ($request->old_image && file_exists(public_path('images/' . $request->old_image))) {
        //             unlink(public_path('images/' . $request->old_image));
        //         }
        //     } else {
        //         // If no new image is uploaded, use the old image
        //         $image_name = $request->old_image;
        //     }
    
        //     // Update the existing page with new data
        //     $pageEditor = Pages::find($ifExist->id);
        //     $pageEditor->type = $request->type;
        //     $pageEditor->description = $request->description;
        //     $pageEditor->url = $request->url;
        //     $pageEditor->featured_image = $image_name;
        //     $pageEditor->image_alt = $request->image_alt;
        //     $pageEditor->image_title = $request->image_title;
        //     $pageEditor->search_index = $request->search_index;
        //     $pageEditor->search_follow = $request->search_follow;
        //     $pageEditor->canonical_url = $request->canonical_url;
        //     $pageEditor->page_title = isset($page_title) ? $page_title : NULL;
        //     $pageEditor->meta_title = $request->meta_title;
        //     $pageEditor->meta_keyword = $request->meta_keyword;
        //     $pageEditor->meta_description = $request->meta_description;
        //     $pageEditor->status = 1;
            
        //     $save = $pageEditor->save();
    
        //     if ($save) {
        //         if ($request->close == "1") {
        //             $pageType = $request->type;
        //             $pos = strpos($pageType, '_');
        //             $pageType = substr($pageType, 0, $pos === false ? strlen($pageType) : $pos);
        //             session()->put('success', $pageType . ' Details Updated...');
        //             return back()->with('success', $request->type . ' Details Updated...');
        //         } else {
        //             return back()->with('success', $request->type . ' Details Updated...');
        //         }
        //     } else {
        //         return back()->with('fail', 'Something went wrong, try again later...');
        //     }
        // } else {
        //     // If no page exists, create a new one
        //     if ($request->file('image')) {
        //         $image = $request->file('image');
        //         $image_name = time() . '_' . $image->getClientOriginalName();
    
        //         // Compress and save the image
        //         $image_path = public_path('images/' . $image_name);
        //         Image::make($image)
        //             ->resize(1200, null, function ($constraint) {
        //                 $constraint->aspectRatio();
        //                 $constraint->upsize();
        //             })
        //             ->save($image_path, 75); // 75% quality
        //     } else {
        //         $image_name = $request->old_image;
        //     }
    
        //     $pageEditor = new Pages;
        //     $pageEditor->type = $request->type;
        //     $pageEditor->description = $request->description;
        //     $pageEditor->url = $request->url;
        //     $pageEditor->featured_image = $image_name;
        //     $pageEditor->image_alt = $request->image_alt;
        //     $pageEditor->image_title = $request->image_title;
        //     $pageEditor->meta_title = $request->meta_title;
        //     $pageEditor->meta_keyword = $request->meta_keyword;
        //     $pageEditor->meta_description = $request->meta_description;
        //     $pageEditor->status = 1;
    
        //     $save = $pageEditor->save();
    
        //     if ($save) {
        //         if ($request->close == "1") {
        //             $pageType = $request->type;
        //             $pos = strpos($pageType, '_');
        //             $pageType = substr($pageType, 0, $pos === false ? strlen($pageType) : $pos);
        //             session()->put('success', $pageType . ' Details Added...');
        //             return response()->json(['success' => true, 'message' => $pageType . ' Details Added...']);
        //         } else {
        //             return back()->with('success', $request->type . ' Details Added...');
        //         }
        //     } else {
        //         return back()->with('fail', 'Something went wrong, try again later...');
        //     }
        // }
    }
    

    // public function pageEditorStore(Request $request) {
    
    //     // Get the page title from the request
    //     $page_title = $request->page_title;
        
    //     // Check if a page with the given type already exists
    //     $ifExist = Pages::where('type', $request->type)->first();
    
    //     if ($ifExist) {
    //         // Check if a new image is uploaded
    //         if ($request->file('image')) {
    //             $image = $request->file('image');
    //             $image_name = time() . '_' . $image->getClientOriginalName();
    //             $image->move(public_path('images'), $image_name);  // Save the image to the 'images' directory
    
    //             // Delete the old image if it exists
    //             if ($request->old_image && file_exists(public_path('images/' . $request->old_image))) {
    //                 unlink(public_path('images/' . $request->old_image));
    //             }
    //         } else {
    //             // If no new image is uploaded, use the old image
    //             $image_name = $request->old_image;
    //         }
    
    //         // Update the existing page with new data
    //         $pageEditor = Pages::find($ifExist->id);
    //         $pageEditor->type = $request->type;
    //         $pageEditor->description = $request->description;
    //         $pageEditor->url = $request->url;
    //         $pageEditor->featured_image = $image_name;
    //         $pageEditor->image_alt = $request->image_alt;
    //         $pageEditor->image_title = $request->image_title;
    //         $pageEditor->search_index = $request->search_index;
    //         $pageEditor->search_follow = $request->search_follow;
    //         $pageEditor->canonical_url = $request->canonical_url;
    //         $pageEditor->page_title = isset($page_title) ? $page_title : NULL;
    //         $pageEditor->meta_title = $request->meta_title;
    //         $pageEditor->meta_keyword = $request->meta_keyword;
    //         $pageEditor->meta_description = $request->meta_description;
    //         $pageEditor->status = 1;
            
    //         $save = $pageEditor->save();
    
    //         if ($save) {
    //             if ($request->close == "1") {
    //                 $pageType = $request->type;
    //                 $pos = strpos($pageType, '_');
    //                 $pageType = substr($pageType, 0, $pos === false ? strlen($pageType) : $pos);
    //                 session()->put('success', $pageType . ' Details Updated...');
    //                 return back()->with('success', $request->type . ' Details Updated...');
    //             } else {
    //                 return back()->with('success', $request->type . ' Details Updated...');
    //             }
    //         } else {
    //             return back()->with('fail', 'Something went wrong, try again later...');
    //         }
    //     } else {
    //         // If no page exists, create a new one
    //         if ($request->file('image')) {
    //             $image = $request->file('image');
    //             $image_name = time() . '_' . $image->getClientOriginalName();
    //             $image->move(public_path('images'), $image_name);  // Save the image to the 'images' directory
    //         } else {
    //             $image_name = $request->old_image;
    //         }
    
    //         $pageEditor = new Pages;
    //         $pageEditor->type = $request->type;
    //         $pageEditor->description = $request->description;
    //         $pageEditor->url = $request->url;
    //         $pageEditor->featured_image = $image_name;
    //         $pageEditor->image_alt = $request->image_alt;
    //         $pageEditor->image_title = $request->image_title;
    //         $pageEditor->meta_title = $request->meta_title;
    //         $pageEditor->meta_keyword = $request->meta_keyword;
    //         $pageEditor->meta_description = $request->meta_description;
    //         $pageEditor->status = 1;
    
    //         $save = $pageEditor->save();
    
    //         if ($save) {
    //             if ($request->close == "1") {
    //                 $pageType = $request->type;
    //                 $pos = strpos($pageType, '_');
    //                 $pageType = substr($pageType, 0, $pos === false ? strlen($pageType) : $pos);
    //                 session()->put('success', $pageType . ' Details Added...');
    //                 return response()->json(['success' => true, 'message' => $pageType . ' Details Added...']);
    //             } else {
    //                 return back()->with('success', $request->type . ' Details Added...');
    //             }
    //         } else {
    //             return back()->with('fail', 'Something went wrong, try again later...');
    //         }
    //     }
    // }
    
}

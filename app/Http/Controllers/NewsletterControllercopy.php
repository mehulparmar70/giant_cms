<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Newsletter;

class NewsletterController extends Controller
{
    public function index()
    {
        
        $data = [
            'testimonials' =>  Newsletter::orderBy('item_no')->get()
        ];
        return view('adm.pages.newsletter.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['testimonials' =>  Newsletter::all()];
        return view('adm.pages.newsletter.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $file_name = uploadAnyFile($request, $name = 'file', $saveName = date("Ymdhis"), $path = public_path('web/Newsletter').'');
        /*$destinationPath = public_path('/web/Newsletter');
        $file = $request->file('file');
        $file->move($destinationPath,$file->getClientOriginalName());*/


        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp',
            'slug' => "required|unique:newsletters,slug",
        ]);

         
        $item_no = Newsletter::orderBy('item_no', 'desc')->first();

        if($item_no){
            $item_no =  $item_no->item_no + 1;
        }else{
            $item_no = 1;
        }
        

        if($request->status){
            $status = 1;
        }else{
            $status = 0;
        }

        $image_name = uploadTinyImageThumb($request);
        // $file_name = uploadAnyFile($request, $name = 'file', $saveName = date("Ymdhis"), $path = public_path('/web/Newsletter'));

        $Newsletter = new Newsletter;
        $Newsletter->item_no = $item_no;
        $Newsletter->title = $request->title;
        $Newsletter->short_description = $request->short_description;
        $Newsletter->full_description= $request->full_description;
        $Newsletter->image = $image_name;
        // $Newsletter->file_name = $file_name;
        $Newsletter->slug = $request->slug;
        $Newsletter->meta_title = $request->meta_title;
        $Newsletter->meta_keyword = $request->meta_keyword;
        $Newsletter->meta_description = $request->meta_description;
        $Newsletter->search_index = $request->search_index;
        $Newsletter->search_follow = $request->search_follow;
        $Newsletter->canonical_url = $request->canonical_url;
        $Newsletter->image_alt = $request->image_alt;      
        $Newsletter->image_title = $request->image_title;  
        $Newsletter->status = $status;

        $save = $Newsletter->save();

        if($save){
            if ($request->close == "1") {
                session()->put('success','Newsletter Added...');
                return(redirect(route('admin.close')));
            } else {
                return back()->with('success', 'Newsletter Added...');
            }
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial = Newsletter::find($id);
        $data = [
            'testimonial' =>  $testimonial
        ];

        if($testimonial){
            return view('adm.pages.newsletter.edit', $data);
        }else{
            return redirect(route('newsletter.index'))->with('fail', 'Testimonials Not Available...');
        }
        
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

        $request->validate([
            
        ]);

        $item_no = Newsletter::orderBy('item_no', 'desc')->first();
        if($item_no){
            $item_no =  $item_no->item_no + 1;
        }else{
            $item_no = 1;
        }

        if($request->status == 'on'){
            $status = 1;
        }else{
            $status = 0;
        }

        if($request->file('image')){
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
            $image_name = $request->old_image;
        }
        /*if($request->file('file')){
            // dd($request->old_image);
            $file_name = uploadAnyFile($request, $name = 'file', $saveName = date("Ymdhis"), $path = public_path('/web/Newsletter'));
            deleteBulkImage($request->old_file);
        }else{
            $file_name = $request->old_file;
        }*/
        
        $Newsletter = Newsletter::find($id);
        $Newsletter->item_no = $item_no;
        $Newsletter->title = $request->title;
        $Newsletter->short_description = $request->short_description;
        $Newsletter->full_description= $request->full_description;
        $Newsletter->image = $image_name;
        // $Newsletter->file_name = $file_name;
        $Newsletter->slug = $request->slug;
        $Newsletter->meta_title = $request->meta_title;
        $Newsletter->meta_keyword = $request->meta_keyword;
        $Newsletter->meta_description = $request->meta_description;
        $Newsletter->search_index = $request->search_index;
        $Newsletter->search_follow = $request->search_follow;
        $Newsletter->canonical_url = $request->canonical_url;
        $Newsletter->image_alt = $request->image_alt;      
        $Newsletter->image_title = $request->image_title;  
        $Newsletter->status = $status;

        $save = $Newsletter->save();

        if($save){
            if ($request->close == "1") {
                session()->put('success','Newsletter Updated...');
                return(redirect(route('admin.close')));
            } else {
                return back()->with('success', 'Newsletter Updated...');
            }
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Newsletter $Newsletter)
    {
        /*dd($Newsletter);
        exit();*/
        
        deleteTableUrlData($Newsletter->id, 'newsletter_link');

        $delete = $Newsletter->delete();
        
        if($delete){
            deleteBulkImage($Newsletter->image);
            return back()->with('success', 'Newsletter Deleted...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }


        // $video = $video->delete();
        // if($video){
        //     return back()->with('success', 'Video Deleted...');
        // }else{
        //     return back()->with('fail', 'Something went wrong, try again later...');
        // }

    }

    public function deleteItem(Request $request,$id)
    {
            $Newsletter = Newsletter::find($id);
            if($Newsletter){
            deleteTableUrlData($Newsletter->id, 'newsletter_link');
            $delete = $Newsletter->delete();
            if($delete){
                deleteBulkImage($Newsletter->image);
                if($request->ajax())
                {
                    return response()->json(['success' => 'Content Deleted Successfully']);
                } else {
                    return back()->with('success', 'Newsletter Deleted...');
                }
            }
            else{
                return back()->with('fail', 'Something went wrong, try again later...');
            }
        }
        else{
            return redirect(route('index'));
        }
    }
}

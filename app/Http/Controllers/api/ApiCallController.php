<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Models\admin\Media;
use App\Models\admin\Contactus;
use DB;
use Session;
use Intervention\Image\Facades\Image;

class ApiCallController extends Controller
{
    // public function sendContact(Request $request){
    //     // dd($request->all());

    //     // New code for captcha
    //     // checkEmailFilter();
 
    //     $emailArray = explode(", ",checkEmailFilter()->email);
        
    //     if( in_array( $request->email ,$emailArray ) )
    //     {
    //         return ['status' => 'fail', 'message' => $request->email.'found'];
    //     }
    //     else{
    //         if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['token_response'])){
    //             // return ($request->input());
    //             $url='https://www.google.com/recaptcha/api/siteverify';
    //             $secret='6Leh9bkUAAAAAOyJzjm921a2KlmNuiBZ5OzkD0cX';
    //             $recaptcha_response=$_POST['token_response'];
                
    //             $requestRecaptcha = file_get_contents($url . '?secret=' . $secret . '&response=' . $recaptcha_response);
    //             $response = json_decode($requestRecaptcha);
                
    //             if($response->success==true && $response->score >= 0.5){
    //                 $to = 'sales@giantinflatables.ae, sales@giantinflatables.in, krutarth@live.com ';                     

    //                 sendMailNotification('contact_inquiry', $to, 'Inquiry From: '.$request->name,
    //                     ['name'=>$request->name,
    //                     'phone'=>$request->phone,
    //                     'email' => $request->email,
    //                     'country' => $request->country,
    //                     'msg' => $request->message,
    //                     'page_url' => $request->page_url,
    //                 ]);
                    
    //                 $add = new contactus;
    //                 $add->full_name = $request->name;
    //                 $add->country = $request->country;
    //                 $add->phone_no = $request->phone;
    //                 $add->email = $request->email;
    //                 $add->message = $request->message;
    //                 $add->page_url = $request->page_url;
    //                 $add->status = 'success';
    //                 $add->save();
    //                 return back()->with('success', 'Thank you for showing interest in our work and sending 
    //                 us the quote request. We will get back to you within 24 hours.');
    //                 return('success');
    //                 return ['status' => 'success', 'message' => 'Thank you for showing interest in our work and sending 
    //                 us the quote request. We will get back to you within 24 hours.'];
    //             }
    //             else{
                    
                  
    //                 $add = new contactus;
    //                 $add->full_name = $request->name;
    //                 $add->country = $request->country;
    //                 $add->phone_no = $request->phone;
    //                 $add->email = $request->email;
    //                 $add->message = $request->message;
    //                 $add->page_url = $request->page_url;
    //                 $add->status = 'fail';
    //                 $add->save();
    //                 return back()->with('fail', 'Thank you for showing interest in our work and sending 
    //                 us the quote request. We will get back to you within 24 hours.');
    //                 return('success');
    //                 return ['status' => 'fail', 'message' => 'Thank you for showing interest in our work and sending 
    //                 us the quote request. We will get back to you within 24 hours.'];   
    //             }   
    //         }
    //     }


    //     // return checkEmailFilter();


    //     // // return ($request->input());
     

    //     // $to = 'sales@giantinflatables.in';

    //     // sendMailNotification('contact_inquiry', $to, 'Inquiry From: '.$request->name,
    //     //         ['name'=>$request->name, 'phone'=>$request->phone,
    //     //         'email' => $request->email,
    //     //         'country' => $request->country,
    //     //         'msg' => $request->message,
    //     //         'page_url' => $request->page_url,

    //     // ]);

    //     // return back()->with('success', 'Contact Inquiry Sent...');
    // }

    public function sendContact(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'name' => 'required|string',
        'phone' => 'nullable|string',
        'email' => 'nullable|email',
        'country' => 'nullable|string',
        'message' => 'nullable|string',
        'token_response' => 'required|string', // Captcha response
    ]);

    // Handle Cloudflare Turnstile validation
    $turnstileResponse = $request->input('token_response');
    $secretKey = '0x4AAAAAAA029Z3KTwy3UWm2gh4L04U_raY'; // Replace with your actual Cloudflare secret key
    $url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
    $response = file_get_contents("{$url}?secret={$secretKey}&response={$turnstileResponse}");
    $responseKeys = json_decode($response, true);

    // Check if the CAPTCHA validation is successful
    if (isset($responseKeys['success']) && $responseKeys['success'] == true) {
        // Proceed with sending the email
                    // $to = 'sales@giantinflatables.ae, sales@giantinflatables.in, krutarth@live.com';
        $to = 'mehulp7054@gmail.com'; // Replace with actual email addresses
        sendMailNotification('contact_inquiry', $to, 'Inquiry From: '.$request->name, [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'country' => $request->country,
            'msg' => $request->message,
            'page_url' => $request->url(), // Current page URL
        ]);

        // Save the form data into the database
        $add = new Contactus;
        $add->full_name = $request->name;
        $add->country = $request->country;
        $add->phone_no = $request->phone;
        $add->email = $request->email;
        $add->message = $request->message;
        $add->page_url = $request->url(); // Capture the current page URL
        $add->status = 'success';
        $add->save();

        // Redirect to the thank-you page
        return redirect()->route('theme::thank-you');
    } else {
        // Handle failed CAPTCHA
        return redirect()->back()->with('fail', 'Failed CAPTCHA. Please try again.');
    }
}



    public function sendContactEnquiry(Request $request){

        // dd('send Product enquiry');

        // dd($request->input());
        // mail@giantinflatables.in
            $to = 'sales@giantinflatables.in';

            sendMailNotification('enquire', $to, 'Enquire From: '.$request->name,
                 ['name'=>$request->name,
                  'phone'=>$request->phone,
                  'email' => $request->email,
                  'country' => $request->country,
                  'title' => $request->title,
                  'image' => $request->image,
                  'product_url' => $request->product_url,
                  'page_url' => $request->page_url,
                  'message' => $request->message
            ]);

            // check for failed ones
        if (Mail::failures()) {
            // return failed mails
            return new Error(Mail::failures()); 
        }

        // else do redirect back to normal
        return('success');
        return back()->with('success', 'Contact Inquiry Sent...');
    }

    public function testMail(){

        sendMailNotification('comment', 'sales@giantinflatables.in', 'Comment From '. 'Contact Page',
                ['name'=>'Admin','client_name' => 'Mahesh Bhai', 'msg' => 'Testing Mail',
                'task_name' => 'Sending Mail', 'satus' => 1,
                'url' => 'https://www.giantinflatables.in', 
        ]);

        return back()->with('success', 'Contact Inquiry Sent...');
    }
    public function UploadMultipleImage(Request $request) {
        // dd($request);
        // Validate that the image field exists and is an array
        // $this->validate($request, [
        //     'image' => 'required|array',
        //     'image.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048' // Add any additional validation rules as needed
        // ]);
    
        // Loop through each uploaded image
        foreach ($request->file('image') as $index => $imageData) {
            if ($imageData->isValid()) {
                $media = new Media;
                $media->media_id = $request->media_id;
                $media->image_type = $request->image_type;
    
                // Use the original name of the uploaded file for title and alt text
                $originalName = $imageData->getClientOriginalName();
                $media->image_alt = pathinfo($originalName, PATHINFO_FILENAME); // Original file name without extension
                $media->image_title = pathinfo($originalName, PATHINFO_FILENAME); // Original file name without extension
                
                // Create a unique name for the uploaded file
                $image_name2 = time() . '_' . $originalName;
    
                // Set the path where the image will be stored
                $image_path = public_path('images/' . $image_name2);
    
                // Compress and save the image
                Image::make($imageData) // Use $imageData instead of $image
                    ->resize(1200, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->save($image_path, 75); // 75% quality
    
                // Delete the old image if it exists
                if ($request->old_image && file_exists(public_path('images/' . $request->old_image))) {
                    unlink(public_path('images/' . $request->old_image));
                }
    
                // Store the name of the uploaded file in the media record
                $media->image = $image_name2;
                $media->save(); // Save the media record
            } else {
                // Handle invalid upload if necessary
                return response()->json(['error' => 'Invalid image upload for image at index ' . $index], 400);
            }
        }
    
        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Image files uploaded successfully.'
        ]);
    }
    

    public function updateMultipleImageField($id, Request $request){

        $update = DB::table('media')->where('id', $id)
            ->update(['image_title' =>$request->title, 'image_alt' =>$request->alt]);


        if($update){       
            return response()->json([
                'success' => true,
                'message' => 'Image Filed Uploaded...'
            ]);
            // return back()->with('success', 'Image Filed Uploaded...');
            // return (['status' => 'success', 'message' => 'Image fields are Updated...']);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, try again later...'
            ]);

        }
    }
}

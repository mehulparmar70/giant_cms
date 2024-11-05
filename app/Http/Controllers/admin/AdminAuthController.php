<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Admin;
use Illuminate\Support\Facades\Hash;


class AdminAuthController extends Controller
{
    //
    
    public function login(){
        return view('login');
    }
    
    public function register(){
        return view('adm.register');
    }

    public function save(Request $request){
        // return $request->input();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required',
        ]);

        $admin = new Admin;
        $admin->name = $request->name;
        $admin-> email = $request-> email;

        $admin->password = Hash::make($request->password);

        $save = $admin->save();
        if($save){
            return back()->with('success', 'New User has been added to database.');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }


    function check (Request $request){
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // return $request->input();
        $userInfo = Admin::where('email', '=', $request->input('email'))->first();
            
        if(!$userInfo){
            return back()->with('fail', 'Please enter correct login information.');
        }else{
            if(Hash::check($request->password, $userInfo->password)){
                $request->session()->put('LoggedUser', $userInfo);
                return redirect(route('index'));
            }else{
                return back()->with('fail', 'Please enter correct login information');
            }
        }

    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect(route('admin.login'));
        }
    }

    function logoutOnscreen(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect()->back();
        }
    }

    function dashboard(){
        $data = ['LoggedUserInfo' =>  Admin::where('id', '=', session('LoggedUser'))->first()];
        return view('admin.index', $data);
    }

    public static function AdminAuth(){
        return $data = ['LoggedUserInfo' =>  Admin::where('id', '=', session('LoggedUser'))->first()];
    }



}

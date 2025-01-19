<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('admin.register');
    }
    public function register(Request $request){
        Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return to_route('admin.login.form');
    }
    public function loginForm()
    {
        return view('admin.login');
    }
    public function login(Request $request){
        $myData=$request->only('email','password');
        if(Auth::guard('admin')->attempt($myData)){
            return to_route('admin.dashboard');
        }else{
            return to_route('admin.login.form');
        }
    }
    public function logout(){
        Auth::logout();
        return to_route('admin.login.form');
    }
}

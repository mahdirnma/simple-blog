<?php

namespace App\Http\Controllers\writer;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('writer.register');
    }
    public function register(Request $request){
        Writer::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return to_route('writer.login.form');
    }
    public function loginForm()
    {
        return view('writer.login');
    }
    public function login(Request $request){
        $myData=$request->only('email','password');
        if(Auth::guard('writer')->attempt($myData)){
            return to_route('writer.dashboard');
        }else{
            return to_route('writer.login.form');
        }
    }
    public function logout(){
        Auth::guard('writer')->logout();
        return to_route('writer.login.form');
    }
}

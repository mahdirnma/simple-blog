<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('user.register');
    }
    public function register(Request $request){
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return to_route('user.login.form');
    }
    public function loginForm()
    {
        return view('user.login');
    }
    public function login(Request $request){
/*        $myData=$request->only('email','password');
        if(Auth::attempt($myData)){
            return to_route('user.dashboard.index');
        }*/
    }
}

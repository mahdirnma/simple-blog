<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
//        return $request->expectsJson() ? null : route('login');
        if ($request->expectsJson()){
            return null;
        }
        if ($request->is('admin/*')){
            return route('admin.login.form');
        }elseif ($request->is('writer/*')){
            return route('writer.login.form');
        }
        return route('user.login.form');
    }
}

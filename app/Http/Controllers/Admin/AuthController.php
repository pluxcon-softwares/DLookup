<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(){

    }

    public function login(){
        if(Auth::guard('admin')->check()){
            return redirect('/admin/dashboard');
        }
        $title = 'Admin Login';
        return view('admin.login', compact('title'));
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email'     =>  'required|email',
            'password'  =>  'required'
        ]);

        $remember_me = $request['remember_me'] ? 1 : 0;
        $credenticals = ['email' => $request['email'], 'password' => $request['password']];

        if(Auth::guard('admin')->attempt($credenticals, $remember_me)){
            return redirect('/admin/dashboard');
        }else{
            return back()->with('error_msg', 'Invalid email/password');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function login()
    {
        $title = 'User Login';
        return view('user.login')->with(['title'=>$title]);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' =>  'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            if(Auth::user()->active == 0)
            {
                return back()->with('flash_message', 'Your account has been disabled!');
            }
            return redirect()->route('user.dashboard');
        }else{
            return back()->with('flash_message', 'Email/Password incorrect');
        }
    }

    public function create()
    {
        $title = 'Register';
        $captcha_image = null;
        for($i=0; $i < 5; $i++){ $captcha_image .= rand(0, $i); }
        return view('user.register')->with(['title'=>$title, 'captcha_image' => $captcha_image]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username'  =>  'required|max:10|unique:users,username',
            'email' =>  'required|email|unique:users,email',
            'password' => 'required|min:6|max:12|confirmed'
        ]);

        if($request->captcha_image == $request->captcha_value)
        {
            User::create([
                'username'  =>  $request->username,
                'email' => $request->email,
                'password'  => $request->password
            ]);
            return redirect()->route('user.login')->with('flash_message', 'Account created, Login now!');
        }else{
            return back()->with('flash_message', 'Captcha incorrect');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $title = 'Dashboard';
        $news = Post::all();
        return view('user.dashboard')
        ->with([
            'title'=>$title,
            'news'=>$news
        ]);
    }

}

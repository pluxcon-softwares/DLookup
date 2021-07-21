<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth');
    }

    public function getAllPosts()
    {
        $title = 'All News / Notification';
        $posts = Post::all();

        return view('admin.post.all')->with(['title'=>$title, 'posts'=>$posts]);
    }

    public function createPost()
    {
        $title = 'Create New Post';
        return view('admin.post.create')->with(['title'=>$title]);
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'content'   =>  'required'
        ]);

        Post::create([
            'content'   => $request->content,
            'user_id'   => Auth::guard('admin')->user()->id
        ]);

        return back()->with('flash_message', 'Post has been created!');
    }

    public function editPost($post_id)
    {
        $title = 'Edit Post';
        $post = Post::find($post_id);
        return view('admin.post.edit')->with(['title'=>$title, 'post'=>$post]);
    }

    public function updatePost(Request $request, $post_id)
    {
        $request->validate([
            'content'   =>  'required'
        ]);

        $post = Post::find($post_id);
        $post->content = $request->content;
        $post->save();

        return redirect()->route('admin.news.posts')->with('flash_message', 'Post has been updated!');
    }

    public function deletePost(Request $request)
    {
        $post = Post::findOrFail($request->post_id);
        $post->delete();
        return back()->with('flash_message', 'Post has been deleted!');
    }
}

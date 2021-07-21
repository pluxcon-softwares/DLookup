<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth');
    }

    public function allUsers()
    {
        $title = 'All Registered Users';
        $users = User::all();
        return view('admin.user.all-users')
        ->with(['title' => $title, 'users'=>$users]);
    }

    public function editUser($user_id)
    {
        $title = 'Update User Account';
        $user = User::find($user_id);
        return view('admin.user.edit-user')
        ->with(['title'=>$title, 'user'=>$user]);
    }

    public function updateUser(Request $request, $user_id)
    {
        $request->validate([
            'username'  =>  'required|unique:users,username,'.$user_id,
            'email'     =>  'required|email|unique:users,email,'.$user_id,
            'active'    =>  'required|numeric|sometimes'
        ]);

        $user = User::find($user_id);
        $user->update($request->all());

        return redirect()->route('admin.all-users')
        ->with('flash_message', 'User account has been updated!');
    }

    public function deleteUser($user_id)
    {
        $user = User::find($user_id);
        $user->delete();
        return redirect()->route('admin.all-users')
        ->with('flash_message', 'User account has been deleted');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\User;
use App\Models\Ssn;
use App\Models\Dlookup;
use App\Models\Payment;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth');
    }

    public function dashboard()
    {
        $title = 'Admin Dashboard';
        $numberOfUsers = User::all();
        $numberOfSSN = Ssn::all();
        $numberOfDL = Dlookup::all();
        $numberOfAdmins = Admin::all();

        $allPayments = Payment::where('status', 'confirmed')->limit(10);
        $paymentAmounts = null;
        foreach($allPayments as $p)
        { $paymentAmounts += $p->local_amount; }

        return view('admin.dashboard')
        ->with([
            'title'         => $title,
            'numberOfUsers' => $numberOfUsers,
            'numberOfSSN'   =>  $numberOfSSN,
            'numberOfDL'    =>  $numberOfDL,
            'numberOfAdmins' => $numberOfAdmins,
            'paymentAmounts' => $paymentAmounts,
            'allPayments'   =>  $allPayments
        ]);
    }

    public function createAdmin()
    {
        $title = 'Create New Admin';
        return view('admin.create-admin')->with(['title'=>$title]);
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name'      =>  'required|unique:admins,name',
            'email'     =>  'required|email|unique:admins,email',
            'password'  => 'required|min:6|max:15'
        ]);

        Admin::create($request->all());

        return redirect()->route('admin.all-admins')->with('flash_message', 'Admin account created!');
    }

    public function allAdmins()
    {
        $title = 'All Admin & System Accounts';
        $admins = Admin::all();
        return view('admin.all-admins')
        ->with(['title'=>$title, 'admins'=>$admins]);
    }

    public function editAdmin($admin_id)
    {
        $title = 'Edit Admin Account';
        $admin = Admin::find($admin_id);
        return view('admin.edit-admin')
        ->with(['title'=>$title, 'admin'=>$admin]);
    }

    public function updateAdmin(Request $request, $admin_id)
    {
        $request->validate([
            'name'  =>  'required|unique:admins,name,'.$admin_id,
            'email' =>  'required|email|unique:admins,email,'.$admin_id
        ]);

        $admin = Admin::find($admin_id);
        $admin->update($request->all());
        return redirect()->route('admin.all-admins')->with('flash_message', 'Admin account updated!');
    }

    public function deleteAdmin($admin_id)
    {
        $admin = Admin::find($admin_id);
        $admin->delete();
        return redirect()->route('admin.all-admins')
        ->with('flash_message', 'Admin account deleted!');
    }
}

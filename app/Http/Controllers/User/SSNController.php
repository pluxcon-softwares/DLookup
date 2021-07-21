<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Ssn;
use App\Models\SsnOrder;
use App\Models\User;

class SSNController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //SSN Search Page
    public function ssnSearchPage()
    {
        $title = 'Social Security - (SSN)';
        $ssn_records = array();
        return view('user.ssn-search')->with(['title' => $title, 'ssn_records' => $ssn_records]);
    }
    //SSN Search Records
    public function ssnSearch(Request $request)
    {
        $title = 'Social Security - (SSN)';
        //return sprintf("%.2f", 0);
        if(Auth::user()->wallet !== sprintf("%.2f", 0)){
                $request->validate([
                    'first_name'    =>  'required',
                    'last_name'     =>  'required',
                    'address'       =>  'required',
                    'zip'           =>  'required|numeric'
                ]);

                $ssn_records = Ssn::where('first_name', $request->first_name)
                                ->where('last_name', $request->last_name)
                                ->orWhere('address', $request->address)
                                ->orWhere('zip', $request->zip)
                                ->get();
                $count_records = count($ssn_records);
                //Session::put('flash_message', "SSN Found($count_records)");
                //Session::flush();
                return view('user.ssn-search')->with([
                    'flash_message' => "SSN Found($count_records)",
                    'ssn_records'=>$ssn_records,
                    'title' => $title
                    ]);
            }
        else{
            $ssn_records = array();
            return back()
            ->with([
                'flash_message' => "You dont have enouch fund(s) to perform this search",
                ]);
        }

    }

    public function ssnBuy(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($user->wallet < sprintf("%.2f", $request->price))
        {
            return back()->with('flash_message', "You don't have enough funds for purchases, fund your wallet");
        }

        $ssnPurchase = SsnOrder::where('ssn_id', $request->ssn_id)->first();
        if(isset($ssnPurchase))
        {
            return back()->with('flash_message', 'These SSN record is already in your purchases');
        }

            $price = $request->price;
            $ssn_id = $request->ssn_id;
            $ssnRecord = Ssn::find($ssn_id)->first();
            $ssn_order = new SsnOrder;
            $ssn_order->user_id = Auth::user()->id;
            $ssn_order->ssn_id = $ssnRecord->id;
            $ssn_order->first_name = $ssnRecord->first_name;
            $ssn_order->middle_name = $ssnRecord->middle_name;
            $ssn_order->last_name = $ssnRecord->last_name;
            $ssn_order->dob = $ssnRecord->dob;
            $ssn_order->gender = $ssnRecord->gender;
            $ssn_order->ssn = $ssnRecord->ssn;
            $ssn_order->address = $ssnRecord->address;
            $ssn_order->state = $ssnRecord->state->state;
            $ssn_order->city = $ssnRecord->city;
            $ssn_order->zip = $ssnRecord->zip;
            $ssn_order->phone = $ssnRecord->phone;
            $ssn_order->email = $ssnRecord->email;
            $ssn_order->save();

            $user->wallet = ($user->wallet - $price);
            $user->save();

            return view('user.ssn-search')
            ->with([
                'title' => 'Social Security - (SSN)',
                'ssn_records' => array(),
                'flash_message' => 'Your order has been added to your purchase(s)'
                ]);
    }

    public function viewSSNPurchase()
    {
        $title = "SSN Purchases";
        $ssnOrders = SsnOrder::where('user_id', Auth::user()->id)->get();
        return view('user.ssn-purchases')
        ->with(['title' => $title, 'ssnOrders'=>$ssnOrders]);
    }

    public function deleteSSNPurchase(Request $request)
    {
        $ssn_id = $request->ssn_id;
        $ssnOrder = SsnOrder::where('ssn_id', $ssn_id)->first();
        $ssnOrder->delete();
            return redirect()->route('user.view-ssn-purchase')
            ->with('flash_message', 'SSN Record has been delete');
    }
}

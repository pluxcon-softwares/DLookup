<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Dlookup;
use App\Models\State;
use App\Models\User;
use App\Models\DlOrder;

class DLController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function DLSearchPage()
    {
        $title = "Search Drivers License(DL)";
        $dl_records = array();
        $states = State::all();
        return view('user.dl-search')
        ->with(['title'=>$title, 'dl_records'=>$dl_records, 'states'=>$states]);
    }

    public function DLSearch(Request $request)
    {
        $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'dob'           =>  'required|date_format:Y-m-d',
            'address'       =>  'required',
            'zip'           =>  'required|numeric',
            'city'          =>  'required',
            'state'         =>  'required'
        ]);

        if(Auth::user()->wallet == sprintf("%.2f", 0))
        {
            return back()->with('flash_message', "You dont have funds in your wallet, Fund your wallet");
        }

        $dl_records = DLookup::where('first_name', $request->first_name)
                            ->where('last_name', $request->last_name)
                            ->where('dob', $request->dob)
                            ->where('address', $request->address)
                            ->where('zipcode', $request->zip)
                            ->where('city', $request->city)
                            ->where('state_id', $request->state)
                            ->get();

        if($dl_records->count() == 0)
        {
            return back()->with('flash_message', 'No DL record(s) found!');
        }

        if(Auth::user()->wallet < sprintf("%.2f", 30))
        {
            return back()->with('flash_message', 'You dont have sufficient funds to view these record');
        }
        else{

            foreach($dl_records as $dl)
            {
                $dlPurchase = DlOrder::where('dl_id', $dl->dl_id)
                        ->where('user_id', Auth::user()->id)
                        ->first();
                if(isset($dlPurchase))
                {
                    return back()->with('flash_message', 'DL Record already in your DL purchase table');
                }
            }

            $user = User::find(Auth::user()->id);
            $user->wallet = ($user->wallet - sprintf("%.2f", 30));
            $user->save();
            $title = 'Drivers License Record - DL';
            $flash_message = 'DL Record(s) found, and a copy has been added to your DL Record purchase table';
            $states = State::all();

            foreach($dl_records as $dl)
            {
                $dlRecord = Dlookup::find($dl->dl_id);
                $dlPurchase = new DlOrder;
                $dlPurchase->user_id = Auth::user()->id;
                $dlPurchase->dl_id = $dl->dl_id;
                $dlPurchase->first_name = $dl->first_name;
                $dlPurchase->middle_name = $dl->middle_name;
                $dlPurchase->last_name = $dl->last_name;
                $dlPurchase->dob = $dl->dob;
                $dlPurchase->class =$dl->class;
                $dlPurchase->issue_date = $dl->issue_date;
                $dlPurchase->expire_date = $dl->expire_date;
                $dlPurchase->dl_number = $dl->dl_number;
                $dlPurchase->address = $dl->address;
                $dlPurchase->city = $dl->city;
                $dlPurchase->state = $dl->state->state;
                $dlPurchase->zip = $dl->zipcode;
                $dlPurchase->restrictions = $dl->restrictions;
                $dlPurchase->height = $dl->height;
                $dlPurchase->gender = $dl->gender;
                $dlPurchase->save();
            }

            return view('user.dl-search')
                    ->with([
                        'title'=>$title,
                        'dl_records'=>$dl_records,
                        'flash_message'=>$flash_message,
                        'states'=>$states
                    ]);
        }
    }

    public function viewDLPurchase()
    {
        $title = 'Drivers License';
        $dlPurchases = DlOrder::where('user_id', Auth::user()->id)->get();
        return view('user.dl-purchases')
        ->with(['title' => $title, 'dlPurchases' => $dlPurchases]);
    }

    public function deleteDLPurchase(Request $request)
    {
        $dlPurchase = DlOrder::where('dl_id', $request->dl_id)->first();
        $dlPurchase->delete();
        return redirect()->route('user.view-dl-purchase')
        ->with('flash_message', 'DL Record has been deleted!');
    }
}

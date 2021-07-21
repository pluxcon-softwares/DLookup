<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Dlookup;
use App\Models\State;

class DLController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth');
    }

    public function dlRecords()
    {
        $title = 'DL Records';
        $dl_records = Dlookup::all();
        return view('admin.dl.records')->with(['title'=>$title, 'dl_records' => $dl_records]);
    }

    public function dlRecord($dl_id)
    {
        $title = 'DL Record';
        $dl_record = Dlookup::with('state:id,state')->where('id',$dl_id)->first();
        return response()->json(['data' => $dl_record]);
    }

    public function dlCreate()
    {
        $title = 'Add DL Record';
        $states = State::all();
        return view('admin.dl.add')->with(['title'=>$title, 'states'=>$states]);
    }

    public function dlStore(Request $request)
    {
        $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'dob'           =>  'required|date_format:Y-m-d',
            'gender'        =>  'required',
            'dl_number'     =>  'required|unique:dlookups,dl_number',
            'issue_date'    =>  'required|date_format:Y-m-d',
            'expire_date'   =>  'required|date_format:Y-m-d',
            'address'       =>  'required',
            'city'           =>  'required',
            'state'         =>  'required|numeric',
            'zipcode'       =>  'required'
        ]);

        $store_dl = new Dlookup;
        $store_dl->first_name = $request['first_name'];
        $store_dl->middle_name = $request['middle_name'];
        $store_dl->last_name = $request['last_name'];
        $store_dl->dob = $request['dob'];
        $store_dl->gender = $request['gender'];
        $store_dl->dl_number = $request['dl_number'];
        $store_dl->issue_date = $request['issue_date'];
        $store_dl->expire_date = $request['expire_date'];
        $store_dl->class = $request['class'];
        $store_dl->address = $request['address'];
        $store_dl->state_id = $request['state'];
        $store_dl->city = $request['city'];
        $store_dl->zipcode = $request['zipcode'];
        $store_dl->save();

        $title = 'Add DL Record';

        return back()->with(['flash_message' => 'DL recrod added succesfully!', 'title' => $title]);
    }

    public function dlEdit($dl_id)
    {
        $title = 'Edit DL Record';
        $dl_record = Dlookup::find($dl_id);
        $states = State::all();
        return view('admin.dl.edit')
        ->with(['title'=>$title, 'dl_record' => $dl_record, 'states'=>$states]);
    }

    public function dlUpdate(Request $request, $dl_id)
    {
        $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'dob'           =>  'required|date_format:Y-m-d',
            'gender'        =>  'required',
            'dl_number'     =>  'required|sometimes',
            'issue_date'    =>  'required|date_format:Y-m-d',
            'expire_date'   =>  'required|date_format:Y-m-d',
            'address'       =>  'required',
            'city'           =>  'required',
            'state'         =>  'required|numeric',
            'zipcode'       =>  'required'
        ]);

        $store_dl = Dlookup::find($dl_id);
        $store_dl->first_name = $request['first_name'];
        $store_dl->middle_name = $request['middle_name'];
        $store_dl->last_name = $request['last_name'];
        $store_dl->dob = $request['dob'];
        $store_dl->gender = $request['gender'];
        $store_dl->dl_number = $request['dl_number'];
        $store_dl->issue_date = $request['issue_date'];
        $store_dl->expire_date = $request['expire_date'];
        $store_dl->class = $request['class'];
        $store_dl->address = $request['address'];
        $store_dl->state_id = $request['state'];
        $store_dl->city = $request['city'];
        $store_dl->zipcode = $request['zipcode'];
        $store_dl->save();

        $title = 'Edit DL Record';
        return back()->with(['flash_message' => 'DL Record updated!', 'title' => $title]);
    }

    public function dlDelete($dl_id)
    {
        $dl_record = Dlookup::find($dl_id);
        $dl_record->delete();
        return redirect()->route('admin.dl.records')->with('flash_message', 'DL Record has been deleted!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ssn;
use App\Models\State;

class SSNController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth');
    }

    public function ssnRecords()
    {
        $title = 'SSN Records';
        $ssn_records = Ssn::all();
        return view('admin.ssn.records')->with(['title'=>$title, 'ssn_records' => $ssn_records]);
    }

    public function ssnRecord($ssn_id)
    {
        $title = 'SSN Record';
        $ssn_record = Ssn::with('state:id,state')->where('id', $ssn_id)->first();
        return response()->json(['data' => $ssn_record]);
    }

    public function ssnCreate()
    {
        $title = 'Add SSN Record';
        $states = State::all();
        return view('admin.ssn.add')->with(['title'=>$title, 'states'=>$states]);
    }

    public function ssnStore(Request $request)
    {
        $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'dob'           =>  'required|date_format:Y-m-d',
            'gender'        =>  'required',
            'ssn'           =>  'required|numeric|unique:ssns,ssn',
            'address'       =>  'required',
            'state'         =>  'required|numeric',
            'city'          =>  'required',
            'zip'           =>  'required'
        ]);

        $store_ssn = new Ssn;
        $store_ssn->first_name = $request['first_name'];
        $store_ssn->middle_name = $request['middle_name'];
        $store_ssn->last_name = $request['last_name'];
        $store_ssn->dob = $request['dob'];
        $store_ssn->gender = $request['gender'];
        $store_ssn->ssn = $request['ssn'];
        $store_ssn->address = $request['address'];
        $store_ssn->state_id = $request['state'];
        $store_ssn->city = $request['city'];
        $store_ssn->zip = $request['zip'];
        $store_ssn->phone = $request['phone'];
        $store_ssn->email = $request['email'];
        $store_ssn->save();

        $title = 'Add SSN Record';

        return back()->with(['flash_message' => 'SSN recrod added succesfully!', 'title' => $title]);
    }

    public function ssnEdit($ssn_id)
    {
        $title = 'Edit SSN Record';
        $ssn_record = Ssn::find($ssn_id);
        $states = State::all();
        return view('admin.ssn.edit')
        ->with(['title'=>$title, 'ssn_record' => $ssn_record, 'states' => $states]);
    }

    public function ssnUpdate(Request $request, $ssn_id)
    {
        $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'dob'           =>  'required|date_format:Y-m-d',
            'gender'        =>  'required',
            'ssn'           =>  'required|numeric|sometimes|unique:ssns,ssn,'.$ssn_id,
            'address'       =>  'required',
            'state'         =>  'required|numeric',
            'city'          =>  'required',
            'zip'           =>  'required'
        ]);

        $store_ssn = Ssn::find($ssn_id);
        $store_ssn->first_name = $request['first_name'];
        $store_ssn->middle_name = $request['middle_name'];
        $store_ssn->last_name = $request['last_name'];
        $store_ssn->dob = $request['dob'];
        $store_ssn->gender = $request['gender'];
        $store_ssn->ssn = $request['ssn'];
        $store_ssn->address = $request['address'];
        $store_ssn->state_id = $request['state'];
        $store_ssn->city = $request['city'];
        $store_ssn->zip = $request['zip'];
        $store_ssn->phone = $request['phone'];
        $store_ssn->email = $request['email'];
        $store_ssn->save();

        $title = 'Edit SSN Record';
        return back()->with(['flash_message' => 'SSN Record updated!', 'title' => $title]);
    }

    public function ssnDelete($ssn_id)
    {
        $ssn_record = Ssn::find($ssn_id);
        $ssn_record->delete();
        return redirect()->route('admin.ssn.records')->with('flash_message', 'SSN Record has been deleted!');
    }

    /**
     * Search SSN Record
     */
    public function ssnSearch()
    {
        $title = 'Search SSN Record';
        return view('admin.ssn.search')->with(['title'=>$title]);
    }

    /**
     * Search SSN Record by Firstname and Lastname
     */
    public function searchSSNByName(Request $request)
    {
        $ssn_record = Ssn::where('first_name', $request->first_name)
                            ->where('last_name', $request->last_name)
                            ->get();
        $title = 'SSN Record - Search Result';
        return back()->with([title=>$title, 'ssn_record' => $ssn_record]);
    }

    /**
     * Seach SSN Record by SSN Number
     */
    public function searchSSNByNumber(Request $request)
    {
        $title = 'SSN Record - Search Result';
        $ssn_record = Ssn::where('ssn', $request->ssn)->first();
        return back()->with([title=>$title, 'ssn_record' => $ssn_record]);
    }
}

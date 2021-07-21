<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth');
    }

    public function ssnImport()
    {
        $title = 'SSN Import';
        return view('admin.import.ssn')
        ->with(['title' => $title]);
    }

    public function ssnParseImport(Request $request)
    {
        $request->validate([
            'file'  =>  'required|mimes:csv,txt'
        ]);

        // Get file from upload
        $path = $request['file']->getRealPath();

        // turn into array
        $file = file($path);

        //remove first line
        $data = array_slice($file, 0);

        //Loop through file and split every 1000 lines
        $parts = array_chunk($data, 500);

        foreach($parts as $index => $part)
        {
            $filename = base_path('resources/import/ssn/'.date('y-m-d-H-i-s').$index.'.csv');
            file_put_contents($filename, $part);
        }

        session()->flash('status', 'queued for importing');

        return redirect()->route('admin.ssn-import');
    }

    public function DlImport()
    {}

    public function DlParseImport()
    {}
}

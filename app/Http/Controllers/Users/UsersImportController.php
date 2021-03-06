<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UsersImportController extends Controller
{
    public function show()
    {
        return view('users.import');
    }
    public function store(Request $request)
    {
        //$file=$request->file('file')->store('importedFile');
        $file=$request->file('file');
        //Excel::import(new UsersImport,$file);
        //(new UsersImport)->import($file);
        $import= new UsersImport;
        $import->import($file);

        //dd($import->errors());
        //dd($import->failures());
        if($import->failures()->isNotEmpty()){
            return back()->withFailures($import->failures());
        }
        return back()->withStatus('import is in queue will be notified after importing');
    }
}

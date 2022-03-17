<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Imports\ProductsUpdate;
use Illuminate\Http\Request;

class ProductsImportController extends Controller
{
    public function show()
    {
        return view('products.import');
    }
    public function store(Request $request)
    {
        $file=$request->file('file');
        if(!isset($file)) return back()->withErrors("Missing File");
        $import= new ProductsImport();
        $import->import($file);
        return back()->withStatus('inserting');
    }
    public function update(Request $request)
    {

        $file=$request->file('file');
        if(!isset($file)) return view('Products.import')->withErrors("Missing File");
        $import= new ProductsUpdate();
        $import->import($file);
        if($import->failures()->isNotEmpty()){
            return view('Products.import')->withFailures($import->failures());
        }
        $st='updating';
        return view('Products.import',compact('st'));

    }
}

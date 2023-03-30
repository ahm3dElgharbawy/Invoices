<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ArchiveController extends Controller
{

    public function index()
    {
        $invoices = Invoice::onlyTrashed()->get();
        return view('invoices/invoice_archive',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function update($id)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function cancelArchiving($id){
        Invoice::onlyTrashed()->find($id)->restore();
        return back()->with("cancel_archiving",'تم الغاء ارشفة الفاتورة بنجاح');
    }



    public function destroy(Request $request)
    {
        Invoice::onlyTrashed()->find($request->id)->forceDelete();
        $dir = public_path('/Attachments/' . $request->invoice_number);
        File::deleteDirectory($dir);
        return back()->with("delete_archiving",'تم حذف الارشيف بنجاح ');
    }
}

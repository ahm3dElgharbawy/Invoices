<?php

namespace App\Http\Controllers;

use App\Models\InvoiceAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class InvoiceAttachmentController extends Controller
{

    public function index()
    {

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


    public function store(Request $request)
    {
        $this->validate($request,[
            'myFile'=>'mimes:png,jpg,pdf,jpeg',
        ],[
            'myFile.mimes' => 'صيغة المرفق يجب ان تكون jpg او  png او pdf'
        ]);
      $file = $request->file('myFile');
      $file_name = $file->getClientOriginalName();
      InvoiceAttachment::create([
          "file_name" => $file_name,
          'invoice_number' => $request->invoice_number,
          'created_by' => Auth::user()->name,
          'invoice_id' => $request->id

      ]);
      $request->myFile->move(public_path('Attachments/' . $request->invoice_number), $file_name);
      return back()->with('add',"تم اضافة المرفق بنجاح");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoiceAttachment  $invoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceAttachment $invoiceAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvoiceAttachment  $invoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceAttachment $invoiceAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvoiceAttachment  $invoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceAttachment $invoiceAttachment)
    {
        //
    }


    public function destroy(Request $request)
    {
        InvoiceAttachment::destroy($request->id);
        $filePath = public_path('/Attachments/'.$request->invoice_number.'/'.$request->file_name);
        File::delete($filePath);
        return back()->with('delete','تم حذف المرفق بنجاح');
    }
}

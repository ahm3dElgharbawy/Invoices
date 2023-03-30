<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceAttachment;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceDetailController extends Controller
{

    public function index($id)
    {
        $invoice = Invoice::where('id',$id)->first();
        $details = InvoiceDetail::where('invoice_id',$id)->get();
        $attachments = InvoiceAttachment::where('invoice_id',$id)->get();
//        $notification = auth()->user()->unreadNotifications->where('invoice_id', $id)->first();
//        if ($notification) {
//            $notification->markAsRead();
//        }
        return view('invoices.invoices_details',compact('invoice','details','attachments'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(InvoiceDetail $invoiceDetail)
    {
        //
    }


    public function edit(InvoiceDetail $invoiceDetail)
    {
        //
    }


    public function update(Request $request, InvoiceDetail $invoiceDetail)
    {
        //
    }


    public function destroy(Request $request)
    {

    }

    public function downloadFile($invoice_number,$file_name){
        $filePath = public_path('/Attachments/'.$invoice_number.'/'.$file_name);
        return response()->download($filePath);
    }
    public function openFile($invoice_number,$file_name){
        $filePath = public_path('/Attachments/'.$invoice_number.'/'.$file_name);
        return response()->file($filePath);

    }
}

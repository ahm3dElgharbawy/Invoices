<?php

namespace App\Http\Controllers;

use App\Exports\InvoiceExport;
use App\Models\Invoice;
use App\Models\InvoiceAttachment;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\Section;
use App\Models\User;
use App\Notifications\AddInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.invoice', compact('invoices'));
    }


    public function create()
    {
        $sections = Section::all();
        return view('invoices/add_invoice', compact('sections'));
    }


    public function store(Request $request)
    {
        Invoice::create([
            "invoice_number" => $request->invoice_number,
            "invoice_date" => $request->invoice_date,
            "due_date" => $request->due_date,
            "section_id" => $request->section,
            "product" => $request->product,
            "amount_collection" => $request->amount_collection,
            "amount_commission" => $request->amount_commission,
            "discount" => $request->discount,
            "rate_vat" => $request->rate_vat,
            "value_vat" => $request->value_vat,
            "total" => $request->total,
            "status" => __('غير مدفوعة'),
            "status_value" => 0,
            "note" => $request->note
        ]);

        $invoice = Invoice::latest()->first();
        InvoiceDetail::create([
            'invoice_id' => $invoice->id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->section,
            'status' => 'غير مدفوعة',
            'status_value' => 0,
            'note' => $request->note,
            'user' => Auth::user()->name,
        ]);


        if ($request->hasFile('pic')) {
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            InvoiceAttachment::create([
                'file_name' => $file_name,
                'invoice_number' => $invoice_number,
                'created_by' => Auth::user()->name,
                'invoice_id' => $invoice->id

            ]);


            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }
        $user = Auth::user();
        Notification::send($user, new AddInvoice($invoice));

        return redirect('invoices')->with('add', 'تم اضافة الفاتورة بنجاح');

    }


    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoices.status_update', compact('invoice'));

    }


    public function edit($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $sections = Section::all();
        return view('invoices.edit_invoice', compact('invoice', 'sections'));
    }

    public function update(Request $request, $id)
    {
        Invoice::findOrFail($id)->update([
            "invoice_number" => $request->invoice_number,
            "invoice_date" => $request->invoice_date,
            "due_date" => $request->due_date,
            "section_id" => $request->section,
            "product" => $request->product,
            "amount_collection" => $request->amount_collection,
            "amount_commission" => $request->amount_commission,
            "discount" => $request->discount,
            "rate_vat" => $request->rate_vat,
            "value_vat" => $request->value_vat,
            "total" => $request->total,
            "status" => __('غير مدفوعة'),
            "status_value" => 0,
            "note" => $request->note
        ]);

        InvoiceDetail::where('invoice_id', $id)->first()->update([
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->section,
            'note' => $request->note,
        ]);


        return redirect('invoices')->with('edit', 'تم تعديل الفاتورة بنجاح');
    }


    public function destroy(Request $request)
    {
        $dir = public_path('/Attachments/' . $request->invoice_number);
        File::deleteDirectory($dir);
        Invoice::findOrFail($request->id)->forceDelete();
        session()->flash('delete_invoice', 'تم حذف الفاتورة بنجاح');
        return back();

    }

    public function getProducts($id)
    {
        $products = Product::where('section_id', $id)->pluck('product_name', 'id');
        return json_decode($products);
    }

    public function updateStatus(Request $request,$id)
    {
        Invoice::findOrFail($id)->update([
            "status" => $request->status,
            "status_value" => $request->status == 'مدفوعة' ? 1 : 2,
            "payment_date" => $request->payment_date
        ]);

        InvoiceDetail::create([
            'invoice_id' => $id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->section,
            'status' => $request->status,
            'status_value' =>$request->status == 'مدفوعة' ? 1 : 2,
            'note' => $request->note,
            'user' => Auth::user()->name,
        ]);
        return back()->with('update_status','تم تحديث حالة الدفع بنجاح');
    }


    public function paid(){
        $invoices = Invoice::where('status_value',1)->get();
        return view('invoices.paid_invoices', compact('invoices'));
    }
    public function unPaid(){
        $invoices = Invoice::where('status_value',0)->get();
        return view('invoices.unpaid_invoices', compact('invoices'));
    }
    public function partiallyPaid(){
        $invoices = Invoice::where('status_value',2)->get();
        return view('invoices.partially_paid_invoices', compact('invoices'));
    }

    public function addToArchive($id){
        Invoice::destroy($id);
        return back()->with('archive','تم ارشفة الفاتورة بنجاح');
    }
    public function print($id){
        $invoice = Invoice::findOrFail($id);;
        return view('invoices/print_invoice',compact('invoice'));
    }
    public function export()
    {
        return Excel::download(new InvoiceExport, 'invoice.xlsx');
    }
    public function markAllAsRead(){
        $notification = auth()->user()->unreadNotifications;
        if($notification->count()>0){
            $notification->markAsRead();
            return redirect()->back();
        }
    }
}

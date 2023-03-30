<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceReportController extends Controller
{
    public function index(){
        return view('reports.invoices_reports');
    }

    public function searchInvoice(Request $request){
        if($request->radio == 1){
            if($request->type && $request->start_at =='' && $request->end_at == ''){
                $invoices = Invoice::where('status',$request->type)->get();
                $type = $request->type;
                return view('reports.invoices_reports',compact('type','invoices'));
            }
            else{
                $sa = date($request->start_at);
                $ea = date($request->end_at);
                $invoices = Invoice::where('status',$request->type)->whereBetween('invoice_date',[$sa,$ea])->get();
                $type = $request->type;
                return view('reports.invoices_reports',compact('type','invoices'));
            }

        }
        else{
            $invoices = Invoice::where('invoice_number',$request->invoice_number)->get();
            $sa = date($request->start_at);
            $ea = date($request->end_at);
            $type = $request->type;
            return view('reports.invoices_reports',compact('type','sa','ea','invoices'));
        }
    }

}

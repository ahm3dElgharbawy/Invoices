<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceAttachmentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\InvoiceReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\UserController;
use App\Models\InvoiceAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('get_user',function(){
    foreach(auth()->user()->unreadNotifications as $notification)
        dd($notification->data);


});

Route::get('/home',[HomeController::class,'index']);
Route::resource('invoices', InvoiceController::class);
Route::get('invoices/edit/{id}',[InvoiceController::class,'edit']);
Route::get('invoices/show_status/{id}',[InvoiceController::class,'show']);
Route::post('invoices/update_status/{id}',[InvoiceController::class,'updateStatus']);
Route::get('invoices/archiving/{id}',[InvoiceController::class,'addToArchive']);
Route::get('paid-invoices',[InvoiceController::class,'paid']);
Route::get('unpaid-invoices',[InvoiceController::class,'unPaid']);
Route::get('partially-paid-invoices',[InvoiceController::class,'partiallyPaid']);
Route::resource('archive',ArchiveController::class);
Route::get('cancel-archiving/{id}',[ArchiveController::class,'cancelArchiving'])->name('cancelArchiving');
Route::post('delete-archiving',[ArchiveController::class,'destroy'])->name('deleteArchiving');
Route::get('invoices/print/{id}',[InvoiceController::class,'print']);
Route::resource('sections', SectionController::class);
Route::resource('products',ProductController::class);
Route::get('section/{id}',[InvoiceController::class,'getProducts']);
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});


Route::get('invoices-reports',[InvoiceReportController::class,'index']);
Route::post("search-invoices",[InvoiceReportController::class,'searchInvoice']);

Route::get('customers-reports',[CustomerReportController::class,'index']);
Route::post('search-customers',[CustomerReportController::class,'searchCustomer']);

Route::get('mark-all-as-read',[InvoiceController::class,'markAllAsRead']);

Route::get('invoices/details/{id}',[InvoiceDetailController::class,'index']);
Route::get('Download/{invoice_number}/{file_name}',[InvoiceDetailController::class,'downloadFile'])->name('file.download');
Route::get('View/{invoice_number}/{file_name}',[InvoiceDetailController::class,'openFile'])->name('file.open');
Route::post('delete_file',[InvoiceAttachmentController::class,'destroy'])->name('file.delete');
Route::post('add_attachment',[InvoiceAttachmentController::class,'store'])->name('attachment.add');
Route::get('export_excel',[InvoiceController::class,'export']);
Route::get('/{page}', [AdminController::class,'index'])->middleware('auth');




@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الفاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="col-xl-12">
        <!-- div -->
        <div class="card mg-b-20" id="tabs-style2">
            <div class="card-body">
                <div class="text-wrap">
                    <div class="example">
                        <div class="panel panel-primary tabs-style-2">
                            <div class=" tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs main-nav-line">
                                        <li><a href="#tab4" class="nav-link active" data-toggle="tab">المعلومات</a></li>
                                        <li><a href="#tab5" class="nav-link" data-toggle="tab">الحالة</a></li>
                                        <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body main-content-body-right border">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab4">
                                        @if (session('add'))
                                            <div class="alert alert-success alert-dismissible fade show pr-5" role="alert">
                                                {{ session('add') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        @if (session('delete'))
                                            <div class="alert alert-success alert-dismissible fade show pr-5" role="alert">
                                                {{ session('delete') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        @error('myFile')
                                        <div class="alert alert-warning alert-dismissible fade show pr-2" role="alert">
                                            {{$message}}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @enderror
                                        <table class="table table-striped table-responsive-lg text-nowrap text-center">
                                            <tbody>
                                            <tr>
                                                <th scope="row">رقم الفاتورة</th>
                                                <td class="text-primary">{{$invoice->invoice_number}}</td>
                                                <th scope="row">تاريخ_الفاتورة</th>
                                                <td class="text-primary">{{$invoice->invoice_date}}</td>
                                                <th scope="row">تاريخ الاستحقاق</th>
                                                <td class="text-primary">{{$invoice->due_date}}</td>
                                                <th scope="row">المنتج</th>
                                                <td class="text-primary">{{$invoice->product}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">القسم</th>
                                                <td class="text-primary">{{$invoice->section->section_name}}</td>
                                                <th scope="row">مبلغ التحصيل</th>
                                                <td class="text-primary">{{$invoice->amount_collection}}</td>
                                                <th scope="row">مبلغ العمولة</th>
                                                <td class="text-primary">{{$invoice->amount_commission}}</td>
                                                <th scope="row">الخصم</th>
                                                <td class="text-primary">{{$invoice->discount}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">نسبة الضريبة المضافة</th>
                                                <td class="text-primary">{{$invoice->rate_vat}}</td>
                                                <th scope="row">قيمة الضريبة المضافة</th>
                                                <td class="text-primary">{{$invoice->value_vat}}</td>
                                                <th scope="row">المجموع</th>
                                                <td class="text-primary">{{$invoice->total}}</td>
                                                <th scope="row">الحالة</th>
                                                <td class="text-primary text-nowrap">
                                                    @if($invoice->status_value==1)
                                                        {{-- 1 --}}
                                                        <span class="badge badge-success">{{$invoice->status}}</span>
                                                    @elseif($invoice->status_value==2)
                                                        {{-- 2 --}}
                                                        <span class="badge badge-warning">{{$invoice->status}}</span>
                                                    @else
                                                        {{-- 0 --}}
                                                        <span class="badge badge-danger">{{$invoice->status}}</span>
                                                    @endif
                                                </td>

                                            </tr>
                                            <tr>
                                                <th scope="row">قيمة الحالة</th>
                                                <td class="text-primary">{{$invoice->status_value}}</td>
                                                <th scope="row">ملاحظة</th>
                                                <td class="text-primary">{{$invoice->note}}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="tab-pane" id="tab5">
                                        <table class="table table-striped table-responsive-lg text-nowrap text-center">
                                            <thead>
                                            <tr>
                                                <th scope="row">#</th>
                                                <th scope="row">رقم الفاتورة</th>
                                                <th scope="row"> المنتج</th>
                                                <th scope="row">القسم</th>
                                                <th scope="row">حالة الدفع</th>
                                                <th scope="row">تاريخ الاضافة</th>
                                                <th scope="row">تاريخ الدفع</th>
                                                <th scope="row">ملاحظة</th>
                                                <th scope="row">اضيفت بواسطة</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i=0;
                                            @endphp
                                            @foreach($details as $detail)
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{$detail->invoice_number}}</td>
                                                    <td>{{$detail->product}}</td>
                                                    <td>{{$invoice->section->section_name}}</td>
                                                    <td>
                                                        @if($detail->status=='مدفوعة')
                                                            {{-- 1 --}}
                                                            <span class="badge badge-success">{{$detail->status}}</span>
                                                        @elseif($detail->status=='مدفوعة جزئيا')
                                                            {{-- 2 --}}
                                                            <span class="badge badge-warning">{{$detail->status}}</span>
                                                        @else
                                                            {{-- 0 --}}
                                                            <span class="badge badge-danger">{{$detail->status}}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{$detail->created_at}}</td>
                                                    <td>{{$detail->payment_date}}</td>
                                                    <td>{{$detail->note}}</td>
                                                    <td>{{$detail->user}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>

                                    </div>

                                    <div class="tab-pane" id="tab6">
{{--      file attachment      --}}     <p class="text-danger">* صيغة المرفق pdf, jpeg , jpg , png </p>
                                        <h5 class="card-title">اضافة مرفقات</h5>
                                        <form action="{{route('attachment.add')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <button type="submit" class="btn btn-primary-gradient">اضافة</button>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="file" name="myFile">
                                                    <label class="custom-file-label" for="file">{{__('اختار المرفق')}}</label>
                                                    <input type="hidden" name="id" value="{{$invoice->id}}">
                                                    <input type="hidden" name="invoice_number" value="{{$invoice->invoice_number}}">
                                                </div>
                                            </div>
                                        </form>

                                        <table class="table table-striped table-responsive-lg text-nowrap text-center">
                                            <thead>
                                            <tr>
                                                <th scope="row">#</th>
                                                <th scope="row">اسم الملف</th>
                                                <th scope="row"> اضيف بواسطة</th>
                                                <th scope="row">تاريخ الاضافة</th>
                                                <th scope="row">العمليات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i=0;
                                            @endphp
                                            @foreach($attachments as $attachment)
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{$attachment->file_name}}</td>
                                                    <td>{{$attachment->created_by}}</td>
                                                    <td>{{$attachment->created_at}}</td>
                                                    <td>
                                                        <a class="btn btn-info text-white"
                                                           href="{{route('file.open',[$attachment->invoice_number,$attachment->file_name])}}"
                                                           target="_blank"><i class="fa fa-eye"></i> عرض</a>
                                                        <a class="btn btn-primary text-white"
                                                           href="{{route('file.download',[$attachment->invoice_number,$attachment->file_name])}}"><i
                                                                class="fa fa-download"></i> تحميل</a>

                                                        <a class="btn btn-danger text-white" href="#modalDeleteAttachment" data-toggle="modal" data-id="{{$attachment->id}}" data-invoice_number={{$attachment->invoice_number}} data-file_name="{{$attachment->file_name}}">
                                                            <i class="fa fa-trash" ></i> حذف</a>

                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDeleteAttachment">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف الفاتورة</h6>
                    <button class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('file.delete') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="id" id="id">
                            <label for="product_name" class="form-label"> هل انت متاكد من انك تريد حذف المرفق ؟</label>
                            <input type="text" class="form-control" id="file_name" name="file_name" readonly>
                            <input type="hidden" class="form-control" id="invoice_number" name="invoice_number" readonly>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                            <button class="btn ripple btn-danger" type="submit">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End delete invoice modal -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <!-- Internal Input tags js-->
    <script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
    <!--- Tabs JS-->
    <script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
    <script src="{{URL::asset('assets/js/tabs.js')}}"></script>
    <script>
        $('#modalDeleteAttachment').on('show.bs.modal', function (event) {
            var button = $(event
                .relatedTarget
            )
            var id = button.data('id')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
    </script>
@endsection

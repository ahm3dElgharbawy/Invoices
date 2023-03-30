@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
     ارشيف الفواتير
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ ارشيف الفواتير</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->
    <div class="row">

        @if (session()->has('cancel_archiving'))
            <script>
                window.onload = function() {
                    notif({
                        msg: "تم الغاء ارشفة الفاتورة  بنجاح",
                        type: "success"
                    })
                }
            </script>
        @endif
        @if (session()->has('delete_archiving'))
            <script>
                window.onload = function() {
                    notif({
                        msg: "تم حذف الارشيف  بنجاح",
                        type: "success"
                    })
                }
            </script>
        @endif


        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap text-center" id="example1">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">رقم الفاتورة</th>
                                <th class="border-bottom-0">تاريخ_الفاتورة</th>
                                <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                <th class="border-bottom-0">المنتج</th>
                                <th class="border-bottom-0">القسم</th>
                                <th class="border-bottom-0">مبلغ التحصيل</th>
                                <th class="border-bottom-0">مبلغ العمولة</th>
                                <th class="border-bottom-0">الخصم</th>
                                <th class="border-bottom-0">نسبة الضريبة المضافة</th>
                                <th class="border-bottom-0">قيمة الضريبة المضافة</th>
                                <th class="border-bottom-0">المجموع</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">قيمة الحالة</th>
                                <th class="border-bottom-0">ملاحظة</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>
                                        <a href="{{url('/invoices/details/'.$invoice->id)}}">{{++$i}}</a>
                                    </td>
                                    <td>{{$invoice->invoice_number}}</td>
                                    <td>{{$invoice->invoice_date}}</td>
                                    <td>{{$invoice->due_date}}</td>
                                    <td>{{$invoice->product}}</td>
                                    <td>{{$invoice->section->section_name}}</td>
                                    <td>{{$invoice->amount_collection}}</td>
                                    <td>{{$invoice->amount_commission}}</td>
                                    <td>{{$invoice->discount}}</td>
                                    <td>{{$invoice->rate_vat}}</td>
                                    <td>{{$invoice->value_vat}}</td>
                                    <td>{{$invoice->total}}</td>
                                    <td class="text-nowrap">
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
                                    <td>{{$invoice->status_value}}</td>
                                    <td>{{$invoice->note}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
                                                    data-toggle="dropdown" id="dropdownMenuButton" type="button">العملية<i class="fas fa-caret-down ml-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" href="{{route('cancelArchiving',$invoice->id)}}">الغاء الارشفة</a>
                                                <a class="dropdown-item" href="#modalCancelArchiving" data-toggle="modal" data-id="{{$invoice->id}}" data-invoice_number="{{$invoice->invoice_number}}">حذف الارشيف</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
    <div class="modal fade" id="modalCancelArchiving">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف الارشيف</h6><button class="close" data-dismiss="modal"
                                                                   type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('deleteArchiving') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="id" id="id">
                            <label for="invoice_number" class="form-label">هل انت متاكد من انك تريد حذف هذة الارشيف ؟</label>
                            <input type="text" class="form-control" id="invoice_number" name="invoice_number" readonly>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                            <button class="btn ripple btn-danger" type="submit">تاكيد </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
    <script>
        $('#modalCancelArchiving').on('show.bs.modal', function(event) {
            var button = $(event
                .relatedTarget
            ) // to reach data-id, data-section_name and data_description in <a>edit</a> element
            var id = button.data('id')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
    </script>
@endsection

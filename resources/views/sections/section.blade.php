@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
    الاقسام
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الاقسام</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row" style="justify-content: center;">
        @if (session('add'))
            <div class="alert alert-success alert-dismissible fade show w-50 pr-5" role="alert">
                {{ session('add') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('edit'))
            <div class="alert alert-success alert-dismissible fade show w-50 pr-5" role="alert">
                {{ session('edit') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('delete'))
            <div class="alert alert-success alert-dismissible fade show w-50 pr-5" role="alert">
                {{ session('delete') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show w-50 pr-" role="alert">
                    @foreach ($errors->all() as $error)
                        <li class="pr-5">{{ $error }}</li>
                    @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="col-xl-12">
            <div class="card">
                <a class="btn ripple btn-primary m-3" href="#modalAddSection" data-toggle="modal">اضافة قسم</a>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap text-center" id="example1">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم القسم</th>
                                    <th class="border-bottom-0">الوصف</th>
                                    <th class="border-bottom-0">اضيف بواسطة </th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($sections as $section)
                                    <tr>
                                        <td class="align-middle">{{ ++$i }}</td>
                                        <td class="align-middle">{{ $section->section_name }}</td>
                                        <td class="align-middle">{{ $section->description }}</td>
                                        <td class="align-middle">{{ $section->created_by }}</td>
                                        <td class="align-middle">
                                            <a class="btn btn-primary" href="#modalEditSection" data-toggle="modal"
                                                data-id="{{ $section->id }}"
                                                data-section_name="{{ $section->section_name }}"
                                                data-description="{{ $section->description }}">{{__('تعديل')}}</a>
                                            <a class="btn btn-danger mr-2" href="#modalDeleteSection"
                                                data-toggle="modal" data-id="{{ $section->id }}"
                                                data-section_name="{{ $section->section_name }}">{{__('حذف')}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </div>
                    </table>
                </div>
            </div>
        </div>
        <!-- row closed -->

    </div>
    <!-- Container closed -->
</div>
<!-- main-content closed -->
<!-- add section modal -->
<div class="modal fade" id="modalAddSection">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">اضافة قسم</h6><button class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sections.store') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label for="section_name" class="form-label">اسم القسم</label>
                        <input type="text" class="form-control" id="section_name" name="section_name"
                            value="{{ old('section_name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label"> الوصف</label>
                        <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit">تاكيد </button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal"
                            type="button">اغلاق</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- End add section modal -->
<!-- edit section modal -->
<div class="modal fade" id="modalEditSection">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل القسم </h6><button class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('sections/update') }}" method="post" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="id" id="id" value="">
                        <label for="section_name" class="form-label">اسم القسم</label>
                        <input type="text" class="form-control" id="section_name" name="section_name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label"> الوصف</label>
                        <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit">حفظ التعديل</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal"
                            type="button">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End edit section modal -->
<!-- Delete section modal -->
<div class="modal fade" id="modalDeleteSection">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف القسم</h6><button class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('sections/destroy') }}" method="post">
                    @method('Delete')
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="id" id="id" value="">
                        <label for="section_name" class="form-label">هل انت متاكد من انك تريد حذف هذا القسم ؟</label>
                        <input type="text" class="form-control" id="section_name" name="section_name" readonly>
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
<!-- End delete section modal -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <script>
        $('#modalEditSection').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // to reach data-id, data-section_name and data_description in <a>edit</a> element
            var id = button.data('id')
            var section_name = button.data('section_name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
        })
        $('#modalDeleteSection').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // to reach data-id, data-section_name and data_description in <a>edit</a> element
            var id = button.data('id')
            var section_name = button.data('section_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
        })
    </script>
@endsection

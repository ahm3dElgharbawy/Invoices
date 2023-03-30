@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link data-target="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('الاعدادات') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('المنتجات') }}</span>
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
            <div class="alert alert-warning alert-dismissible fade show w-50 pr-2" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="pr-5">{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-success btn-icon ml-2" href="#modalAddProduct" data-toggle="modal"
                        title="{{ __('اضافة منتج') }}"><i class="fa fa-plus"></i></a><br>
                    <div class="table-responsive">
                        <table class="table text-nowrap text-center" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('اسم المنتج') }}</th>
                                    <th>{{ __('اسم القسم') }}</th>
                                    <th>{{ __('الوصف') }}</th>
                                    <th>{{ __('العمليات') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="align-middle">{{ ++$i }}</td>
                                        <td class="align-middle">{{ $product->product_name }}</td>
                                        <td class="align-middle">{{ $product->section->section_name }}</td>
                                        <td class="align-middle">{{ $product->description }}</td>
                                        <td class="align-middle">
                                            <button class="btn btn-primary py-2 px-3" title="تعديل"
                                                data-target="#modalEditProduct" data-toggle="modal"
                                                data-id="{{ $product->id }}"
                                                data-product_name="{{ $product->product_name }}"
                                                data-description="{{ $product->description }}"><i
                                                    class='bx bxs-edit-alt tx-20'></i>
                                            </button>
                                            <button class="btn btn-danger mr-2 py-2 px-3" title="حذف"
                                                data-target="#modalDeleteSection" data-toggle="modal"
                                                data-id="{{ $product->id }}"
                                                data-product_name="{{ $product->product_name }}"><i
                                                    class="bx bxs-trash-alt tx-20"></i>
                                            </button>

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
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
    <!-- add products modal -->
    <div class="modal fade" id="modalAddProduct">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('اضافة منتج') }}
                    </h6><button class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="product_name" class="form-label">{{ __('اسم المنتج') }}</label>
                            <input type="text" class="form-control" id="product_name" name="product_name"
                                value="{{ old('product_name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="section_id">{{ __('القسم') }}</label>
                            <select id="section_id" class="form-select" name="section_id" required>
                                <option value="" selected>{{ __('اختر القسم') }}</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('الوصف') }}</label>
                            <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary" type="submit">{{ __('تاكيد') }} </button>
                            <button class="btn ripple btn-secondary" data-dismiss="modal"
                                type="button">{{ __('اغلاق') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End add section modal -->
    <!-- edit section modal -->
    <div class="modal fade" id="modalEditProduct">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('تعديل المنتج') }}</h6><button class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('products/update') }}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="product_name" class="form-label">{{ __('اسم المنتج') }}</label>
                            <input type="text" class="form-control" id="product_name" name="product_name">
                        </div>
                        <div class="mb-3">
                            <label for="section_id">{{ __('القسم') }}</label>
                            <select id="section_id" class="form-select" name="section_id" required>
                                <option value="" selected>{{ __('اختر القسم') }}</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label"> الوصف</label>
                            <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary" type="submit">{{ __('حفظ التعديل') }}</button>
                            <button class="btn ripple btn-secondary" data-dismiss="modal"
                                type="button">{{ __('اغلاق') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End edit section modal -->
    <div class="modal fade" id="modalDeleteSection">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف المنتج</h6><button class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('products/destroy') }}" method="post">
                        @method('Delete')
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="id" id="id">
                            <label for="product_name" class="form-label">هل انت متاكد من انك تريد حذف هذا المنتج ؟</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" readonly>
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
        $('#modalEditProduct').on('show.bs.modal', function(event) {
            var button = $(event
                .relatedTarget
            ) // to reach data-id, data-section_name and data_description in <a>edit</a> element
            var id = button.data('id')
            var product_name = button.data('product_name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #description').val(description);
        })
        $('#modalDeleteSection').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // to reach data-id, data-section_name and data_description in <a>edit</a> element
            var id = button.data('id')
            var product_name = button.data('product_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #product_name').val(product_name);
        })
    </script>
@endsection

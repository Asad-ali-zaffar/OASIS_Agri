@extends('layouts.app')

@section('title')
    {{ __('Product Sale Invoice') }}
@endsection

@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-user-injured"></i>
                        {{ __('Product Sale Invoice') }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Product Sale Invoice') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Product Sale Invoice Table') }}</h3>
            @can('create_patient')
                <a onClick="add()" href="javascript:void(0)" class="btn btn-primary btn-sm float-right">
                    <i class="fa fa-plus"></i> {{ __('Create') }}
                </a>
            @endcan
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 table-responsive ">
                    <table class="table-bordered table-striped table-hover" id="ajax-crud-datatable">
                        <thead>
                            <tr>
                                {{-- <th width="115px">ID#</th> --}}
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Tolal Sale') }}</th>
                                <th>{{ __('Purchasee Expence') }}</th>
                                <th>{{ __('Packing Expence') }}</th>
                                <th>{{ __('Sales Expense') }}</th>
                                <th>{{ __('Totel Expense') }}</th>
                                {{-- <th width="115px">{{ __('Status') }}</th> --}}
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
@section('scripts')
    {{-- <script src="{{ url('js/admin/product_method_entry.js') }}"></script> --}}
    <script type="text/javascript">
        $(document).ready(function() {

            //active
            $('#product_sale_invoice').addClass('active');
            $('#ajax-crud-datatable').DataTable({
                dom: "<'row '<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4 'f>>" +
                    "<'row'<'col-sm-12 'tr>>" +
                    "<'row'<'col-sm-4 'i><'col-sm-8'p>>",
                buttons: [

                    {
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i> ' + trans("Copy"),
                        titleAttr: 'Copy',
                        className: 'bg-dark'

                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> ' + trans("Excel"),
                        titleAttr: 'Excel',
                        className: 'bg-dark'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i> ' + trans("CVS"),
                        titleAttr: 'CSV',
                        className: 'bg-dark'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> ' + trans("PDF"),
                        titleAttr: 'PDF',
                        className: 'bg-dark'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-file-pdf"></i> ' + trans("Print"),
                        titleAttr: 'PDF',
                        className: 'bg-dark'
                    },

                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-eye"></i> Manage Columns',
                        titleAttr: 'Manage',
                        className: 'bg-dark'
                    }

                ],
                "processing": true,
                "serverSide": true,
                // "bSort" : false,
                fixedHeader: true,
                ajax: " {{ route('admin.invoice.index') }}",
                columns: [
                    {
                        data: 'product_code',
                        name: 'product_code'
                    },
                    {
                        data: 'product_id',
                        name: 'product_id'
                    },
                    {
                        data: 'product_quantity',
                        name: 'product_quantity'
                    },
                    {
                        data: 'purchasee_expence',
                        name: 'purchasee_expence'
                    },
                    {
                        data: 'packing_expence',
                        name: 'packing_expence'
                    },
                    {
                        data: 'sales_expense',
                        name: 'sales_expense'
                    },
                    {
                        data: 'product_expence',
                        name: 'product_expence'
                    },

                ],
                order: [
                    [0, 'desc']
                ]
            });
        });

        // function add() {
        //     $('#CompanyForm').trigger("reset");
        //     $('#CompanyModal').html("Add Product");
        //     $('#company-modal').modal('show');
        //     $('#id').val('');
        // }

        // function editFunc(id) {
        //     $.ajax({
        //         type: "POST",
        //         url: "{{ route('admin.product.edit') }}",
        //         data: {
        //             id: id
        //         },
        //         dataType: 'json',
        //         success: function(res) {
        //             $('#CompanyModal').html("Edit Company");
        //             $('#company-modal').modal('show');
        //             $('#id').val(res.id);
        //             $('#product_name').val(res.product_name);
        //             $('#product_code').val(res.product_code);
        //         }
        //     });
        // }

        // function deleteFunc(id) {
        //     if (confirm("Delete Record?") == true) {
        //         var id = id;
        //         // ajax
        //         $.ajax({
        //             type: "POST",
        //             url: "{{ route('admin.product.delete') }}",
        //             data: {
        //                 id: id
        //             },
        //             dataType: 'json',
        //             success: function(res) {
        //                 var oTable = $('#ajax-crud-datatable').dataTable();
        //                 oTable.fnDraw(false);
        //             }
        //         });
        //     }
        // }
        // $('#CompanyForm').submit(function(e) {
        //     e.preventDefault();
        //     var formData = new FormData(this);
        //     $.ajax({
        //         type: 'POST',
        //         url: "{{ route('admin.product.store') }}",
        //         data: formData,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         success: (data) => {
        //             $("#company-modal").modal('hide');
        //             var oTable = $('#ajax-crud-datatable').dataTable();
        //             oTable.fnDraw(false);
        //             $("#btn-save").html('Save changes');
        //             $("#btn-save").attr("disabled", false);
        //         },
        //         error: function(data) {
        //             console.log(data);
        //         }
        //     });
        // });
        // $('#CompanyForm').validate({
        //     rules: {
        //         product_name: {
        //             required: true
        //         },
        //         product_code: {
        //             required: true,
        //             number: true
        //         },

        //     },
        //     errorElement: 'span',
        //     errorPlacement: function(error, element) {
        //         error.addClass('invalid-feedback');
        //         element.closest('.form-group').append(error);
        //     },
        //     highlight: function(element, errorClass, validClass) {
        //         $(element).addClass('is-invalid');
        //     },
        //     unhighlight: function(element, errorClass, validClass) {
        //         $(element).removeClass('is-invalid');
        //     }
        // });
    </script>
@endsection

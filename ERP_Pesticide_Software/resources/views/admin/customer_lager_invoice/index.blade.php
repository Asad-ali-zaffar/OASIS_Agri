@extends('layouts.app')

@section('title')
    {{ __('Customer Ledger Invoice') }}
@endsection

@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-user-injured"></i>
                        {{ __('Customer Ledger Invoice') }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Customer Ledger Invoice') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Customer Ledger Invoice Table') }}</h3>
            {{-- @can('create_patient')
                <a onClick="add()" href="javascript:void(0)" class="btn btn-primary btn-sm float-right">
                    <i class="fa fa-plus"></i> {{ __('Create') }}
                </a>
            @endcan --}}
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card-body">
            <!-- filter -->
            <div id="accordion">
                <div class="card card-info">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary collapsed"
                        aria-expanded="false">
                        <i class="fas fa-filter"></i> {{ __('Filters') }}
                    </a>
                    <div id="collapseOne" class="panel-collapse in collapse">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <form action="javascript:void(0)" id="CompanyForm" method="POST" class="filter_form"
                                        onsubmit="return setAction(this)">
                                        {{-- {{route('admin.customer_lager_invoice.show')}}" --}}
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{-- <label for="date">{{__('Date')}}</label> --}}

                                                    <label for="name" class="col-sm-6 control-label">Customer
                                                        Name</label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                            <select class="form-control" name="customer_id"
                                                                placeholder="{{ __('Customer') }}" id="customer_id"
                                                                required="">
                                                                <option value="">Please Select Customer *</option>
                                                                @foreach ($data['customer'] as $single)
                                                                    <option value="{{ $single['id'] }}"
                                                                        @if (isset($patient) && $patient['customer_id'] == $single['id']) selected @endif>
                                                                        {{ $single['customer_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('customer_id')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="actions">Actions</label><br>
                                                    <button class="btn btn-danger" type="submit">Show Data By Filters
                                                    </button>
                                                    <a href="javascript:void(0);" class="btn btn-primary download_pdf"
                                                        data-url="{{ route('admin.customer_lager_invoice.pdf') }}?download=1">Download
                                                        Data By Filters (as PDF)
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- \filter -->
            <div class="row">
                <div class="col-lg-12 table-responsive ">
                    <table class="table-striped table-hover table-bordered" id="patients_table">
                        <thead>
                            <tr>
                                <th>{{ __('Customer Name') }}</th>
                                <th>{{ __('Purchasee Product') }}</th>
                                <th>{{ __('Product Quantity') }}</th>
                                <th>{{ __('Product Price') }}</th>
                                <th>{{ __('Purchasee Date') }}</th>
                                <th>{{ __('Policy Name') }}</th>
                                <th>{{ __('Policy Code') }}</th>
                                <th>{{ __('Policy Discount') }}</th>
                                <th>{{ __('Credit Note') }}</th>
                                <th>{{ __('Return Date') }}</th>
                                <th>{{ __('Return Product Quantity') }}</th>
                                <th>{{ __('Total Quantity') }}</th>
                                <th>{{ __('Total Bill') }}</th>
                                <th>{{ __('Advance Amount') }}</th>
                                <th>{{ __('Total Amount') }}</th>
                                <th>{{ __('Payable Amount') }}</th>
                                <th>{{ __('Receivable Amount') }}</th>
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
            $(document).on("click", ".download_pdf", function() {
                $('#CompanyForm').removeAttr("action");
                var preview = document.getElementById("CompanyForm");
                preview.setAttribute('action', "{{ route('admin.customer_lager_invoice.pdf') }}");
            });
            //active
            $('#customer_lager_invoice').addClass('active');
            $('#patients_table').DataTable({
                // dom: "<'row '<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4 'f>>" +
                //     "<'row'<'col-sm-12 'tr>>" +
                //     "<'row'<'col-sm-4 'i><'col-sm-8'p>>",
                // buttons: [

                //     {
                //         extend: 'copyHtml5',
                //         text: '<i class="fas fa-copy"></i> ' + trans("Copy"),
                //         titleAttr: 'Copy',
                //         className: 'bg-dark'

                //     },
                //     {
                //         extend: 'excelHtml5',
                //         text: '<i class="fas fa-file-excel"></i> ' + trans("Excel"),
                //         titleAttr: 'Excel',
                //         className: 'bg-dark'
                //     },
                //     {
                //         extend: 'csvHtml5',
                //         text: '<i class="fas fa-file-csv"></i> ' + trans("CVS"),
                //         titleAttr: 'CSV',
                //         className: 'bg-dark'
                //     },
                //     {
                //         extend: 'pdfHtml5',
                //         text: '<i class="fas fa-file-pdf"></i> ' + trans("PDF"),
                //         titleAttr: 'PDF',
                //         className: 'bg-dark'
                //     },
                //     {
                //         extend: 'print',
                //         text: '<i class="fas fa-file-pdf"></i> ' + trans("Print"),
                //         titleAttr: 'PDF',
                //         className: 'bg-dark'
                //     },

                //     {
                //         extend: 'colvis',
                //         text: '<i class="fas fa-eye"></i> Manage Columns',
                //         titleAttr: 'Manage',
                //         className: 'bg-dark'
                //     }

                // ],
                "processing": true,
                "serverSide": true,
                // "bSort" : false,
                fixedHeader: true,
                ajax: " {{ route('admin.customer_lager_invoice.index') }}",
                customer_id: $("#customer_id").val(),
                columns: [{
                        data: 'customer_id',
                        name: 'customer_id'
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
                        data: 'product_Sale_price',
                        name: 'product_Sale_price'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'policy_name',
                        name: 'policy_name'
                    },
                    {
                        data: 'policy_code',
                        name: 'policy_code'
                    },
                    {
                        data: 'policy_discount',
                        name: 'policy_discount'
                    },
                    {
                        data: 'credit_note',
                        name: 'credit_note'
                    },
                    {
                        data: 'return_date',
                        name: 'return_date'
                    },
                    {
                        data: 'return_product_quantity',
                        name: 'return_product_quantity'
                    },
                    {
                        data: 'total_quantity',
                        name: 'total_quantity'
                    },
                    {
                        data: 'bill',
                        name: 'bill'
                    },

                    {
                        data: 'advance_amount',
                        name: 'advance_amount'
                    },
                    {
                        data: 'totalamount',
                        name: 'totalamount'
                    },
                    {
                        data: 'PayableAmount',
                        name: 'PayableAmount'
                    },
                    {
                        data: 'ReceivableAmount',
                        name: 'ReceivableAmount'
                    },

                ],
                order: [
                    [0, 'desc']
                ],


            });
        });


        $('#CompanyForm').submit(function(e) {
            // reinitialize datatable
            $("#patients_table").dataTable().fnDestroy();
            //reinitialize datatable
            $('#patients_table').DataTable({
                // dom: "<'row '<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4 'f>>" +
                //     "<'row'<'col-sm-12 'tr>>" +
                //     "<'row'<'col-sm-4 'i><'col-sm-8'p>>",
                // buttons: [

                //     {
                //         extend: 'copyHtml5',
                //         text: '<i class="fas fa-copy"></i> ' + trans("Copy"),
                //         titleAttr: 'Copy',
                //         className: 'bg-dark'

                //     },
                //     {
                //         extend: 'excelHtml5',
                //         text: '<i class="fas fa-file-excel"></i> ' + trans("Excel"),
                //         titleAttr: 'Excel',
                //         className: 'bg-dark'
                //     },
                //     {
                //         extend: 'csvHtml5',
                //         text: '<i class="fas fa-file-csv"></i> ' + trans("CVS"),
                //         titleAttr: 'CSV',
                //         className: 'bg-dark'
                //     },
                //     {
                //         extend: 'pdfHtml5',
                //         text: '<i class="fas fa-file-pdf"></i> ' + trans("PDF"),
                //         titleAttr: 'PDF',
                //         className: 'bg-dark'
                //     },
                //     {
                //         extend: 'print',
                //         text: '<i class="fas fa-file-pdf"></i> ' + trans("Print"),
                //         titleAttr: 'PDF',
                //         className: 'bg-dark'
                //     },

                //     {
                //         extend: 'colvis',
                //         text: '<i class="fas fa-eye"></i> Manage Columns',
                //         titleAttr: 'Manage',
                //         className: 'bg-dark'
                //     }

                // ],
                "processing": true,
                "serverSide": true,
                // "bSort" : false,
                fixedHeader: true,
                processing: true,
                serverSide: true,
                ajax: {
                    method: 'get',
                    data: {
                        customer_id: $("#customer_id").val()
                    },
                    url: " {{ route('admin.customer_lager_invoice.show') }}"
                },
                columns: [{
                        data: 'customer_id',
                        name: 'customer_id'
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
                        data: 'product_Sale_price',
                        name: 'product_Sale_price'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'policy_name',
                        name: 'policy_name'
                    },
                    {
                        data: 'policy_code',
                        name: 'policy_code'
                    },
                    {
                        data: 'policy_discount',
                        name: 'policy_discount'
                    },
                    {
                        data: 'credit_note',
                        name: 'credit_note'
                    },
                    {
                        data: 'return_date',
                        name: 'return_date'
                    },
                    {
                        data: 'return_product_quantity',
                        name: 'return_product_quantity'
                    },
                    {
                        data: 'total_quantity',
                        name: 'total_quantity'
                    },
                    {
                        data: 'bill',
                        name: 'bill'
                    },

                    {
                        data: 'advance_amount',
                        name: 'advance_amount'
                    },
                    {
                        data: 'totalamount',
                        name: 'totalamount'
                    },
                    {
                        data: 'PayableAmount',
                        name: 'PayableAmount'
                    },
                    {
                        data: 'ReceivableAmount',
                        name: 'ReceivableAmount'
                    },

                ],
                order: [
                    [0, 'desc']
                ]
            });

        });
        $('#CompanyForm').validate({
            rules: {
                customer_id: {
                    required: true,
                    number: true
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
        $(document).on('click', '.download_pdf', function() {
            var data = $('.filter_form').serialize();
            console.log($(this).data('url') + '&' + data)
            window.location.href = $(this).data('url') + '&' + data;
        });
    </script>
@endsection

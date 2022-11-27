@extends('layouts.app')

@section('title')
    {{ __('Sales Registeration') }}
@endsection

@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-user-injured"></i>
                        {{ __('Sales Registeration') }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Sales') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Sales Table') }}</h3>
            {{-- @can('create_patient') --}}
            <a onClick="add()" href="javascript:void(0)" class="btn btn-primary btn-sm float-right">
                <i class="fa fa-plus"></i> {{ __('Create') }}
            </a>
            {{-- @endcan --}}
        </div>
        <!-- /.card-header -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 table-responsive ">

                    <table class="table-striped table-hover table-bordered" id="ajax-crud-datatable">
                        <thead>
                            <tr>
                                <th width="20px">ID#</th>
                                <th>{{ __('Customer Name') }}</th>
                                <th>{{ __('Customer Phone No') }}</th>
                                <th>{{ __('Customer CNIC') }}</th>
                                <th>{{ __('Product Name') }}</th>
                                <th>{{ __('Product Code') }}</th>
                                <th>{{ __('Product Sale Price') }}</th>
                                <th>{{ __('Policy Name') }}</th>
                                <th>{{ __('Policy Code') }}</th>
                                <th>{{ __('Discount%') }}</th>
                                <th>{{ __('Credit Note%') }}</th>
                                <th>{{ __('Delivery Charges') }}</th>
                                <th>{{ __('Product Quantity') }}</th>
                                <th>{{ __('Recive Amount') }}</th>
                                <th>{{ __('Total Bill') }}</th>
                                <th width="115px">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- boostrap company model -->
    <div class="modal fade" id="company-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-xl">
            <div class="modal-content">
                <form action="javascript:void(0)" id="CompanyForm" name="CompanyForm" class="form-horizontal" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-info">
                        <h1 class="modal-title "><b id="CompanyModal"></b></h1>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-6 control-label">Customer Name</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <select class="form-control" name="customer_id"
                                                placeholder="{{ __('Customer') }}" id="customer_id" required="">
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
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-6 control-label">Customer Phone No</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="customer_phone_no"
                                                name="customer_phone_no" placeholder="Customer Phone No" maxlength="50"
                                                required="" readonly>
                                        </div>
                                    </div>

                                    <span class="text-danger">
                                        @error('customer_phone_no')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-6 control-label">Customer CNIC</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-id-card" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="customer_CNiC"
                                                name="customer_CNiC" placeholder="Customer CNIC" maxlength="15"
                                                required="" readonly>
                                        </div>
                                    </div>

                                    <span class="text-danger">
                                        @error('customer_phone_no')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-6 control-label">Product Name</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <select class="form-control" name="product_id"
                                                placeholder="{{ __('Product') }}" id="product_id" required="">
                                                <option value="">Please Select Product *</option>
                                                @foreach ($data['product'] as $single)
                                                    <option value="{{ $single['id'] }}"
                                                        @if (isset($patient) && $patient['product_id'] == $single['id']) selected @endif>
                                                        {{ $single['product_name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('customer_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-6 control-label">Product Code</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-barcode" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="product_code"
                                                name="product_code" placeholder="Product Code" maxlength="50"
                                                required="" readonly>
                                        </div>
                                    </div>

                                    <span class="text-danger">
                                        @error('product_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Product Saling Price </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-doler" aria-hidden="true">Rs</i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="product_seal_price"
                                                name="product_seal_price" placeholder="Saling Price" required=""
                                                readonly>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('product_seal_price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-6 control-label">Policy Name</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <select class="form-control" name="policy_id"
                                                placeholder="{{ __('Policy Name') }}" id="policy_id" required="">
                                                <option value="">Please Select Policy *</option>
                                                @foreach ($data['policies'] as $single)
                                                    <option value="{{ $single['id'] }}"
                                                        @if (isset($patient) && $patient['policy_id'] == $single['id']) selected @endif>
                                                        {{ $single['policy_name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('customer_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-6 control-label">Policy Code</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-barcode" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="policy_code"
                                                name="policy_code" placeholder="Policy Code" maxlength="50"
                                                required="" readonly>
                                        </div>
                                    </div>

                                    <span class="text-danger">
                                        @error('policy_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Policy Discount % </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-percent" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="policy_discount"
                                                name="policy_discount" placeholder="Policy Discount" required=""
                                                readonly>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('policy_discount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Credit Note (CN)%</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-percent" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="credit_note"
                                                name="credit_note" placeholder="Credit Note (CN)" required=""
                                                readonly>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('credit_note')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Delivery Charges</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fas fa-money-bill-wave"></i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="delivery_charges"
                                                name="delivery_charges" placeholder="Delivery Charges">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('delivery_charges')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Product Quantity</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="product_quantity"
                                                name="product_quantity" placeholder="Enter Product Quantity"
                                                required="">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('product_quantity')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Recived Amount</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fas fa-money-bill-wave    "></i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="recive_amount"
                                                name="recive_amount" placeholder="Enter Recived Amount"
                                                required="">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('recive_amount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-sm-offset-2 col-sm-10">
                                &nbsp;&nbsp;&nbsp;&nbsp; <button type="submit" class="btn btn-outline-primary"
                                    id="btn-save">
                                    <i class="fa fa-check" aria-hidden="true"></i> Save changes
                                </button>

                                <button type="reset" class="btn btn-outline-warning card-title">
                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                    Cancel</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
    </div>
    <!-- end bootstrap model -->
@endsection
@section('scripts')
    {{-- <script src="{{ url('js/admin/product_method_entry.js') }}"></script> --}}
    <script type="text/javascript">
        $(document).ready(function() {
            // getBuyPolicy
            //active
            $('#Seal').addClass('active');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('change', '#product_id', function(e) {
                var id = $('#product_id').val();
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.Sale.create') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#product_code').val(res.product_code);
                        $('#product_seal_price').val(res.sealing_price);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status +' '+thrownError);
                    }
                });
            });
            $(document).on('change', '#customer_id', function(e) {
                var id = $('#customer_id').val();
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.Sale.show') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#customer_phone_no').val(res.phone_number_one);
                        $('#customer_CNiC').val(res.CNIC);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status +' '+thrownError);
                    }

                });
            });
            $(document).on('change', '#policy_id', function(e) {
                var customer_id = $('#customer_id').val();
                var policy_id = $('#policy_id').val();
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.Sale.getBuyPolicy') }}",
                    data: {
                        customer_id: customer_id,
                        policy_id: policy_id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#policy_code').val(res.policy_code);
                        $('#policy_discount').val(res.discount);
                        $('#credit_note').val(res.credit_note);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status +' '+thrownError);
                    }

                });
            });

            $('#ajax-crud-datatable').DataTable({
                // dom: "<'row '<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4 'f>>" +
                //     "<'row'<'col-sm-12 'tr>>" +
                //     "<'row'<'col-sm-4 'i><'col-sm-8'p>>",
                // buttons: [

                //     {
                //         extend: 'copyHtml5',
                //         text: '<i class="fas fa-copy"></i> ' + trans("Copy"),
                //         titleAttr: 'Copy',
                //         className: 'bg-light',
                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                //             alignment: 'center',
                //         },

                //     },
                //     {
                //         extend: 'excelHtml5',
                //         text: '<i class="fas fa-file-excel"></i> ' + trans("Excel"),
                //         titleAttr: 'Excel',
                //         className: 'bg-light',
                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                //             alignment: 'center',
                //         },
                //     },
                //     {
                //         extend: 'csvHtml5',
                //         text: '<i class="fas fa-file-csv"></i> ' + trans("CVS"),
                //         titleAttr: 'CSV',
                //         className: 'bg-light',
                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                //             alignment: 'center',
                //         },
                //     },
                //     {
                //         extend: 'pdfHtml5',
                //         text: '<i class="fas fa-file-pdf"></i> ' + trans("PDF"),
                //         titleAttr: 'PDF',
                //         className: 'bg-light',
                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                //             alignment: 'center',
                //         },
                //     },
                //     {
                //         extend: 'print',
                //         text: '<i class="fas fa-print"></i> ' + trans("Print"),
                //         titleAttr: 'Print',
                //         className: 'bg-light',
                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                //             alignment: 'center',
                //         },
                //         // autoPrint: true,
                //         orientation: 'landscape',
                //         pageSize: 'A4',
                //     },

                //     // {
                //     //     extend: 'colvis',
                //     //     text: '<i class="fas fa-eye"></i> Manage Columns',
                //     //     titleAttr: 'Manage',
                //     //     className: 'bg-dark'
                //     // }

                // ],
                "processing": true,
                "serverSide": true,
                // "bSort" : false,
                fixedHeader: true,
                ajax: " {{ route('admin.Sale.index') }}",
                columns: [{
                        data: 'seal_id',
                        name: 'seal_id'
                    },
                    {
                        data: 'customer_name',
                        name: 'customer_name'
                    },

                    {
                        data: 'customer_phone_no',
                        name: 'customer_phone_no'
                    },
                    {
                        data: 'customer_CNiC',
                        name: 'customer_CNiC'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'product_code',
                        name: 'product_code'
                    },
                    {
                        data: 'product_seal_price',
                        name: 'product_seal_price'
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
                        data: 'charges_amount',
                        name: 'charges_amount'
                    },
                    {
                        data: 'product_quantity',
                        name: 'product_quantity'
                    },
                    {
                        data: 'recive_amount',
                        name: 'recive_amount'
                    },
                    {
                        data: 'total_bill',
                        name: 'total_bill'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });
        });

        function add() {
            $('#CompanyForm').trigger("reset");
            $('#CompanyModal').html("Add New Purchasing Registeration");
            $('#company-modal').modal('show');
            $('#id').val('');
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.Sale.edit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#CompanyModal').html("Edit Purchasing Registeration");
                    $('#company-modal').modal('show');
                    $('#id').val(res.id);
                    $('#customer_id').val(res.customer_id);
                    $('#customer_phone_no').val(res.customer_phone_no);
                    $('#customer_CNiC').val(res.customer_CNiC);
                    $('#product_id').val(res.product_id);
                    $('#product_code').val(res.product_code);
                    $('#product_seal_price').val(res.product_seal_price);
                    $('#policy_id').val(res.policy_id);
                    $('#policy_code').val(res.policy_code);
                    $('#policy_discount').val(res.policy_discount);
                    $('#credit_note').val(res.credit_note);
                    $('#delivery_charges').val(res.delivery_charges);
                    $('#product_quantity').val(res.product_quantity);
                    $('#recive_amount').val(res.recive_amount);
                }

            });
        }

        function deleteFunc(id) {
            if (confirm("Delete Record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.Sale.delete') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        var oTable = $('#ajax-crud-datatable').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        }
        $('#CompanyForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.Sale.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#company-modal").modal('hide');
                    var oTable = $('#ajax-crud-datatable').dataTable();
                    oTable.fnDraw(false);
                    $("#btn-save").html('Save changes');
                    // $("#btn-save").attr("disabled", false);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
        $('#CompanyForm').validate({
            rules: {
                product_id: {
                    required: true,
                    number: true
                },
                product_code: {
                    required: true

                },
                purchasing_price: {
                    required: true,
                    number: true
                },
                sealing_price: {
                    required: true,
                    number: true
                },
                expiry_date: {
                    required: true,
                    date: true
                },
                purchasing_expense: {
                    required: true,
                    number: true
                },
                product_quantity: {
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
    </script>
@endsection

@extends('layouts.app')

@section('title')
    {{ __('Returned Product Registeration') }}
@endsection

@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-user-injured"></i>
                        {{ __('Returned Product Registeration') }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Returned Product') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Returned Product Table') }}</h3>
            {{-- @can('create_patient') --}}
            {{-- <a onClick="add()" href="javascript:void(0)" class="btn btn-primary btn-sm float-right">
                <i class="fa fa-plus"></i> {{ __('Create') }}
            </a> --}}
            <a href="{{ route('admin.returned_product.create') }}" class="btn btn-primary btn-sm float-right">
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
                                <th>ID#</th>
                                <th>{{ __('Customer Name') }}</th>
                                <th>{{ __('Customer Phone No') }}</th>
                                <th>{{ __('Customer CNiC') }}</th>
                                {{-- <th>{{ __('Product name') }}</th>
                                <th>{{ __('Product code') }}</th>
                                <th>{{ __('Product Sale Price') }}</th>
                                <th>{{ __('Product Quantity') }}</th> --}}
                                <th>{{ __('Date/Time') }}</th>
                                <th>{{ __('Return Amount') }}</th>
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
                                    <label for="name" class="col-sm-6 control-label">Customer CNiC</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-id-card" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="customer_CNiC"
                                                name="customer_CNiC" placeholder="Customer CNiC" maxlength="15"
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
                                    <label for="name" class="col-sm-12 control-label">Product Code</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-doler"><b>#</b></i>
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
                                    <label class="col-sm-6 control-label">Product Saleing Price </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-doler" aria-hidden="true">Rs</i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="product_Sale_price"
                                                name="product_Sale_price" placeholder="Saleing Price" required=""
                                                readonly>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('product_Sale_price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4 d-none">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Delivery Charges</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-dolar" aria-hidden="true">Rs</i>
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
                            <div class="col-lg-4 d-none">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Charges Amount</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-dolar" aria-hidden="true">Rs</i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="charges_amount"
                                                name="charges_amount" placeholder="Charges Amount">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('charges_amount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Sale Product Quantity</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-amount-asc" aria-hidden="true">Q</i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="Sale_product_quantity"
                                                name="Sale_product_quantity" placeholder="Enter Sale Product Quantity"
                                                required="" readonly>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('Sale_product_quantity')
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
                                                    <i class="fa fa-amount-asc" aria-hidden="true">Q</i>
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
                                    <label class="col-sm-12 control-label">Return Date And Time</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-clock" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="datetime-local" class="form-control" id="return_date_and_time"
                                                name="return_date_and_time" placeholder="Enter Product Quantity"
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
                            <div class="col-lg-4 d-none">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Total Bill</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-amount-asc" aria-hidden="true">Q</i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="total_bill" name="total_bill"
                                                placeholder="Total Amount" required="">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('total_bill')
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
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script type="text/javascript">
        var table;
        $(document).ready(function() {

            //active
            $('#returned_product').addClass('active');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            table = $('#ajax-crud-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: " {{ route('admin.returned_product.index') }}",
                columns: [{
                        // data: 'return_id',
                        "className": 'dt-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
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
                    // {
                    //     data: 'product_name',
                    //     name: 'product_name'
                    // },
                    // {
                    //     data: 'product_code',
                    //     name: 'product_code'
                    // },
                    // {
                    //     data: 'product_sale_price',
                    //     name: 'product_sale_price'
                    // },

                    // {
                    //     data: 'receivedQuantity',
                    //     name: 'receivedQuantity'
                    // },
                    {
                        data: 'return_date_and_time',
                        name: 'return_date_and_time'
                    },
                    {
                        data: 'return_amount',
                        name: 'return_amount'
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
        // Add event listener for opening and closing details
        $('#ajax-crud-datatable').on('click', 'td.dt-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
                tr.removeClass('dt-hasChild');
                tr.addClass('dt-control');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
                tr.addClass('dt-hasChild');
            }
        });
        /* Formatting function for row details - modify as you need */
        function format(d) {
            // `d` is the original data object for the row
            var recordes = JSON.parse(d.return_product);
            // return recordes;
            var html = "<table border='1|1' width='100%'>";
            recordes.forEach((recorde) => {
                html += "<tr>";
                html += "<td>Product name:</td>";
                html += "<td>" + recorde.product_name + "</td>";
                html += "<td>Product Code:</td>";
                html += "<td>" + recorde.product_code + "</td>";
                html += "</tr>";
                html += "<tr>";
                html += "<td>Sale Price:</td>";
                html += "<td>" + recorde.product_sale_price + "</td>";
                html += "<td>Sale Quantity:</td>";
                html += "<td>" + recorde.product_quantity+ "</td>";
                html += "</tr>";
                html += "<tr>";
                html += "<td>Received Quantity:</td>";
                html += "<td>" + recorde.receivedQuantity + "</td>";
                html += "<td>Return Amount:</td>";
                html += "<td>" + recorde.return_amount + "</td>";
                html += "</tr>";
            });
            html += "</table>";
            return html;
           }

        function deleteFunc(id) {
            if (confirm("Delete Record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.returned_product.delete') }}",
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
                Saleing_price: {
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

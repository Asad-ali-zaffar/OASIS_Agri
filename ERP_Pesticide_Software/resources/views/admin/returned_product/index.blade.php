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

                    <table class="table table-bordered" id="ajax-crud-datatable">
                        <thead>
                            <tr>
                                <th width="20px">ID#</th>
                                <th>{{ __('Customer Name') }}</th>
                                <th>{{ __('Customer Phone No') }}</th>
                                <th>{{ __('Customer CNiC') }}</th>
                                <th>{{ __('Product name') }}</th>
                                <th>{{ __('Product code') }}</th>
                                <th>{{ __('Product Sale Price') }}</th>
                                <th>{{ __('Date/Time') }}</th>
                                <th>{{ __('Product Quantity') }}</th>
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
                                            <input type="text" class="form-control" id="customer_phone_no" name="customer_phone_no"
                                                placeholder="Customer Phone No" maxlength="50" required="" readonly>
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
                                            <input type="text" class="form-control" id="customer_CNiC" name="customer_CNiC"
                                                placeholder="Customer CNiC" maxlength="15" required="" readonly>
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
                                                    <i class="fa fa-doler"><b>#</b></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="product_code" name="product_code"
                                                placeholder="Product Code" maxlength="50" required="" readonly>
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
                                    <label class="col-sm-6 control-label">Product Sealing Price </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-doler" aria-hidden="true">Rs</i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="product_seal_price"
                                                name="product_seal_price" placeholder="Sealing Price" required="" readonly>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('product_seal_price')
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
                                                name="delivery_charges" placeholder="Delivery Charges" >
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
                                                name="charges_amount" placeholder="Charges Amount" >
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
                                    <label class="col-sm-6 control-label">Seal Product Quantity</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-amount-asc" aria-hidden="true">Q</i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="seal_product_quantity"
                                                name="seal_product_quantity" placeholder="Enter Seal Product Quantity" required="" readonly>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('seal_product_quantity')
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
                                                name="product_quantity" placeholder="Enter Product Quantity" required="">
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
                                                name="return_date_and_time" placeholder="Enter Product Quantity" required="" >
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
                                            <input type="number" class="form-control" id="total_bill"
                                                name="total_bill" placeholder="Total Amount" required="">
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
    {{-- <script src="{{ url('js/admin/product_method_entry.js') }}"></script> --}}
    <script type="text/javascript">
        $(document).ready(function() {

            //active
            $('#returned_product').addClass('active');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('change', '#product_id', function(e) {
                var id = $('#product_id').val();
                var c_id = $('#customer_id').val();
                $("#product_quantity").attr("readonly", false);
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.returned_product.create') }}",
                    data: {
                        id: id,
                        c_id: c_id,
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#product_code').val(res.product_code);
                        $('#product_seal_price').val(res.product_seal_price);
                        $('#seal_product_quantity').val(res.product_quantity);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status +' '+thrownError);
                    }

                });
            });
            $(document).on('keyup', '#product_quantity', function(e) {
                var seal_quantity = $('#seal_product_quantity').val();
                var return_quantity = $('#product_quantity').val();
                var ret=seal_quantity-return_quantity;
                if(ret <= 0){
                    $("#product_quantity").attr("readonly", true);
                    $('#product_quantity').val(seal_quantity);
                }
            });
            $(document).on('change', '#customer_id', function(e) {
                var id = $('#customer_id').val();
                $("#product_quantity").attr("readonly", false);
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.returned_product.show') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#customer_phone_no').val(res.customer_phone_no);
                        $('#customer_CNiC').val(res.customer_CNiC);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status +' '+thrownError);
                    }

                });
            });

            $('#ajax-crud-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: " {{ route('admin.returned_product.index') }}",
                columns: [{
                        data: 'return_id',
                        name: 'return_id'
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
                        data: 'return_date_and_time',
                        name: 'return_date_and_time'
                    },
                    {
                        data: 'product_quantity',
                        name: 'product_quantity'
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
            $('#CompanyModal').html("Add New Returned Product Registeration");
            $('#company-modal').modal('show');
            $('#id').val('');
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.returned_product.edit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#CompanyModal').html("Edit Returned Product Registeration");
                    $('#company-modal').modal('show');
                    $('#id').val(res.id);
                    $('#customer_id').val(res.customer_id);
                    $('#customer_phone_no').val(res.customer_phone_no);
                    $('#customer_CNiC').val(res.customer_CNiC);
                    $('#product_id').val(res.product_id);
                    $('#product_code').val(res.product_code);
                    $('#product_seal_price').val(res.product_seal_price);
                    $('#delivery_charges').val(res.delivery_charges);
                    $('#product_quantity').val(res.product_quantity);
                    $('#return_date_and_time').val(res.return_date_and_time);
                }

            });
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
        $('#CompanyForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.returned_product.store') }}",
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

@extends('layouts.app')

@section('title')
    {{ __('New Purchasing Registeration') }}
@endsection

@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-user-injured"></i>
                        {{ __('New Purchasing Registeration') }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Purchasing') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Purchasing Table') }}</h3>
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
                                <th>{{ __('Product name') }}</th>
                                <th>{{ __('Product code') }}</th>
                                <th>{{ __('Purchase Price ') }}</th>
                                <th>{{ __('Sale Price') }}</th>
                                <th>{{ __('Expiry date') }}</th>
                                <th>{{ __('Purchase Expense') }}</th>
                                <th>{{ __('Product Quantity') }}</th>
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
                                    <label class="col-sm-6 control-label">Purchase Price</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-doler" aria-hidden="true">Rs</i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="purchasing_price"
                                                name="purchasing_price" placeholder="Purchase Price" required="">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('purchasing_price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Sale Price</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-doler" aria-hidden="true">Rs</i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="sealing_price"
                                                name="sealing_price" placeholder="Sale Price" required="">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('sealing_price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Expiry date</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="date" class="form-control" id="expiry_date"
                                                name="expiry_date" placeholder="Expiry date" required="">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('expiry_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Purchase Expense</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-doler" aria-hidden="true">Rs</i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="purchasing_expense"
                                                name="purchasing_expense" placeholder="Enter Purchase Expense"
                                                required="">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('purchasing_expense')
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
            $('#purchase').addClass('active');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('change', '#product_id', function(e) {
                var id = $('#product_id').val();
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.purchase.create') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#product_code').val(res.product_code);
                    }

                });
            });

            $('#ajax-crud-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: " {{ route('admin.purchase.index') }}",
                columns: [{
                        data: 'purchases_id',
                        name: 'purchases_id'
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
                        data: 'purchasing_price',
                        name: 'purchasing_price'
                    },
                    {
                        data: 'sealing_price',
                        name: 'sealing_price'
                    },
                    {
                        data: 'expiry_date',
                        name: 'expiry_date'
                    },
                    {
                        data: 'purchasing_expense',
                        name: 'purchasing_expense'
                    },
                    {
                        data: 'product_quantity',
                        name: 'product_quantity'
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
            $('#CompanyModal').html("Add New Purchase Registeration");
            $('#company-modal').modal('show');
            $('#id').val('');
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.purchase.edit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#CompanyModal').html("Edit Purchase Registeration");
                    $('#company-modal').modal('show');
                    $('#id').val(res.id);
                    $('#product_id').val(res.product_id);
                    $('#product_code').val(res.product_code);
                    $('#purchasing_price').val(res.purchasing_price);
                    $('#sealing_price').val(res.sealing_price);
                    $('#expiry_date').val(res.expiry_date);
                    $('#purchasing_expense').val(res.purchasing_expense);
                    $('#product_quantity').val(res.product_quantity);
                }

            });
        }

        function deleteFunc(id) {
            if (confirm("Delete Record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.purchase.delete') }}",
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
                url: "{{ route('admin.purchase.store') }}",
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

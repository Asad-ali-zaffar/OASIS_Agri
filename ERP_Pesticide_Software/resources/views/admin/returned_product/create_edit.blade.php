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
                        {{ __('Add New Returned Product Registeration') }}
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
    <div class="card card-primary card-outline repeater">
        <div class="card-header">
            <h3 class="card-title">{{ __('Returned Product Form') }}</h3>
            <a href="{{ route('admin.returned_product.index') }}" class="btn btn-primary btn-sm float-right">
                <i class="fa fa-list"></i> {{ __('Back') }}
            </a>
        </div>
        <div class="modal-content">
            <form action="{{ route('admin.returned_product.store') }}" id="CompanyForm" name="CompanyForm"
                class="form-horizontal" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-info">
                    <h1 class="modal-title "><b id="CompanyModal"> Add New Returned Product Registeration</b></h1>
                    @if (!isset($recode))
                        <a href="javascript:;" id="add" data-repeater-create class="btn btn-success">
                            <i class="fa fa-plus"></i>Add
                        </a>
                    @endif
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id"
                        @if (isset($recode)) value="{{ $recode->id }}" @endif>
                    <div class="row">
                        <div class="col-lg-4 p-0">
                            <div class="form-group">
                                <label for="name" class="col-sm-6 control-label">Customer Name</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" name="customer_id" placeholder="{{ __('Customer') }}"
                                            id="customer_id" required="">
                                            <option value="">Please Select Customer *</option>
                                            @foreach ($customer as $single)
                                                <option value="{{ $single['id'] }}"
                                                    @if (isset($recode) && $recode['customer_id'] == $single['id']) selected @endif>
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
                        <div class="col-lg-4 p-0">
                            <div class="form-group">
                                <label for="name" class="col-sm-6 control-label">Customer Phone No</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="customer_phone_no" readonly
                                            name="customer_phone_no" placeholder="Customer Phone No" maxlength="50"
                                            @if (isset($recode)) value="{{ $recode['customer_phone_no'] }}" @endif
                                            required="">
                                    </div>
                                </div>

                                <span class="text-danger">
                                    @error('customer_phone_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4 p-0">
                            <div class="form-group">
                                <label for="name" class="col-sm-6 control-label">Customer CNIC</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-id-card" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="customer_CNiC" readonly name="customer_CNiC"
                                            placeholder="Customer CNIC" maxlength="15" required=""
                                            @if (isset($recode)) value="{{ $recode['customer_CNiC'] }}" @endif>
                                    </div>
                                </div>

                                <span class="text-danger">
                                    @error('customer_phone_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        @if (isset($recode))
                            @foreach ($recodes as $key => $item)
                                <div class="col-12" data-repeater-list="data">
                                    <div data-repeater-item>
                                        <div class="form-group row ">
                                            <div class="col-lg-3 p-2">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-6 control-label">Product
                                                        Name</label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                            <select class="form-control"
                                                                name="data[{{ $key }}][product_id]"
                                                                id="product_id" placeholder="{{ __('Product') }}"
                                                                required="">
                                                                <option value="">Please Select Product *</option>
                                                                @foreach ($product as $single)
                                                                    <option value="{{ $single['id'] }}"
                                                                        @if (isset($recode) && $item['product_id'] == $single['id']) selected @endif>
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
                                            <div class="col-lg-2 p-2">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-12 control-label">Product Code</label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <i class="fa fa-barcode" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control" id="product_code"
                                                                name="data[{{ $key }}][product_code]"
                                                                placeholder="Product Code" maxlength="50" required=""
                                                                @if (isset($recode)) value="{{ $item['product_code'] }}" @endif>
                                                        </div>
                                                    </div>

                                                    <span class="text-danger">
                                                        @error('product_code')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-2">
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label"> Sale Price </label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <i class="fa fa-doler" aria-hidden="true">Rs</i>
                                                                </span>
                                                            </div>
                                                            <input type="number" class="form-control"
                                                                id="product_Sale_price"
                                                                name="data[{{ $key }}][product_Sale_price]"
                                                                placeholder="Sale Price" required=""
                                                                @if (isset($recode)) value="{{ $item['product_sale_price'] }}" @endif>

                                                        </div>
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('product_Sale_price')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-2">
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Sale Quantity</label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                            <input type="number" class="form-control"
                                                                id="Sale_product_quantity"
                                                                name="data[{{ $key }}][Sale_product_quantity]"
                                                                placeholder="Enter Product Quantity"
                                                                required=""@if (isset($recode)) value="{{ $item['product_quantity'] }}" @endif>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('receivedQuantity')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-2">
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Received Quantity</label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <i class="fas fa-money-bill-wave"></i>
                                                                </span>
                                                            </div>
                                                            <input type="number" class="form-control" id="receivedQuantity"
                                                                name="data[{{ $key }}][receivedQuantity]" placeholder="Received Quantity"
                                                                @if (isset($recode)) value="{{ $item['receivedQuantity'] }}" @endif>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('receivedQuantity')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            @if (!isset($recode))
                                                <div class="col-lg-1 p-0 mt-4">
                                                    <button href="javascript:;" data-repeater-delete
                                                        class="btn btn-sm btn-danger mt-3 mt-md-8" type="button">
                                                        <i class="fa fa-trash"></i>&nbsp;Delete
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12" data-repeater-list="data">
                                <div data-repeater-item>
                                    <div class="form-group row ">
                                        <div class="col-lg-3 p-2">
                                            <div class="form-group">
                                                <label for="name" class="col-sm-6 control-label">Product Name</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa fa-flag" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <select class="form-control" name="data[0][product_id]"
                                                            id="product_id" placeholder="{{ __('Product') }}"
                                                            required="">
                                                            <option value="">Please Select Product *</option>
                                                            @foreach ($product as $single)
                                                                <option value="{{ $single['id'] }}"
                                                                    @if (isset($recode) && $item['product_id'] == $single['id']) selected @endif>
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
                                        <div class="col-lg-2 p-2">
                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 control-label">Product Code</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa fa-barcode" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" id="product_code"
                                                            name="data[0][product_code]" placeholder="Product Code"
                                                            maxlength="50" required=""
                                                            @if (isset($recode)) value="{{ $item['product_code'] }}" @endif>
                                                    </div>
                                                </div>

                                                <span class="text-danger">
                                                    @error('product_code')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-2">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">Sale Price </label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa fa-doler" aria-hidden="true">Rs</i>
                                                            </span>
                                                        </div>
                                                        <input type="number" class="form-control"
                                                            id="product_Sale_price" name="data[0][product_Sale_price]"
                                                            placeholder="Sale Price" required=""
                                                            @if (isset($recode)) value="{{ $item['product_sale_price'] }}" @endif>

                                                    </div>
                                                </div>
                                                <span class="text-danger">
                                                    @error('product_Sale_price')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-2">
                                            <div class="form-group">
                                                <label class="col-sm-12 control-label">Sale Quantity</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input type="number" class="form-control"
                                                            id="Sale_product_quantity"
                                                            name="data[0][Sale_product_quantity]"
                                                            placeholder="Enter Product Quantity"
                                                            required=""@if (isset($recode)) value="{{ $item['Sale_product_quantity'] }}" @endif>
                                                    </div>
                                                </div>
                                                <span class="text-danger">
                                                    @error('Sale_product_quantity')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-2">
                                            <div class="form-group">
                                                <label class="col-sm-12 control-label">Received Quantity</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fas fa-money-bill-wave"></i>
                                                            </span>
                                                        </div>
                                                        <input type="number" class="form-control" id="receivedQuantity"
                                                            name="data[0][receivedQuantity]" placeholder="Received Quantity"
                                                            @if (isset($recode)) value="{{ $recode->receivedQuantity }}" @endif>
                                                    </div>
                                                </div>
                                                <span class="text-danger">
                                                    @error('receivedQuantity')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        @if (!isset($recode))
                                            <div class="col-lg-1 p-0 mt-4">
                                                <button href="javascript:;" data-repeater-delete
                                                    class="btn btn-sm btn-danger mt-3 mt-md-8" type="button">
                                                    <i class="fa fa-trash"></i>&nbsp;Delete
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="col-lg-6">
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
                                            required="" @if (isset($recode)) value="{{$recode->return_date_and_time}}" @endif >
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
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ url('assets/js/formrepeater.bundle.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('.repeater').repeater({

                // initEmpty: false,

                defaultValues: {
                    // 'this_id': '1',
                    // 'text-input': 'foo'
                },

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }

            });
            //ajax get data
            // $(document).on('change', '#product_id', function(e) {
            //     var id = $('#product_id').val();
            //     var c_id = $('#customer_id').val();
            //     $("#product_quantity").attr("readonly", false);
            //     $.ajax({
            //         type: "get",
            //         url: "{{ route('admin.returned_product.create') }}",
            //         data: {
            //             id: id,
            //             c_id: c_id,
            //         },
            //         dataType: 'json',
            //         success: function(res) {
            //             $('#product_code').val(res.product_code);
            //             $('#product_Sale_price').val(res.product_sale_price);
            //             $('#Sale_product_quantity').val(res.product_quantity);
            //         },
            //         error: function(xhr, ajaxOptions, thrownError) {
            //             Swal.fire('Recode notfound!');
            //         }

            //     });
            // });
            $(document).on('change', '#customer_id', function(e) {
                var id = $('#customer_id').val();
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.sale.show') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#customer_phone_no').val(res.phone_number_one);
                        $('#customer_CNiC').val(res.CNIC);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire('Recode notfound!');
                    }

                });
            });
        });
    </script>
@endsection

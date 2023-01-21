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
                        {{ __('Add New Purchase Registeration') }}
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
            <a href="{{ route('admin.purchase.index') }}" class="btn btn-primary btn-sm float-right">
                <i class="fa fa-list"></i> {{ __('Back') }}
            </a>
        </div>
        <div class="modal-content">
            <form action="{{ route('admin.purchase.store') }}" id="CompanyForm" name="CompanyForm"
                class="form-horizontal" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-info">
                    <h1 class="modal-title "><b id="CompanyModal"> Add New Purchase Registeration</b></h1>
                    @if (!isset($recorde))
                        <a href="javascript:;" id="add" data-repeater-create class="btn btn-success">
                            <i class="fa fa-plus"></i>Add
                        </a>
                    @endif
                </div>
                <div class="modal-body">

                    <input type="hidden" name="id" id="id"

                        @if (isset($recorde)) value="{{ $recorde->id }}" @endif>
                    <div class="row">
                        @if (isset($recorde))
                            @foreach ($purchaserecorde as $key => $item)
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
                                                            <select class="form-control" name="data[{{$key}}][product_id]"
                                                                id="product_id" placeholder="{{ __('Product') }}"
                                                                required="">
                                                                <option value="">Please Select Product *</option>
                                                                @foreach ($product as $single)
                                                                    <option value="{{ $single['id'] }}"
                                                                        @if (isset($recorde) && $item['product_id'] == $single['id']) selected @endif>
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
                                            <div class="col-lg-3 p-2">
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
                                                                name="data[{{$key}}][product_code]" placeholder="Product Code"
                                                                maxlength="50" required=""
                                                                @if (isset($recorde)) value="{{ $item['product_code'] }}" @endif>
                                                        </div>
                                                    </div>

                                                    <span class="text-danger">
                                                        @error('product_code')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 p-2">
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
                                                                name="data[{{$key}}][purchasing_price]" placeholder="Purchase Price" value="{{$item['purchasing_price'] }}" required="">
                                                        </div>
                                                    </div>

                                                    <span class="text-danger">
                                                        @error('data[{{$key}}][purchasing_price]')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 p-2">
                                                <div class="form-group">
                                                    <label class="col-sm-6 control-label">Sale Price</label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <i class="fa fa-doler" aria-hidden="true">Rs</i>
                                                                </span>
                                                            </div>
                                                            <input type="number" class="form-control" id="sale_price"
                                                                name="data[{{$key}}][sale_price]" placeholder="Sale Price" value="{{$item['saleing_price']}}" required="">
                                                        </div>
                                                    </div>

                                                    <span class="text-danger">
                                                        @error('data[{{$key}}][sale_price]')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 p-2">
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Product Quantity</label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                            <input type="number" class="form-control"
                                                                id="Sale_product_quantity"
                                                                name="data[{{$key}}][product_quantity]"
                                                                placeholder="Enter Product Quantity"
                                                                required=""@if (isset($recorde)) value="{{ $item['product_quantity'] }}" @endif>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('Sale_product_quantity')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 p-2">
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Expiry date</label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                            <input type="date" class="form-control"
                                                                id="expiry_date"
                                                                name="data[{{$key}}][expiry_date]"
                                                                required=""@if (isset($recorde)) value="{{ $item['expiry_date'] }}" @endif>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('expiry_date')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>

                                            @if (!isset($recorde))
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
                                                                    @if (isset($recorde) && $item['product_id'] == $single['id']) selected @endif>
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
                                        <div class="col-lg-3 p-2">
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
                                                            name="data[0][product_code]" placeholder="Product Code"
                                                            maxlength="50" required=""
                                                            @if (isset($recorde)) value="{{ $item['product_code'] }}" @endif>
                                                    </div>
                                                </div>

                                                <span class="text-danger">
                                                    @error('product_code')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-2">
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
                                                            name="data[0][purchasing_price]" placeholder="Purchase Price" required="">
                                                    </div>
                                                </div>

                                                <span class="text-danger">
                                                    @error('data[0][purchasing_price]')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-2">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">Sale Price</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa fa-doler" aria-hidden="true">Rs</i>
                                                            </span>
                                                        </div>
                                                        <input type="number" class="form-control" id="sale_price"
                                                            name="data[0][sale_price]" placeholder="Sale Price" required="">
                                                    </div>
                                                </div>

                                                <span class="text-danger">
                                                    @error('data[0][sale_price]')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-2">
                                            <div class="form-group">
                                                <label class="col-sm-12 control-label">Product Quantity</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input type="number" class="form-control"
                                                            id="Sale_product_quantity"
                                                            name="data[0][product_quantity]"
                                                            placeholder="Enter Product Quantity"
                                                            required=""@if (isset($recorde)) value="{{ $item['product_quantity'] }}" @endif>
                                                    </div>
                                                </div>
                                                <span class="text-danger">
                                                    @error('Sale_product_quantity')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-2">
                                            <div class="form-group">
                                                <label class="col-sm-12 control-label">Expiry date</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input type="date" class="form-control"
                                                            id="expiry_date"
                                                            name="data[0][expiry_date]"
                                                            required=""@if (isset($recorde)) value="{{ $item['expiry_date'] }}" @endif>
                                                    </div>
                                                </div>
                                                <span class="text-danger">
                                                    @error('expiry_date')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>

                                        @if (!isset($recorde))
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
                                            name="purchasing_expense" placeholder="Enter Purchase Expense" @if(isset($recorde)) value="{{$recorde->purchasing_expense}}" @endif
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
            // $(document).on('change', '#product_id', function(e) {
            //     var id = $('#product_id').val();
            //     $.ajax({
            //         type: "get",
            //         url: "{{ route('admin.purchase.create') }}",
            //         data: {
            //             id: id
            //         },
            //         dataType: 'json',
            //         success: function(res) {
            //             $('#product_code').val(res.product_code);
            //         }

            //     });
            // });
        });
    </script>
@endsection

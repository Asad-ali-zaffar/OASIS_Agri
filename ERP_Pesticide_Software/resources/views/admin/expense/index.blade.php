@extends('layouts.app')

@section('title')
    {{ __('Expenses Registration') }}
@endsection

@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-user-injured"></i>
                        {{ __('Expenses') }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Expenses') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Expenses Registration Table') }}</h3>

            <a onClick="add()" href="javascript:void(0)" class="btn btn-primary btn-sm float-right">
                <i class="fa fa-plus"></i> {{ __('Create') }}
            </a>

        </div>

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
                                <th >{{ __('ID#')}}</th>
                                <th>{{ __('Product name') }}</th>
                                <th>{{ __('Product Code') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Purchase Price') }}</th>
                                <th>{{ __('Purchase Expense') }}</th>
                                <th>{{ __('Sale Expense') }}</th>
                                <th>{{ __('Packing Expense') }}</th>
                                <th>{{ __('Total Expense') }}</th>
                                <th width="240px">{{ __('Action') }}</th>
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
                                    @error('product_id')
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
                                <label for="name" class="col-sm-6 control-label">Product Quantity</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-doler"><b>Q</b></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="product_quantity" name="product_quantity"
                                            placeholder="Product Quantity" maxlength="50" required="" readonly>
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
                                <label class="col-sm-6 control-label">Purchase Price</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-doler" aria-hidden="true">Rs</i>
                                            </span>
                                        </div>
                                        <input type="number" class="form-control" id="purchase_price"
                                            name="purchase_price" placeholder="Purchase Price" required="" readonly>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('purchase_price')
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
                                        <input type="text" class="form-control sum" id="purchase_expense"
                                            name="purchase_expense" placeholder="Purchase Expense" required="" readonly
                                            maxlength="13">
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('purchase_expense')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-sm-6 control-label">Sale Expense</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-doler" aria-hidden="true">Rs</i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control sum" id="sale_expense"
                                            name="sale_expense" placeholder="Sale Expense" maxlength="13" required="">
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('sale_expense')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-sm-6 control-label">Packing Expense</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-doler" aria-hidden="true">Rs</i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control sum" id="packing_expense" name="packing_expense"
                                            placeholder="Packing Expense" maxlength="50" required="">
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('packing_expense')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-sm-6 control-label">Total Expense</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-dollar" aria-hidden="true">Rs</i>
                                            </span>
                                        </div>
                                        <input type="number" class="form-control" id="total_expense"
                                            name="total_expense" placeholder="Total Expense RS" required="" readonly>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('total_expense')
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
<!-- end bootstrap model -->
@endsection
@section('scripts')
    {{-- <script src="{{ url('js/admin/product_method_entry.js') }}"></script> --}}
    <script type="text/javascript">
        $(document).ready(function() {

            //active
            $('#expenses').addClass('active');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('keyup', '.sum', function(e) {
                var sale_expense = $('#sale_expense').val();
                var packing_expense = $('#packing_expense').val();
                var packing_expense = $('#packing_expense').val();
                var purchase_expense = $('#purchase_expense').val();
                var sum=0;
                sum=parseInt(sale_expense)+parseInt(packing_expense)+parseInt(purchase_expense);
                $('#total_expense').val(sum);
            });
            $(document).on('change', '#product_id', function(e) {
                var id = $('#product_id').val();
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.expenses.create') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#product_code').val(res.product_code);
                        $('#purchase_price').val(res.purchasing_price);
                        $('#purchase_expense').val(res.purchasing_expense);
                        $('#product_quantity').val(res.product_quantity);
                    }

                });
            });
            $('#ajax-crud-datatable').DataTable({
                dom: "<'row '<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4 'f>>" +
                    "<'row'<'col-sm-12 'tr>>" +
                    "<'row'<'col-sm-4 'i><'col-sm-8'p>>",
                buttons: [

                    {
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i> ' + trans("Copy"),
                        titleAttr: 'Copy',
                        className: 'bg-light',
                        exportOptions: {
                            columns: [0, 1, 2,3,4,5,6,7,8],
                            alignment: 'center',
                        },

                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> ' + trans("Excel"),
                        titleAttr: 'Excel',
                        className: 'bg-light',
                        exportOptions: {
                            columns: [0, 1, 2,3,4,5,6,7,8],
                            alignment: 'center',
                        },
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i> ' + trans("CVS"),
                        titleAttr: 'CSV',
                        className: 'bg-light',
                        exportOptions: {
                            columns: [0, 1, 2,3,4,5,6,7,8],
                            alignment: 'center',
                        },
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> ' + trans("PDF"),
                        titleAttr: 'PDF',
                        className: 'bg-light',
                        exportOptions: {
                            columns: [0, 1, 2,3,4,5,6,7,8],
                            alignment: 'center',
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> ' + trans("Print"),
                        titleAttr: 'Print',
                        className: 'bg-light',
                        exportOptions: {
                            columns: [0, 1, 2,3,4,5,6,7,8],
                            alignment: 'center',
                        },
                            // autoPrint: true,
                            orientation: 'landscape',
                            pageSize: 'A4',
                    },

                    // {
                    //     extend: 'colvis',
                    //     text: '<i class="fas fa-eye"></i> Manage Columns',
                    //     titleAttr: 'Manage',
                    //     className: 'bg-dark'
                    // }

                ],
                "processing": true,
                "serverSide": true,
                // "bSort" : false,
                fixedHeader: true,
                ajax:  "{{ route('admin.expenses.index') }}" ,
                columns: [{
                        data: 'expense_id',
                        name: 'expense_id'
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
                        data: 'product_quantity',
                        name: 'product_quantity'
                    },
                    {
                        data: 'purchase_price',
                        name: 'purchase_price'
                    },
                    {
                        data: 'purchase_expense',
                        name: 'purchase_expense'
                    },
                    {
                        data: 'sale_expense',
                        name: 'sale_expense'
                    },
                    {
                        data: 'packing_expense',
                        name: 'packing_expense'
                    },
                    {
                        data: 'total_expense',
                        name: 'total_expense'
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
            $('#CompanyModal').html("Add New Expense Registeration");
            $('#company-modal').modal('show');
            $('#id').val('');
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.expenses.edit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#CompanyModal').html("Edit Expense Registeration");
                    $('#company-modal').modal('show');
                    $('#id').val(res.id);
                    $('#product_id').val(res.product_id);
                    $('#product_code').val(res.product_code);
                    $('#product_quantity').val(res.product_quantity);
                    $('#purchase_price').val(res.purchase_price);
                    $('#packing_expense').val(res.packing_expense);
                    $('#sale_expense').val(res.sale_expense);
                    $('#purchase_expense').val(res.purchase_expense);
                    $('#total_expense').val(res.total_expense);
                }

            });
        }

        function deleteFunc(id) {
            if (confirm("Delete Record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.expenses.delete') }}",
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
                url: "{{ route('admin.expenses.store') }}",
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
                    required: true
                },
                product_code: {
                    required: true,
                    number: true
                },
                product_quantity: {
                    required: true,
                    number: true
                },
                purchase_price: {
                    required: true,
                    number: true
                },
                packing_expense: {
                    required: true,
                    number: true
                },
                sale_expense: {
                    required: true,
                    number: true
                },
                purchase_expense: {
                    required: true,
                    number: true
                },
                total_expense: {
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



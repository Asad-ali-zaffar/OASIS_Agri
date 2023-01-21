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
            {{--  href="" --}}
            <a href="{{ route('admin.purchase.create') }}" class="btn btn-primary btn-sm float-right">
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
                                <th></th>
                                <th>ID#</th>
                                <th>{{ __('Purchase Expense') }}</th>
                                <th>{{__('Amount')}}</th>
                                <th >{{ __('Action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
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
                var table;
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

            table= $('#ajax-crud-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: " {{ route('admin.purchase.index') }}",
                columns: [
                    {
                        // data: 'sale_id',
                        "className": 'dt-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                    {
                        data: 'id',
                        name: 'id'
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
                    //     data: 'purchasing_price',
                    //     name: 'purchasing_price'
                    // },
                    // {
                    //     data: 'saleing_price',
                    //     name: 'saleing_price'
                    // },
                    // {
                    //     data: 'expiry_date',
                    //     name: 'expiry_date'
                    // },
                    {
                        data: 'purchasing_expense',
                        name: 'purchasing_expense'
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount'
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
            // console.log(d);
            var recordes = JSON.parse(d.purchaseProducts);
            // return recordes;
            var html = "<table border='1|1' width='100%'>";
            recordes.forEach((recorde) => {
                html += "<tr>";
                html += "<td>Product name:</td>";
                html += "<td>" + recorde.product_name + "</td>";
                html += "<td>Product Code:</td>";
                html += "<td>" + recorde.product_code + "</td>";
                html += "<td>Purchase Price:</td>";
                html += "<td>" + recorde.purchasing_price + "</td>";
                html += "</tr>";
                html += "<tr>";
                html += "<td>Sale Price:</td>";
                html += "<td>" + recorde.saleing_price + "</td>";
                html += "<td>Quantity:</td>";
                html += "<td>" + recorde.product_quantity+ "</td>";
                html += "<td>Expiry Date:</td>";
                html += "<td>" + recorde.expiry_date+ "</td>";
                html += "</tr>";
                html += "<tr>";
                html += "</tr>";
            });
            html += "</table>";
            return html;
           }
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
                    $('#Saleing_price').val(res.Saleing_price);
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

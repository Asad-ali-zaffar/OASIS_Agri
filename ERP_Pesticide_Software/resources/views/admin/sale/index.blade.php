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
            <a  href="{{route('admin.sale.create_sale')}}" class="btn btn-primary btn-sm float-right">
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
                                <th>{{ __('Policy Name') }}</th>
                                <th>{{ __('Delivery Charges') }}</th>
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
@endsection
@section('scripts')
    {{-- <script src="{{ url('js/admin/product_method_entry.js') }}"></script> --}}
    <script type="text/javascript">
        $(document).ready(function() {
            // getBuyPolicy
            //active
            $('#sale').addClass('active');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('change', '#product_id', function(e) {
                var id = $('#product_id').val();
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.sale.create') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#product_code').val(res.product_code);
                        $('#product_sale_price').val(res.saleing_price);
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
                        alert(xhr.status +' '+thrownError);
                    }

                });
            });
            $(document).on('change', '#policy_id', function(e) {
                var customer_id = $('#customer_id').val();
                var policy_id = $('#policy_id').val();
                var table;
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.sale.getBuyPolicy') }}",
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

            table=  $('#ajax-crud-datatable').DataTable({
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
                ajax: " {{ route('admin.sale.index') }}",
                columns: [{
                        // data: 'sale_id',
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
                    {
                        data: 'policy_name',
                        name: 'policy_name'
                    },
                    {
                        data: 'delivery_charges',
                        name: 'delivery_charges'
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
            var recordes = JSON.parse(d.sales_product);
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
                html += "<td>Amount:</td>";
                html += "<td>" + recorde.product_bill + "</td>";
                html += "<td></td>";
                html += "<td></td>";
                html += "</tr>";
            });
            html += "</table>";
            return html;
           }


        function add() {
            $('#CompanyForm').trigger("reset");
            $('#CompanyModal').html("Add New Purchasing Registeration");
            $('#company-modal').modal('show');
            $('#id').val('');
        }
        function deleteFunc(id) {
            if (confirm("Delete Record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.sale.delete') }}",
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
    </script>
@endsection

@extends('layouts.app')

@section('title')
    {{ __('Salary & Pays') }}
@endsection

@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-user-injured"></i>
                        {{ __('Salary & Pays') }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Salary') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Employees Salary & Pays Table') }}</h3>
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

                    <table class=" table-bordered" id="ajax-crud-datatable">
                        <thead>
                            <tr>
                                <th>{{ __('ID #') }}</th>
                                <th>{{ __('Employe Name') }}</th>
                                <th>{{ __('Father Name') }}</th>
                                <th>{{ __('CNIC #') }}</th>
                                <th>{{ __('Designation') }}</th>
                                <th>{{ __('Monthly Expence') }}</th>
                                <th>{{ __('Monthly Salary') }}</th>
                                <th>{{ __('Total Amount') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
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
                                    <label for="name" class="col-sm-6 control-label">Employee Name</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <select class="form-control" name="employee_id"
                                                placeholder="{{ __('Employee') }}" id="employee_id" required="">
                                                <option value="">Please Select Employee *</option>
                                                @foreach ($data['employee'] as $single)
                                                    <option value="{{ $single['id'] }}"
                                                        @if (isset($patient) && $patient['employe_id'] == $single['id']) selected @endif>
                                                        {{ $single['employe_name'] }}</option>
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
                                    <label for="name" class="col-sm-6 control-label">Father Name</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="so_of" name="so_of"
                                                placeholder="Enter Father Name" maxlength="50" required="" readonly>
                                        </div>
                                    </div>

                                    <span class="text-danger">
                                        @error('so_of')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">CNIC #</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-id-card" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="CNIC" name="CNIC"
                                                placeholder="CNIC Number" required="" maxlength="15" readonly>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('CNIC')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Designation</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="designation"
                                                name="designation" placeholder="Designation" required="" readonly>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('advance_payment')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Monthly Salary</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-dollar" aria-hidden="true">Rs</i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="monthly_salary"
                                                name="monthly_salary" placeholder="Monthly Salary RS" required=""
                                                readonly>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('monthly_salary')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Monthly Expence</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-doler" aria-hidden="true">Rs</i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="total_monthly_expence"
                                                name="total_monthly_expence" placeholder="Monthly Expence "
                                                required="">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('total_monthly_expence')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Total Amount</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-doler" aria-hidden="true">Rs</i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="total_amount"
                                                name="total_amount" placeholder="Rs" maxlength="50" readonly>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('total_amount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Status</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-app-indicator"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z">
                                                        </path>
                                                        <path d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            <select class="form-control" name="status"
                                                placeholder="{{ __('Status') }}" id="status" required>
                                                {{-- <option value="0">Un-Paid</option> --}}
                                                <option value="1">Paid</option>
                                                <option value="2">Panding</option>
                                            </select>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('status')
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
            $('#salary_pays').addClass('active');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('keyup', '#total_monthly_expence', function(e) {
                var monthly_salary = $('#monthly_salary').val();
                var total_monthly_expence = $('#total_monthly_expence').val();
                var sum = 0;
                sum = parseInt(monthly_salary) + parseInt(total_monthly_expence);
                $('#total_amount').val(sum);
            });
            $(document).on('change', '#employee_id', function(e) {
                var id = $('#employee_id').val();
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.salary_pays.create') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#so_of').val(res.father_name);
                        $('#CNIC').val(res.CNIC);
                        $('#designation').val(res.designation);
                        $('#monthly_salary').val(res.monthly_salary);
                    }

                });
            });
            $('#ajax-crud-datatable').DataTable({
                dom: "<'row '<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4 'f>>" +
                    "<'row'<'col-sm-12 'tr>>" +
                    "<'row'<'col-sm-4 'i><'col-sm-8'p>>",
                buttons: [

                    // {
                    //     extend: 'copyHtml5',
                    //     text: '<i class="fas fa-copy"></i> ' + trans("Copy"),
                    //     titleAttr: 'Copy',
                    //     className: 'bg-dark'

                    // },
                    // {
                    //     extend: 'excelHtml5',
                    //     text: '<i class="fas fa-file-excel"></i> ' + trans("Excel"),
                    //     titleAttr: 'Excel',
                    //     className: 'bg-dark'
                    // },
                    // {
                    //     extend: 'csvHtml5',
                    //     text: '<i class="fas fa-file-csv"></i> ' + trans("CVS"),
                    //     titleAttr: 'CSV',
                    //     className: 'bg-dark'
                    // },
                    // {
                    //     extend: 'pdfHtml5',
                    //     text: '<i class="fas fa-file-pdf"></i> ' + trans("PDF"),
                    //     titleAttr: 'PDF',
                    //     className: 'bg-dark',
                    //     customize: function(doc) {
                    //         $(doc.document.body)
                    //             .css('font-size', '10pt')
                    //             .prepend(
                    //                 '<p class="text-center  mb-0 text-uppercase"><b>OASIS AGRI</b></p><p class="text-center  mb-0">INDUSTRIAL AREA BLOCK "E" R.Y.K</p><p class="text-center  mb-0">SORAKHI, TEHSIL DADYAL, DISTRICT MIRPUR</p><p class="text-center  mb-0">0345-6433332 , 0303-6136037</p><p class="text-center  font-weight-bold mb-0 text-uppercase text-decoration-underline"><u> Customer Ledger Invoice</u></p>'
                    //             );
                    //         $(doc.document.body).find('table')
                    //             .addClass('compact')
                    //             .css('font-size', 'inherit');

                    //     }
                    // },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-file-pdf"></i> ' + trans("Print"),
                        titleAttr: 'PDF',
                        className: 'bg-dark',
                        customize: function(win) {
                            $(win.document.body)
                                .css('font-size', '10pt')
                                .prepend(
                                    '<p class="text-center  mb-0 text-uppercase"><b>OASIS AGRI</b></p><p class="text-center  mb-0">INDUSTRIAL AREA BLOCK "E" R.Y.K</p><p class="text-center  mb-0">SORAKHI, TEHSIL DADYAL, DISTRICT MIRPUR</p><p class="text-center  mb-0">0345-6433332 , 0303-6136037</p><p class="text-center  font-weight-bold mb-0 text-uppercase text-decoration-underline"><u> Customer Ledger Invoice</u></p>'
                                )
                                .prepend(
                                    '<footer style="position: fixed; bottom: 0; width:100%"><div class="row" style="bottom: 0px fix"><div class="col-3 text-center" style="margin-left: 4vh;"><hr>Prepared By</div><div class="col-3 text-center" style=" margin-left: 4vh;"><hr> Approved By</div><div class="col-3 text-center" style="margin-left: 4vh;"><hr> Dealers Signature & Stamp</div></div> </footer>'
                                );
                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    },

                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-eye"></i> Manage Columns',
                        titleAttr: 'Manage',
                        className: 'bg-dark',
                    }
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.salary_pays.index') }}",
                columns: [{
                        data: 'pay_id',
                        name: 'pay_id'
                    },
                    {
                        data: 'employee_name',
                        name: 'employee_name'
                    },

                    {
                        data: 'so_of',
                        name: 'so_of'
                    },
                    {
                        data: 'CNIC',
                        name: 'CNIC'
                    },
                    {
                        data: 'designation',
                        name: 'designation'
                    },
                    {
                        data: 'total_monthly_expence',
                        name: 'total_monthly_expence'
                    },
                    {
                        data: 'monthly_salary',
                        name: 'monthly_salary'
                    },

                    {
                        data: 'total_amount',
                        name: 'total_amount'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'status',
                        name: 'status'
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
            $('#CompanyModal').html("Add New Employee Salary & Pays");
            $('#company-modal').modal('show');
            $('#id').val('');
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.salary_pays.edit') }}",
                data: {
                    id: id
                },

                dataType: 'json',
                success: function(res) {
                    $('#CompanyModal').html("Edit Employee Salary & Pays");
                    $('#company-modal').modal('show');
                    $('#id').val(res.id);
                    $('#employee_id').val(res.employee_id);
                    $('#so_of').val(res.so_of);
                    $('#CNIC').val(res.CNIC);
                    $('#designation').val(res.designation);
                    $('#total_monthly_expence').val(res.total_monthly_expence);
                    $('#monthly_salary').val(res.monthly_salary);
                    $('#total_amount').val(res.total_amount);
                    $('#status').val(res.status);
                }

            });
        }

        function deleteFunc(id) {
            if (confirm("Delete Record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.salary_pays.delete') }}",
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
                url: "{{ route('admin.salary_pays.store') }}",
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
                employee_id: {
                    required: true,
                    number: true
                },
                so_of: {
                    required: false

                },
                CNIC: {
                    required: false,
                    number: true
                },
                total_monthly_expence: {
                    required: true,
                    number: true
                },
                monthly_salary: {
                    required: false,
                    number: true
                },
                dasignation: {
                    required: false,
                },
                total_amount: {
                    required: false,
                    number: true,
                },
                status: {
                    required: false,
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

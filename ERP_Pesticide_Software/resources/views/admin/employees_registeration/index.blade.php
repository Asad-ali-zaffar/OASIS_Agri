@extends('layouts.app')

@section('title')
    {{ __('Employees Registration') }}
@endsection

@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-user-injured"></i>
                        {{ __('Employees') }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Employees') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Employees Registration Table') }}</h3>
            {{-- @can('create_patient') --}}
            <a onClick="add()" href="javascript:void(0)" class="btn btn-primary btn-sm float-right">
                <i class="fa fa-plus"></i> {{ __('Create') }}
            </a>
            {{-- @endcan --}}
        </div>
        <!-- /.card-header -->
        {{-- <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Laravel 8 Ajax CRUD DataTables Tutorial</h2>
                    </div>
                    <div class="pull-right mb-2">
                        <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Company</a>
                    </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="card-body">
                <table class="table table-bordered" id="ajax-crud-datatable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div> --}}
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
                                <th >{{ __('ID#')}}</th>
                                <th>{{ __('Employe name') }}</th>
                                <th>{{ __('Father name') }}</th>
                                <th>{{ __('CNIC #') }}</th>
                                <th>{{ __('Phone Number1') }}</th>
                                <th>{{ __('Phone Number2') }}</th>
                                <th>{{ __('Address') }}</th>
                                <th>{{ __('Territory') }}</th>
                                <th>{{ __('Designation') }}</th>
                                <th>{{ __('Monthly Exprince') }}</th>
                                <th>{{ __('Monthly Salary') }}</th>
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
                                    <label for="name" class="col-sm-6 control-label">Employe Name</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="employe_name" name="employe_name"
                                                placeholder="Enter Employe  Name" maxlength="50" required="">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('employe_name')
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
                                            <input type="text" class="form-control" id="father_name" name="father_name"
                                                placeholder="Enter employe Father Name" maxlength="50" required="">
                                        </div>
                                    </div>

                                    <span class="text-danger">
                                        @error('father_name')
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
                                                placeholder="CNIC Number" required="" maxlength="15">
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
                                    <label class="col-sm-6 control-label">Phone Number 1</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="phone_number_one"
                                                name="phone_number_one" placeholder="Phone Number" required=""
                                                maxlength="13">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('phone_number_one')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Phone Number 2</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="phone_number_two"
                                                name="phone_number_two" placeholder="Phone Number" maxlength="13">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('phone_number_two')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Address</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-address-book" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Enter your home Address" maxlength="50">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('adress')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Territory</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fas fa-pen" aria-hidden="true"></i>
                                                </span>

                                            </div>
                                            <input type="text" class="form-control" id="territory" name="territory"
                                                placeholder="Enter your Territory" maxlength="50">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('territory')
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
                                                name="designation" placeholder="Designation" required="">
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
                                    <label class="col-sm-6 control-label">Monthly Exprince</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="monthly_exprince"
                                                name="monthly_exprince" placeholder="Monthly Exprince "
                                                required="">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('monthly_exprince')
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
                                                name="monthly_salary" placeholder="Monthly Salary RS" required="">
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
                                                <option value="0">In Active</option>
                                                <option value="1">Active</option>
                                                <option value="2">Suspend</option>
                                                <option value="3">Close</option>
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
            $('#employees_registeration').addClass('active');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#ajax-crud-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax:  "{{ route('admin.employees.index') }}" ,
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'employe_name',
                        name: 'employe_name'
                    },

                    {
                        data: 'father_name',
                        name: 'father_name'
                    },
                    {
                        data: 'CNIC',
                        name: 'CNIC'
                    },
                    {
                        data: 'phone_number_one',
                        name: 'phone_number_one'
                    },
                    {
                        data: 'phone_number_two',
                        name: 'phone_number_two'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'territory',
                        name: 'territory'
                    },
                    {
                        data: 'designation',
                        name: 'designation'
                    },
                    {
                        data: 'monthly_exprince',
                        name: 'monthly_exprince'
                    },
                    {
                        data: 'monthly_salary',
                        name: 'monthly_salary'
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
            $('#CompanyModal').html("Add New Employe Registeration");
            $('#company-modal').modal('show');
            $('#id').val('');
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.employees.edit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#CompanyModal').html("Edit Employe Registeration");
                    $('#company-modal').modal('show');
                    $('#id').val(res.id);
                    $('#employe_name').val(res.employe_name);
                    $('#father_name').val(res.father_name);
                    $('#CNIC').val(res.CNIC);
                    $('#phone_number_one').val(res.phone_number_one);
                    $('#phone_number_two').val(res.phone_number_two);
                    $('#address').val(res.address);
                    $('#territory').val(res.territory);
                    $('#designation').val(res.designation);
                    $('#monthly_exprince').val(res.monthly_exprince);
                    $('#monthly_salary').val(res.monthly_salary);
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
                    url: "{{ route('admin.employees.delete') }}",
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
                url: "{{ route('admin.employees.store') }}",
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
                employe_name: {
                    required: true
                },
                father_name: {
                    required: true

                },
                CNIC: {
                    required: true,
                    number: true
                },
                phone_number_one: {
                    required: true,
                    number: true
                },
                phone_number_two: {
                    required: false,
                    number: true
                },
                address: {
                    required: false
                },
                territory: {
                    required: true
                },
                monthly_exprince: {
                    required: true,
                    number: true
                },
                monthly_salary: {
                    required: true,
                    number: true
                },
                dasignation: {
                    required: true,
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

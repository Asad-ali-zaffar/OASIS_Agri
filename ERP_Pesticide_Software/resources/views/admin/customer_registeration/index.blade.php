@extends('layouts.app')

@section('title')
    {{ __('Customer Registeration') }}
@endsection

@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-user-injured"></i>
                        {{ __('Customers') }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Customer') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Customers Table') }}</h3>
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
                                <th width="20px">ID#</th>
                                <th>{{ __('Customer Name') }}</th>
                                <th>{{ __('Father Name') }}</th>
                                <th>{{ __('CNIC #') }}</th>
                                <th>{{ __('Phone Number1') }}</th>
                                <th>{{ __('Phone Number2') }}</th>
                                <th>{{ __('Address') }}</th>
                                <th>{{ __('Advance Payment') }}</th>
                                {{-- <th>{{ __('Panding Bill Payment') }}</th> --}}
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
                <div class="modal-header bg-info">
                    <h1 class="modal-title "><b id="CompanyModal"></b></h1>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="CompanyForm" name="CompanyForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-6 control-label">Customer Name</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="customer_name"
                                                name="customer_name" placeholder="Enter Customer  Name" maxlength="50"
                                                required="">
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
                                    <label for="name" class="col-sm-6 control-label">Father Name</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="father_name" name="father_name"
                                                placeholder="Enter Customer Father Name" maxlength="50" required="">
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
                                                placeholder="CNIC Number" required="">
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
                                                name="phone_number_one" placeholder="Phone Number" required="">
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
                                                name="phone_number_two" placeholder="Phone Number" >
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
                                            <input type="text" class="form-control" id="adress" name="adress"
                                                placeholder="Enter your home Address" required="">
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
                                    <label class="col-sm-6 control-label">Advance Payment</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-dollar" aria-hidden="true">Rs</i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="advance_payment"
                                                name="advance_payment" placeholder="Advance Payment RS" >
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('advance_payment')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Panding Bill Payment</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-dollar" aria-hidden="true">Rs</i>
                                                </span>
                                            </div>
                                        <input type="number" class="form-control" id="panding_bill" name="panding_bill"
                                            placeholder="Panding Bill Payment RS" >
                                    </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('panding_bill')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            &nbsp;&nbsp;&nbsp;&nbsp; <button type="submit" class="btn btn-outline-primary"
                                id="btn-save">
                                <i class="fa fa-check" aria-hidden="true"></i> Save changes
                            </button>

                            <button type="reset" class="btn btn-outline-warning card-title">
                                <i class="fa fa-undo" aria-hidden="true"></i>
                                Cancel</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
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
            $('#customer_registeration').addClass('active');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#ajax-crud-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: " {{ route('admin.customer.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'customer_name',
                        name: 'customer_name'
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
                        data: 'adress',
                        name: 'adress'
                    },
                    {
                        data: 'advance_payment',
                        name: 'advance_payment'
                    },
                    // {
                    //     data: 'panding_bill',
                    //     name: 'panding_bill'
                    // },

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
            $('#CompanyModal').html("Add New Customer Registeration");
            $('#company-modal').modal('show');
            $('#id').val('');
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.customer.edit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#CompanyModal').html("Edit Customer Registeration");
                    $('#company-modal').modal('show');
                    $('#id').val(res.id);
                    $('#customer_name').val(res.customer_name);
                    $('#father_name').val(res.father_name);
                    $('#CNIC').val(res.CNIC);
                    $('#phone_number_one').val(res.phone_number_one);
                    $('#phone_number_two').val(res.phone_number_two);
                    $('#adress').val(res.adress);
                    $('#advance_payment').val(res.advance_payment);
                    // $('#panding_bill').val(res.panding_bill);
                }

            });
        }

        function deleteFunc(id) {
            if (confirm("Delete Record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.customer.delete') }}",
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
                url: "{{ route('admin.customer.store') }}",
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
                customer_name: {
                    required: true
                },
                father_name: {
                    required: true

                },
                CNIC: {
                    required: true,
                    number: false
                },
                phone_number_one: {
                    required: true,
                    number: false
                },
                phone_number_two: {
                    required: false,
                    number: false
                },
                adress: {
                    required: true
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

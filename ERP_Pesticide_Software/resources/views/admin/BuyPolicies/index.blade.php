@extends('layouts.app')

@section('title')
    {{ __('Buy Policy Registeration') }}
@endsection

@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-user-injured"></i>
                        {{ __('Buy Policy Registeration') }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Buy Policy') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Buy Policy Registeration Table') }}</h3>
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
                                <th>{{ __('Client Name') }}</th>
                                <th>{{ __('Address') }}</th>
                                <th>{{ __('Number') }}</th>
                                <th>{{ __('Policy Name') }}</th>
                                <th>{{ __('Policy Code') }}</th>
                                <th>{{ __('Start Tenure Data') }}</th>
                                <th>{{ __('End Tenure Data') }}</th>
                                <th>{{ __('Policy Discount') }}</th>
                                <th>{{ __('Post Sale Incentive') }}</th>
                                <th>{{ __('Cash Incentive') }}</th>
                                <th>{{ __('Cash Deposited in Policy') }}</th>
                                <th>{{ __('Remaining Amount') }}</th>
                                <th>{{ __('Credit Note NC') }}</th>
                                <th>{{ __('Policy Status') }}</th>
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
                        {{-- ['client_name','address','number','policy_id','policy_code','policy_duration','policy_discount','policy_incentives','policy_incentives_status','cash_deposited','remaining_amount','credit_note_NC']; --}}

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-6 control-label">Client Name</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <select class="form-control" name="customer_id"
                                                placeholder="{{ __('Customer') }}" id="customer_id" required="">
                                                <option value="">Please Select Client *</option>
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
                                    <label for="name" class="col-sm-6 control-label">Address</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-id-card" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Customer address" maxlength="15" required="" readonly>
                                        </div>
                                    </div>

                                    <span class="text-danger">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-6 control-label">Policy Name</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fas fa-procedures"></i>
                                                </span>
                                            </div>
                                            <select class="form-control" name="policy_id"
                                                placeholder="{{ __('Police') }}" id="policy_id" required="">
                                                <option value="">Please Select Client *</option>
                                                @foreach ($data['policies'] as $single)
                                                    <option value="{{ $single['id'] }}"
                                                        @if (isset($patient) && $patient['policy_id'] == $single['id']) selected @endif>
                                                        {{ $single['policy_name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('policy_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="policy_code" class="col-sm-6 control-label">Policy Code</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-barcode" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="policy_code" name="policy_code"
                                                placeholder="Enter policy code" maxlength="50" required="" readonly>
                                        </div>
                                    </div>

                                    <span class="text-danger">
                                        @error('policy_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Start Tenure Data</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="date" class="form-control" id="start_tenure_data" name="start_tenure_data"
                                                placeholder="" required="" readonly>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('start_tenure_data')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">End Tenure Data</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="date" class="form-control" id="end_tenure_data" name="end_tenure_data"
                                                placeholder="" required="" readonly>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('end_tenure_data')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Discount</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-do" aria-hidden="true">%</i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="discount"
                                                name="discount" placeholder="Enter Discount" >
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('discount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-8 control-label">Post sales incentive (PSI) </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fas fa-poo-storm"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control sum" id="post_sale_incentive"
                                                name="post_sale_incentive" placeholder="Post Sale Incentive" value="0">
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('post_sale_incentive')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Cash Incentive (CI)</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fas fa-poo-storm"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control sum" id="cash_incentive"
                                                name="cash_incentive" placeholder="Cash Incentive" value="0" >
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('cash_incentive')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-8 control-label">Cash Deposited in Policy</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fas fa-money-bill-wave" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="cash_deposited"
                                                name="cash_deposited" placeholder="Cash Deposited in Policy" >
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('cash_deposited')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Remaining Amount</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fas fa-money-bill-wave" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="remaining_amount"
                                                name="remaining_amount" placeholder="Remaining Amount" >
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('remaining_amount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Credit Note (CN)</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fas fa-poo-storm" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="credit_note"
                                                name="credit_note" placeholder="Credit Note (CN)" readonly >
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('credit_note')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
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
            $('#buy_policies').addClass('active');
            $(document).on('change', '#customer_id', function(e) {
                var id = $('#customer_id').val();
                $("#product_quantity").attr("readonly", false);
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.Sale.show') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#customer_phone_no').val(res.phone_number_one);
                        $('#address').val(res.adress);
                    }

                });
            });
            $(document).on('change', '#policy_id', function(e) {
                var id = $('#policy_id').val();
                $("#product_quantity").attr("readonly", false);
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.buy_policies.create') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#policy_code').val(res.policy_code);
                        $('#start_tenure_data').val(res.start_tenure_data);
                        $('#end_tenure_data').val(res.end_tenure_data);
                    }

                });
            });
            $(document).on('keyup', '.sum', function(e) {
                var cash_deposited= $('#post_sale_incentive').val();
                var cash_incentive= $('#cash_incentive').val();
                $('#credit_note').val(parseInt(cash_deposited) + parseInt(cash_incentive));
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#ajax-crud-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: " {{ route('admin.buy_policies.index') }}",
                columns: [
                    {
                        data: 'buy_policy_id',
                        name: 'buy_policy_id'
                    },
                    {
                        data: 'customer_name',
                        name: 'customer_name'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'customer_phone_no',
                        name: 'customer_phone_no'
                    },
                    {
                        data: 'policy_name',
                        name: 'policy_name'
                    },
                    {
                        data: 'policy_code',
                        name: 'policy_code'
                    },
                    {
                        data: 'start_tenure_data',
                        name: 'start_tenure_data'
                    },
                    {
                        data: 'end_tenure_data',
                        name: 'end_tenure_data'
                    },
                    {
                        data: 'buy_policy_discount',
                        name: 'buy_policy_discount'
                    },
                    {
                        data: 'post_sale_incentive',
                        name: 'post_sale_incentive'
                    },
                    {
                        data: 'cash_incentive',
                        name: 'cash_incentive'
                    },
                    {
                        data: 'cash_deposited',
                        name: 'cash_deposited'
                    },
                    {
                        data: 'remaining_amount',
                        name: 'remaining_amount'
                    },
                    {
                        data: 'credit_note',
                        name: 'credit_note'
                    },
                    {
                        data: 'policy_incentives_status',
                        name: 'policy_incentives_status'
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
            $('#CompanyModal').html("Buy Policy Registeration");
            $('#company-modal').modal('show');
            $('#id').val('');
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.buy_policies.edit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#CompanyModal').html("Edit Policy Registeration");
                    $('#company-modal').modal('show');
                    $('#id').val(res.id);
                    $('#customer_id').val(res.customer_id);
                    $('#customer_phone_no').val(res.customer_phone_no);
                    $('#address').val(res.address);
                    $('#policy_id').val(res.policy_id);
                    $('#policy_code').val(res.policy_code);
                    $('#start_tenure_data').val(res.start_tenure_data);
                    $('#end_tenure_data').val(res.end_tenure_data);
                    $('#discount').val(res.discount);
                    $('#post_sale_incentive').val(res.post_sale_incentive);
                    $('#cash_incentive').val(res.cash_incentive);
                    // $('#policy_incentives_status').val(res.policy_incentives_status);
                    $('#cash_deposited').val(res.cash_deposited);
                    $('#remaining_amount').val(res.remaining_amount);
                    $('#credit_note').val(res.credit_note);
                    }
            });
        }

        function deleteFunc(id) {
            if (confirm("Delete Record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.buy_policies.delete') }}",
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
                url: "{{ route('admin.buy_policies.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#company-modal").modal('hide');
                    var oTable = $('#ajax-crud-datatable').dataTable();
                    oTable.fnDraw(false);
                    $("#btn-save").html('Save changes');
                    $("#btn-save").attr("disabled", false);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
        $('#CompanyForm').validate({
            rules: {
                policy_name: {
                    required: true
                },
                policy_code: {
                    required: true

                },
                start_tenure_data: {
                    required: true,
                    number: true
                },
                end_tenure_data: {
                    required: true,
                    number: true
                },
                discount: {
                    required: false,
                    number: true
                },
                discount: {
                    required: false,
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

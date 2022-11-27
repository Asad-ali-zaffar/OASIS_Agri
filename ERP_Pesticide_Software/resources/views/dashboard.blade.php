@extends('layouts.app')
@section('title')
    {{ __('Dashboard') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ url('plugins/swtich-netliva/css/netliva_switch.css') }}">
@endsection
{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-th"></i>
                        {{ __('Dashboard') }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <!-- Admin Reports -->
    <div class="row">
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    {{-- @dd($data['Product']) --}}
                    <h3>
                        {{ count($data['Product']) }}
                    </h3>
                    <p>{{ __('Product') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-flask"></i>
                </div>
                <a href="{{ route('admin.product.index') }}" class="small-box-footer">{{ __('More info') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        {{ count($data['Seal']) }}
                    </h3>
                    <p>{{ __('Sales') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-capsules"></i>
                </div>
                <a href="{{ route('admin.Sale.index') }}" class="small-box-footer">{{ __('More info') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        {{ count($data['Purchase']) }}
                    </h3>
                    <p>{{ __('Purchase') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-contract nav-icon"></i>
                </div>
                <a href="{{ route('admin.purchase.index') }}" class="small-box-footer">{{ __('More info') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        {{ count($data['Expense']) }}
                    </h3>
                    <p>{{ __('Expense') }}</p>
                </div>
                <div class="icon">
                    {{-- <i class="fa fa-home"></i> --}}
                    <i class="fas fa-money-bill-wave-alt    "></i>
                </div>
                <a href="{{ route('admin.expenses.index') }}" class="small-box-footer">{{ __('More info') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        {{ count($data['EmployeesRegistration']) }}
                    </h3>
                    <p>{{ __('Employees') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-injured"></i>
                </div>
                <a href="{{ route('admin.employees.index') }}" class="small-box-footer">{{ __('More info') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        {{ count($data['CustomerRegisteration']) }}
                    </h3>
                    <p>{{ __('Customer') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-injured"></i>
                </div>
                <a href="{{ route('admin.customer.index') }}" class="small-box-footer">{{ __('More info') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- today statistics -->
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-olive color-palette">
                <span class="info-box-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Income amount') }}</span>
                    <span class="info-box-number">
                        {{-- @dd($data['Seal']) --}}
                        @php
                            $sale_sum=0;
                            foreach($data['Seal'] as $value){
                                $sale_sum+=$value->total_bill;
                            }
                        @endphp
                        {{$sale_sum}}.00
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-olive color-palette">
                <span class="info-box-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Expense amount') }}</span>
                    <span class="info-box-number">
                        {{-- @dd($data['Expense'] ) --}}
                        @php
                            $expense_sum=0;
                            foreach($data['Expense'] as $value){
                                $expense_sum+=$value->total_expense;
                            }
                        @endphp
                        {{$expense_sum}}.00
                        {{-- {{$today_total_expense}} {{get_currency()}} --}}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-olive color-palette">
                <span class="info-box-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Remove expence amount') }}</span>
                    <span class="info-box-number">
                        {{$sale_sum-$expense_sum}}.00
                    </span>
                </div>
            </div>
        </div>
        <!-- /today statistics -->

        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-primary">
                <span class="info-box-icon"><i class="fa fa-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Returned Product Amount') }}</span>
                    <span class="info-box-number">
                         {{-- @dd($data['ReturnedProduct']) --}}
                        @php
                        $ReturnedProduct_sum=0;
                        foreach($data['ReturnedProduct'] as $value){
                            $ReturnedProduct_sum+=$value->total_bill;
                        }
                    @endphp
                    {{$ReturnedProduct_sum}}.00
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-warning">
                <span class="info-box-icon"><i class="fa fa-pause-circle"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Remove expence amount') }}</span>
                    <span class="info-box-number">
                        {{$sale_sum-$expense_sum}}.00
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fa fa-check-double"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Remove return Amount') }}</span>
                    <span class="info-box-number">
                        {{($sale_sum-$expense_sum)-$ReturnedProduct_sum}}.00
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-primary">
                <span class="info-box-icon"><i class="fa fa-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Salary & Pay') }}</span>
                    <span class="info-box-number">
                        {{-- @dd($data['SalaryPay']) --}}
                        @php
                        $SalaryPay_sum=0;
                        foreach($data['SalaryPay'] as $value){
                            $SalaryPay_sum+=$value->total_amount;
                        }
                    @endphp
                    {{$SalaryPay_sum}}.00
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-warning">
                <span class="info-box-icon"><i class="fa fa-pause-circle"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Remove return amount') }}</span>
                    <span class="info-box-number">
                        {{($sale_sum-$expense_sum)-$ReturnedProduct_sum}}.00
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fa fa-check-double"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Profit Amount') }}</span>
                    <span class="info-box-number">
                        {{(($sale_sum-$expense_sum)-$ReturnedProduct_sum)-$SalaryPay_sum}}.00
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
    <!-- /.row -->
    <!-- /Admin Reports -->
@endsection
@section('scripts')
    <!-- Switch -->
    <script src="{{ url('public/plugins/swtich-netliva/js/netliva_switch.js') }}"></script>
    <script src="{{ url('js/admin/dashboard.js') }}"></script>
@endsection

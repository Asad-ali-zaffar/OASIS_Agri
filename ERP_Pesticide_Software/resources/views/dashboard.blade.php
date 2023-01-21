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
                        {{ count($data['Sale']) }}
                    </h3>
                    <p>{{ __('Sales') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-capsules"></i>
                </div>
                <a href="{{ route('admin.sale.index') }}" class="small-box-footer">{{ __('More info') }} <i
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
        {{-- <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        {{ count($data['Expense']) }}
                    </h3>
                    <p>{{ __('Expense') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave-alt    "></i>
                </div>
                <a href="{{ route('admin.expenses.index') }}" class="small-box-footer">{{ __('More info') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div> --}}
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
        <div class="col-md-4 col-sm-6 col-12">
            {!! $productchart->container() !!}

            <script src="{{ $productchart->cdn() }}"></script>

            {{ $productchart->script() }}
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            {!! $empchart->container() !!}

            <script src="{{ $empchart->cdn() }}"></script>

            {{ $empchart->script() }}
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            {!! $coustomerchart->container() !!}

            <script src="{{ $coustomerchart->cdn() }}"></script>

            {{ $coustomerchart->script() }}
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            {!! $salechart->container() !!}

            <script src="{{ $salechart->cdn() }}"></script>

            {{ $salechart->script() }}
        </div>
        <div class="col-md-4 col-sm-6 col-12">

            {!! $purchasechart->container() !!}

            <script src="{{ $purchasechart->cdn() }}"></script>

            {{ $purchasechart->script() }}
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

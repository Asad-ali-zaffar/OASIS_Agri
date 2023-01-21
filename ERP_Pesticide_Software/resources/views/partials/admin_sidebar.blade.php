<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">

            <a href="{{ route('admin.dashboard') }}" class="nav-link" id="dashboard">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    {{ __('Dashboard') }}
                </p>
            </a>
        </li>

        <li class="nav-item">

            <a href="{{ route('admin.profile.edit') }}" class="nav-link" id="profile">
                <i class="nav-icon fas fa-user-circle"></i>
                <p>
                    {{ __('Profile') }}
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview" id="prices">
            <a href="#" class="nav-link" id="prices_link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    {{ __('General Admin') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="
                    {{ route('admin.product.index') }}" class="nav-link" id="product">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Product Registeration') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="
                    {{ route('admin.customer.index') }}" class="nav-link"
                        id="customer_registeration">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Customer Registeration') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="
                    {{ route('admin.employees.index') }}" class="nav-link"
                        id="employees_registeration">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Employees Registration') }}</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="
                    {{ route('admin.expenses.index') }}" class="nav-link" id="expenses">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Expenses Registration') }}</p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="
                    {{ route('admin.salary_pays.index') }}" class="nav-link"
                        id="salary_pays">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Salary/Pays Registration') }}</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="
                    {{ route('admin.policies.index') }}" class="nav-link"
                        id="policies">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Policies Registration') }}</p>
                    </a>
                </li> --}}
            </ul>
        </li>
        <li class="nav-item has-treeview" id="prices">
            <a href="#" class="nav-link" id="prices_link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    {{ __('Product Management') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.purchase.index') }}" class="nav-link" id="purchase">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Purchase Product') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.sale.index') }}" class="nav-link" id="sale">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Sale Product') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.returned_product.index') }}" class="nav-link" id="returned_product">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Returned Product Registration') }}</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.buy_policies.index') }}" class="nav-link" id="buy_policies">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Buy Policies') }}</p>
                    </a>
                </li> --}}

            </ul>
        </li>
        <li class="nav-item has-treeview" id="prices">
            <a href="#" class="nav-link" id="prices_link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    {{ __('Inventery') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.product_stock.index') }}" class="nav-link" id="product_stock">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Product Stock') }}</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.consumed_sale_product.index') }}" class="nav-link" id="consumed_sale_product">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Consumed / Sale Product') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.return_products.index') }}" class="nav-link" id="Return_Products">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Returned Product') }}</p>
                    </a>
                </li> --}}
            </ul>
        </li>
        {{-- <li class="nav-item has-treeview" id="prices">
            <a href="#" class="nav-link" id="prices_link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    {{ __('Invoice') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.invoice.index') }}" class="nav-link" id="product_sale_invoice">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Product Sale Invoice') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.customer_lager_invoice.index') }}" class="nav-link" id="customer_lager_invoice">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Customer Ledger Invoice') }}</p>
                    </a>
                </li>
            </ul>
        </li> --}}
    </ul>
</nav>

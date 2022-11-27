<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    Admin\ProductController,
    Admin\CustomerRegisterationController,
    Admin\EmployeesRegistrationController,
    Admin\PurchaseController,
    Admin\SealController,
    Admin\ReturnedProductController,
    Admin\ExpenseController,
    Admin\SalaryPayController,
    Admin\ProductStockController,
    Admin\InvoiceController,
    Admin\PoliciesController,
    Admin\BuyPoliciesController
};
use App\Models\{
    EmployeesRegistration,
    CustomerRegisteration,
    Purchase,
    Seal,
    Product,
    Expense,
    ReturnedProduct,
    SalaryPay
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
    //welcome
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', function () {
        $data['EmployeesRegistration']=EmployeesRegistration::all();
        $data['CustomerRegisteration']=CustomerRegisteration::all();
        $data['Purchase']=Purchase::all();
        $data['Seal']=Seal::all();
        $data['Product']=Product::all();
        $data['Expense']=Expense::all();
        $data['ReturnedProduct']=ReturnedProduct::all();
        $data['SalaryPay']=SalaryPay::all();
        return view('dashboard',compact('data'));
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {

        //profile
        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
            Route::post('update', [ProfileController::class, 'update'])->name('update');
        });
        Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
            Route::get('index', [ProductController::class, 'index'])->name('index');
            Route::post('store-company', [ProductController::class, 'store'])->name('store');
            Route::post('edit-company', [ProductController::class, 'edit'])->name('edit');
            Route::post('delete-company', [ProductController::class, 'destroy'])->name('delete');
        });
        Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
            Route::get('index', [CustomerRegisterationController::class, 'index'])->name('index');
            Route::post('store-customer', [CustomerRegisterationController::class, 'store'])->name('store');
            Route::post('edit-customer', [CustomerRegisterationController::class, 'edit'])->name('edit');
            Route::post('delete-customer', [CustomerRegisterationController::class, 'destroy'])->name('delete');
        });
        Route::group(['prefix' => 'employees', 'as' => 'employees.'], function () {
            Route::get('index', [EmployeesRegistrationController::class, 'index'])->name('index');
            Route::post('store-employees', [EmployeesRegistrationController::class, 'store'])->name('store');
            Route::post('edit-employees', [EmployeesRegistrationController::class, 'edit'])->name('edit');
            Route::post('delete-employees', [EmployeesRegistrationController::class, 'destroy'])->name('delete');
        });
        Route::group(['prefix' => 'expenses', 'as' => 'expenses.'], function () {
            Route::get('index', [ExpenseController::class, 'index'])->name('index');
            Route::get('create', [ExpenseController::class, 'create'])->name('create');
            Route::post('store-expenses', [ExpenseController::class, 'store'])->name('store');
            Route::post('edit-expenses', [ExpenseController::class, 'edit'])->name('edit');
            Route::post('delete-expenses', [ExpenseController::class, 'destroy'])->name('delete');
        });
        Route::group(['prefix' => 'salary_pays', 'as' => 'salary_pays.'], function () {
            Route::get('index', [SalaryPayController::class, 'index'])->name('index');
            Route::get('create', [SalaryPayController::class, 'create'])->name('create');
            Route::post('store-salary_pays', [SalaryPayController::class, 'store'])->name('store');
            Route::post('edit-salary_pays', [SalaryPayController::class, 'edit'])->name('edit');
            Route::post('delete-salary_pays', [SalaryPayController::class, 'destroy'])->name('delete');
        });
        Route::group(['prefix' => 'purchase', 'as' => 'purchase.'], function () {
            Route::get('index', [PurchaseController::class, 'index'])->name('index');
            Route::get('create', [PurchaseController::class, 'create'])->name('create');
            Route::post('store-purchase', [PurchaseController::class, 'store'])->name('store');
            Route::post('edit-purchase', [PurchaseController::class, 'edit'])->name('edit');
            Route::post('delete-purchase', [PurchaseController::class, 'destroy'])->name('delete');
        });
        Route::group(['prefix' => 'Sale', 'as' => 'Sale.'], function () {
            Route::get('index', [SealController::class, 'index'])->name('index');
            Route::get('create', [SealController::class, 'create'])->name('create');
            Route::get('show', [SealController::class, 'show'])->name('show');
            Route::get('getBuyPolicy', [SealController::class, 'update'])->name('getBuyPolicy');
            Route::post('store-purchase', [SealController::class, 'store'])->name('store');
            Route::post('edit-purchase', [SealController::class, 'edit'])->name('edit');
            Route::post('delete-purchase', [SealController::class, 'destroy'])->name('delete');
        });
        Route::group(['prefix' => 'returned_product', 'as' => 'returned_product.'], function () {
            Route::get('index', [ReturnedProductController::class, 'index'])->name('index');
            Route::get('create', [ReturnedProductController::class, 'create'])->name('create');
            Route::get('show', [ReturnedProductController::class, 'show'])->name('show');
            Route::post('store-returned_product', [ReturnedProductController::class, 'store'])->name('store');
            Route::post('edit-returned_product', [ReturnedProductController::class, 'edit'])->name('edit');
            Route::post('delete-returned_product', [ReturnedProductController::class, 'destroy'])->name('delete');
        });
        Route::group(['prefix' => 'product_stock', 'as' => 'product_stock.'], function () {
            Route::get('index', [ProductStockController::class, 'index'])->name('index');
        });
        Route::group(['prefix' => 'consumed_sale_product', 'as' => 'consumed_sale_product.'], function () {
            Route::get('index', [ProductStockController::class, 'create'])->name('index');
        });
        Route::group(['prefix' => 'return_products', 'as' => 'return_products.'], function () {
            Route::get('index', [ProductStockController::class, 'store'])->name('index');
        });
        Route::group(['prefix' => 'invoice', 'as' => 'invoice.'], function () {
            Route::get('index', [InvoiceController::class, 'index'])->name('index');
        });
        Route::group(['prefix' => 'customer_lager_invoice', 'as' => 'customer_lager_invoice.'], function () {
            Route::get('index', [InvoiceController::class, 'create'])->name('index');
            Route::get('filter', [InvoiceController::class, 'store'])->name('show');
            Route::get('Pdf', [InvoiceController::class, 'show'])->name('pdf');
        });
        Route::group(['prefix' => 'policies', 'as' => 'policies.'], function () {
            Route::get('index', [PoliciesController::class, 'index'])->name('index');
            Route::post('store-policies', [PoliciesController::class, 'store'])->name('store');
            Route::post('edit-policies', [PoliciesController::class, 'edit'])->name('edit');
            Route::post('delete-policies', [PoliciesController::class, 'destroy'])->name('delete');
       });
        Route::group(['prefix' => 'buy_policies', 'as' => 'buy_policies.'], function () {
            Route::get('index', [BuyPoliciesController::class, 'index'])->name('index');
            Route::get('create', [BuyPoliciesController::class, 'create'])->name('create');
            Route::post('store-buy-policies', [BuyPoliciesController::class, 'store'])->name('store');
            Route::post('edit-buy-policies', [BuyPoliciesController::class, 'edit'])->name('edit');
            Route::post('delete-buy-policies', [BuyPoliciesController::class, 'destroy'])->name('delete');
       });
    });
});


require __DIR__ . '/auth.php';

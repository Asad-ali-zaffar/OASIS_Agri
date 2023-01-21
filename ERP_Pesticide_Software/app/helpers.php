<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\{
    CustomerRegisteration,
    Product,EmployeesRegistration,
    PurchasesProducts,
    SaleProduct,
    ReturnSaleProduct
};



//get customer
if(!function_exists('get_customer'))
{
    function get_customer($id){

       return CustomerRegisteration::findOrFail($id);
    }
}
//get customer
if(!function_exists('get_product'))
{
    function get_product($id){

       return Product::findOrFail($id);
    }
}
if(!function_exists('get_employe')){
    function get_employe($id){
        return EmployeesRegistration::findOrFail($id);
    }
}
if(!function_exists('get_countQuantity')){
    function get_countQuantity($id){
        $purchaseQut = PurchasesProducts::where('product_id',$id)->sum('product_quantity');
        $saleQut = SaleProduct::where('product_id',$id)->sum('product_quantity');
        return $purchaseQut-$saleQut;
    }
}
if(!function_exists('get_returnsalesRecordes')){
    function get_returnsalesRecordes($id,$cid){
        return ReturnSaleProduct::where(['returnSP_id'=>$id,'customer_id'=>$cid])->join('products', 'products.id','=', 'return_sale_products.product_id')->get();

    }
}
if(!function_exists('get_saleProductesRecordes')){
    function get_saleProductesRecordes($id,$cid){
        return SaleProduct::where(['sale_id'=>$id,'customer_id'=>$cid])->join('products', 'products.id','=', 'sale_products.product_id')->get();

    }
}
if(!function_exists('get_purchaseProducts')){
    function get_purchaseProducts($id){
        return PurchasesProducts::where(['purchaese_id'=>$id])->join('products', 'products.id','=', 'purchases_products.product_id')->get();

    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases_products', function (Blueprint $table) {
            $table->id('purchases_product_id');
            $table->integer('purchaese_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('product_code')->nullable();
            $table->integer('purchasing_price')->nullable();
            $table->integer('saleing_price')->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('product_quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases_products');
    }
};

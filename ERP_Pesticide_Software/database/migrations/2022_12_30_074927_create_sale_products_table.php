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
        Schema::create('sale_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sale_id');
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->string('product_code')->nullable();
            $table->bigInteger('product_sale_price')->nullable();
            $table->bigInteger('product_quantity')->nullable();
            $table->float('product_bill')->nullable();
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
        Schema::dropIfExists('sale_products');
    }
};

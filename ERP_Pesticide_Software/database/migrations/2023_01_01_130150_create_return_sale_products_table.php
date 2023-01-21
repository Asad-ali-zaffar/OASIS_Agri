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
        Schema::create('return_sale_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('returnSP_id');
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->string('product_code')->nullable();
            $table->bigInteger('product_sale_price')->nullable();
            $table->bigInteger('product_quantity')->nullable();
            $table->bigInteger('receivedQuantity')->nullable();
            $table->float('return_amount')->nullable();
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
        Schema::dropIfExists('return_sale_products');
    }
};

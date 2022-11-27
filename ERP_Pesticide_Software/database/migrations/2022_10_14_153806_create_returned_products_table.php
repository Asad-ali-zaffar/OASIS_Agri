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
        Schema::create('returned_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->bigInteger('customer_phone_no');
            $table->bigInteger('customer_CNiC');
            $table->bigInteger('product_id');
            $table->bigInteger('product_code');
            $table->bigInteger('product_seal_price');
            $table->bigInteger('delivery_charges')->nullable();
            $table->bigInteger('charges_amount')->nullable();
            $table->bigInteger('product_quantity');
            $table->dateTime('return_date_and_time');
            $table->bigInteger('total_bill')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('returned_products');
    }
};

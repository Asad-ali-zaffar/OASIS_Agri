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
        Schema::create('seals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->string('customer_phone_no');
            $table->string('customer_CNiC');
            $table->bigInteger('product_id');
            $table->string('product_code');
            $table->bigInteger('product_seal_price');
            $table->bigInteger('policy_id');
            $table->string('policy_code');
            $table->bigInteger('policy_discount');
            $table->bigInteger('credit_note');
            $table->bigInteger('delivery_charges')->nullable();
            $table->bigInteger('charges_amount')->nullable();
            $table->bigInteger('recive_amount')->nullable();
            $table->bigInteger('product_quantity');
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
        Schema::dropIfExists('seals');
    }
};

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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->string('customer_phone_no');
            $table->string('customer_CNiC');
            $table->bigInteger('delivery_charges')->nullable();
            $table->bigInteger('recive_amount')->nullable();
            $table->integer('invoice_status')->nullable()->default(0);
            $table->float('total_bill')->nullable();
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
        Schema::dropIfExists('sales');
    }
};

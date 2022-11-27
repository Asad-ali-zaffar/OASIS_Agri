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
        Schema::create('buy_policies', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('customer_phone_no');
            $table->string('address');
            $table->string('policy_id');
            $table->string('policy_code');
            $table->date('start_tenure_data');
            $table->date('end_tenure_data');
            $table->string('discount')->nullable()->default(0);
            $table->string('post_sale_incentive')->nullable()->default(0);
            $table->string('cash_incentive')->nullable()->default(0);
            $table->integer('policy_incentives_status')->nullable()->default(0);
            $table->integer('cash_deposited')->nullable()->default(0);
            $table->integer('remaining_amount')->nullable()->default(0);
            $table->string('credit_note')->nullable()->default(0);
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
        Schema::dropIfExists('buy_policies');
    }
};

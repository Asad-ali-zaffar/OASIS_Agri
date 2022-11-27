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
        Schema::create('employees_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('employe_name');
            $table->string('father_name');
            $table->bigInteger('CNIC');
            $table->bigInteger('phone_number_one');
            $table->bigInteger('phone_number_two')->nullable();
            $table->string('address')->nullable();
            $table->string('territory');
            $table->string('designation');
            $table->bigInteger('monthly_exprince')->nullable();
            $table->bigInteger('monthly_salary');
            $table->Integer('status');
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
        Schema::dropIfExists('employees_registrations');
    }
};

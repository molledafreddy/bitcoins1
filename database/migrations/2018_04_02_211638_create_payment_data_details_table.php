<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentDataDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_data_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');          
            $table->string('value');               
            $table->integer('payment_data_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('payment_data_id')->references('id')->on('payment_datas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_data_details');
    }
}

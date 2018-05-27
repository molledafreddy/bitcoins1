<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->double('total');
            $table->double('commission')->nullable();           
            $table->integer('payment_data_id')->unsigned()->nullable();
            $table->foreign('payment_data_id')->references('id')->on('payment_datas');
            $table->integer('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('transactions_payment_data_id_foreign');
            $table->dropColumn(['total', 'commission','payment_data_id','status']);
        });
    }
}

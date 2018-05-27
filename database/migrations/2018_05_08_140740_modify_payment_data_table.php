<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPaymentDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_data_details', function (Blueprint $table) {
            $table->integer('is_link')->default(0)->comment('no_link = 0, link = 1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_data_details', function (Blueprint $table) {
            $table->dropColumn('is_link');
        });
    }
}

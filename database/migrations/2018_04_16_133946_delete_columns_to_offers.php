<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteColumnsToOffers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn(['transaction_number', 'payment','commission','total']);
        });

         Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->double('total');
            $table->double('commission')->nullable();
            $table->double('payment');
            $table->string('transaction_number');
        });

         Schema::table('transactions', function (Blueprint $table) {
           $table->string('type');          
        });
    }
}

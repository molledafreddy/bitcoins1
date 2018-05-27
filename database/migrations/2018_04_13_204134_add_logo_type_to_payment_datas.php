<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLogoTypeToPaymentDatas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_datas', function (Blueprint $table) {
            $table->string('logo'); 
            $table->integer('type')->comment("1=para bitcoins,2= para pesos"); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_datas', function (Blueprint $table) {
            $table->dropColumn(['logo', 'type']);
        });
    }
}

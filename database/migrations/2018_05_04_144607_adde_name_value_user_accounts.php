<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddeNameValueUserAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_accounts', function (Blueprint $table) {
            $table->string('name');
            $table->string('value');
            $table->integer('payment_data_id')->unsigned()->nullable();

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
        Schema::table('user_accounts', function (Blueprint $table) {
            $table->dropForeign('user_accounts_payment_data_id_foreign');
            $table->dropColumn(['name','value','payment_data_id']);
        });
    }
}

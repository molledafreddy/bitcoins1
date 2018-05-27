<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname')->after('name');
            $table->string('username')->after('email');
            $table->string('type', 1)->default('U')->after('password');
            $table->boolean('is_active',1)->default('0')->after('type');
            $table->string('verify_token', 100)->nullable()->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['lastname', 'username', 'type', 'is_active', 'verify_token']);
        });
    }
}

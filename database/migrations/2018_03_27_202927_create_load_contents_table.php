<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoadContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('load_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->default();
            $table->longText('template');
            $table->integer('content_type_id')->unsigned()->nullable();
            $table->timestamps();


            $table->foreign('content_type_id')->references('id')->on('content_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('load_contents');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('respons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->string('size');
            $table->unsignedInteger('request_id')->onDelete('cascade');
            $table->foreign('request_id')->references('id')->on('reques')->onDelete('cascade');
            //$table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respons');
    }
}

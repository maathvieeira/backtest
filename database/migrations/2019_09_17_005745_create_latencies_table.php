<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLatenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('latencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('proxy',10);
            $table->string('kong', 10);
            $table->string('request_lat', 10);
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
        Schema::dropIfExists('latencies');
    }
}

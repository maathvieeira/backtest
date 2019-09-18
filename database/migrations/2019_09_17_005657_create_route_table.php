<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('route', function (Blueprint $table) {
            $table->increments('id');
            $table->string('created_at', 10);
            $table->string('hosts', 150);
            $table->string('route_id', 150);
            $table->string('methods', 150);
            $table->string('path', 10);
            $table->string('preserve_host', 10);
            $table->string('protocols', 50);
            $table->string('regex_priority', 10);
            $table->string('service_id', 150);
            $table->string('strip_path', 10);
            $table->string('updated_at', 50);
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
        Schema::dropIfExists('route');
    }
}

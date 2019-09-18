<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('servic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content_timeout', 20);
            $table->string('created_at', 30);
            $table->string('host', 100);
            $table->string('service_id', 150);
            $table->string('name', 50);
            $table->string('path', 10);
            $table->string('port', 10);
            $table->string('protocol', 10);
            $table->string('read_timeout', 20);
            $table->string('retries', 10);
            $table->string('updated_at', 30);
            $table->string('write_timeout', 20);
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
        Schema::dropIfExists('servic');
    }
}

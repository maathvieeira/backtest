<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeadersresponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('headersresponse', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content_length', 30);
            $table->string('via', 30);
            $table->string('connection', 10);
            $table->string('access_control_allow_credentials', 10);
            $table->string('content_type', 50);
            $table->string('server', 50);
            $table->string('access_control_allow_origin', 10);
            $table->unsignedInteger('headers_id')->onDelete('cascade');
            $table->foreign('headers_id')->references('id')->on('respons')->onDelete('cascade');
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
        Schema::dropIfExists('headersresponse');
    }
}

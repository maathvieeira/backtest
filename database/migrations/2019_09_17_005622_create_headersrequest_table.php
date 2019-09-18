<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeadersrequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('headersrequest', function (Blueprint $table) {
            $table->increments('id');
            $table->string('accept', 10);
            $table->string('host', 100);
            $table->string('user_agent', 50);
            $table->unsignedInteger('headers_id')->onDelete('cascade');
            $table->foreign('headers_id')->references('id')->on('reques')->onDelete('cascade');
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
        Schema::dropIfExists('headersrequest');
    }
}

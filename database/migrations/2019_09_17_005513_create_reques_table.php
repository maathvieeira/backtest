<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('reques', function (Blueprint $table) {
            $table->increments('id');
            $table->string('method', 10);
            $table->string('uri', 10);
            $table->string('url', 150);
            $table->string('size', 10);
            $table->string('upstream_uri', 10);
            $table->string('uuid', 50);
            $table->string('client_ip', 100);
            $table->string('created_at', 30);
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
        Schema::dropIfExists('reques');
    }
}

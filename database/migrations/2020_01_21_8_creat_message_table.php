<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bord_id');
            $table->foreign('bord_id')->references('id')->on('bords');
            $table->dateTime('send_date');
            $table->unsignedBigInteger('send-user_id');
            $table->foreign('send-user_id')->references('id')->on('users');
            $table->unsignedBigInteger('recieve-user_id');
            $table->foreign('recieve-user_id')->references('id')->on('users');
            $table->longText('msg');
            $table->tinyInteger('delete_flg')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message');
    }
}

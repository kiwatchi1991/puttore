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
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('sendUser_id');
            $table->unsignedBigInteger('recieveUser_id');
            $table->longText('msg');
            $table->tinyInteger('delete_flg')->default(0);
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('sendUser_id')->references('id')->on('users');
            $table->foreign('recieveUser_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropColumn('order_id');
            $table->dropForeign(['sendUser_id']);
            $table->dropColumn('sendUser_id');
            $table->dropForeign(['recieveUser_id']);
            $table->dropColumn('recieveUser_id');

            Schema::dropIfExists('messages');
        });
    }
}

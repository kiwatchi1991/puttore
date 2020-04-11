<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
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
            $table->unsignedBigInteger('send_user_id');
            $table->unsignedBigInteger('recieve_user_id');
            $table->longText('msg');
            $table->tinyInteger('delete_flg')->default(0);
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('send_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('recieve_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

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
            $table->dropForeign(['send_user_id']);
            $table->dropColumn('send_user_id');
            $table->dropForeign(['recieve_user_id']);
            $table->dropColumn('recieve_user_id');
        });
        Schema::dropIfExists('messages');
    }
}

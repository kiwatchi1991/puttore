<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('follow_user_id');
            $table->unsignedBigInteger('followed_user_id');
            $table->tinyInteger('delete_flg')->default(0);
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('follow_user_id')->references('id')->on('users');
            $table->foreign('followed_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('follows', function (Blueprint $table) {
            $table->dropForeign(['follow_user_id']);
            $table->dropColumn('follow_user_id');
            $table->dropForeign(['followed_user_id']);
            $table->dropColumn('followed_user_id');
            });
        Schema::dropIfExists('follows');

    }
}

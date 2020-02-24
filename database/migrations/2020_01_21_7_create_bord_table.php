<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sale-user_id');
            $table->unsignedBigInteger('buy-user_id');
            $table->unsignedBigInteger('product_id');
            $table->tinyInteger('delete_flg')->default(0);
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('sale-user_id')->references('id')->on('users');
            $table->foreign('buy-user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bord', function (Blueprint $table) {
            $table->dropForeign(['sale-user_id']);
            $table->dropColumn('sale-user_id');
            $table->dropForeign(['buy-user_id']);
            $table->dropColumn('buy-user_id');
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
            });
        Schema::dropIfExists('bord');
        
    }
}

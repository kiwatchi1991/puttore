<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('sale_price', 10, 0);
            $table->decimal('transfer_price', 10, 0)->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->string('payjp_id');
            $table->unsignedBigInteger('transfer_id')->nullable();

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('transfer_id')->references('id')->on('transfers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
            $table->dropForeign(['transfer_id']);
            $table->dropColumn('transfer_id');
        });
        Schema::dropIfExists('orders');
    }
}

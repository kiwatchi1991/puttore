<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreteDifficultyProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('difficulty_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('difficulty_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

        // 外部キー制約
        $table->foreign('difficulty_id')->references('id')->on('difficulties');
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
        Schema::dropIfExists('difficulty_product');
    }
}

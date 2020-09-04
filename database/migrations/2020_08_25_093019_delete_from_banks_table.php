<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteFromBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('from_banks');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('from_banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('commission1');
            $table->integer('commission2')->nullable();
            $table->integer('commission3')->nullable();
            $table->integer('commission4')->nullable();
            $table->integer('commission5')->nullable();
            $table->timestamps();
        });
    }
}

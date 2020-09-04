<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transfers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropForeign(['from_bank_id']);
            $table->dropColumn('from_bank_id');
        });
        Schema::dropIfExists('transfers');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('transfer_price', 10, 0)->nullable();
            // $table->decimal('transferred_price', 10, 0)->nullable();
            $table->decimal('commission', 10, 0)->nullable();
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('from_bank_id');
            $table->timestamps();

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('from_bank_id')->references('id')->on('from_banks');
        });
    }
}

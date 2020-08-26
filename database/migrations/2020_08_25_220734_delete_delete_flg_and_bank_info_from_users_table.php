<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteDeleteFlgAndBankInfoFromUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('delete_flg');
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_branch');
            $table->dropColumn('bank_account_num');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('delete_flg')->default(0);
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->integer('bank_account_num')->nullable();
        });
    }
}

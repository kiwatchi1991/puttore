<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBankColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('bank_code')->nullable();
            $table->integer('bank_branch_code')->nullable();
            $table->String('bank_account_holder_name')->nullable();
            $table->tinyInteger('bank_account_type')->nullable();
            $table->integer('bank_account_number')->nullable();
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
            $table->dropColumn('bank_code');
            $table->dropColumn('bank_branch_code');
            $table->dropColumn('bank_account_holder_name');
            $table->dropColumn('bank_account_type');
            $table->dropColumn('bank_account_number');
        });
    }
}

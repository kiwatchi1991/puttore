<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('group')->default(0);
            $table->string('account_id')->unique()->default(0);
            $table->string('account_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('pic')->nullable();
            // $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->tinyInteger('delete_flg')->default(0);
            // $table->dateTime('created_at');
            // $table->timestamps('updated_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        
    }
}

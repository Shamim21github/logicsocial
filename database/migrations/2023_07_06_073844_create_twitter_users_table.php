<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwitterUsersTable extends Migration
{
    public function up()
    {
        Schema::create('twitter_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('acc_name'); 
            $table->string('access_token');
            $table->string('access_token_secret');
            $table->string('avatar');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('twitter_users');
    }
}

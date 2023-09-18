<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //id,user_id,email,name,access_token,avatar
    public function up()
    {
        Schema::create('google_user',function (blueprint $table){
            $table->id();
            $table->string('user_id');
            $table->string('email');
            $table->string('name');
            $table->string('access_token');
            $table->string('avatar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('google_users');
    }
};

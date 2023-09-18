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
    public function up()
    {
        Schema::create('facebook_users', function (Blueprint $table) {
            $table->id();
           // $table->unsignedBigInteger('user_id');
            $table->foreignId('user_id');
            $table->string('acc_profile_id');
            $table->string('acc_name');          
            $table->string('access_token');
            $table->string('avatar');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
        });
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facebook_users');
    }
};

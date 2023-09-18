<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacebookPagesTable extends Migration
{
    public function up()
    {
        Schema::create('facebook_pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facebook_user_id');
            $table->string('page_id')->unique();
            $table->string('page_name');
            $table->string('page_avatar');
            $table->string('access_token');
            $table->timestamps();

            // Define foreign key relationship
            $table->foreign('facebook_user_id')
                ->references('id')
                ->on('facebook_users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('facebook_pages');
    }
}

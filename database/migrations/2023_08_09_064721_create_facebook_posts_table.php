<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacebookPostsTable extends Migration
{
    public function up()
    {
        Schema::create('facebook_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->string('message');
            $table->string('link');
            // $table->string('image_url')->nullable();
            $table->string('post_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('facebook_posts');
    }
}

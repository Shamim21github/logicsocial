<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediaPlatformsTable extends Migration
{
    public function up()
    {
        Schema::create('social_media_platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedTinyInteger('platform_id')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('social_media_platforms');
    }
}


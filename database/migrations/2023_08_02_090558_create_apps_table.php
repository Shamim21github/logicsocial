<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->unique();
            $table->string('app_id');
            $table->string('app_secret');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apps');
    }
}

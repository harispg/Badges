<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('badge_id')->unsigned();
            $table->foreign('badge_id')->references('id')->on('badges')->onDelete('cascade');

            $table->string('name');
            $table->string('path');
            $table->string('thumbnail_path');
            $table->boolean('main_picture')->default(false);

            $table->timestamps();

        });

        Schema::create('photo_user', function (Blueprint $table) {
            $table->integer('photo_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->primary(['photo_id', 'user_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
        Schema::dropIfExists('photo_user');
    }
}
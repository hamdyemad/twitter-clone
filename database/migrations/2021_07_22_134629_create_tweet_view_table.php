<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweet_view', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tweet_id');
            $table->unsignedBigInteger('user_id');
            $table->unique(['user_id', 'tweet_id']);
            $table->foreign('tweet_id')->references('id')->on('tweets')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('tweet_view');
    }
}

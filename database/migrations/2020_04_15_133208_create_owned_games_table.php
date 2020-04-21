<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnedGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owned_games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('score')->nullable();
            $table->integer('year');
            $table->string('art_url');
            $table->boolean('on_wishlist')->default(0);
            $table->bigInteger('owned_platform_id')->unsigned();
            $table->foreign('owned_platform_id')->references('id')->on('owned_platforms')->onDelete('cascade');
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
        Schema::dropIfExists('owned_games');
    }
}

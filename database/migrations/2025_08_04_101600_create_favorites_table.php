<?php

//use Illuminate\Database\Migrations\Migration;
//use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Support\Facades\Schema;
//
//class CreateFavoritesTable extends Migration
//{
//    public function up()
//    {
//        Schema::create('favorites', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger('user_id');
//            $table->unsignedBigInteger('post_id');         // ako koristiš post_id izravno
//            $table->unsignedBigInteger('favorited_id');
//            $table->string('favorited_type');
//            $table->unsignedBigInteger('favoriteable_id');
//            $table->string('favoriteable_type');
//            $table->timestamps();
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
//            $table->index(['favorited_id', 'favorited_type']);
//        });
//    }
//
//    public function down()
//    {
//        Schema::dropIfExists('favorites');
//    }
//}

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clean_favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id');
            $table->timestamps();

            // Postavljanje stranih ključeva
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            // Osigurava da isti korisnik ne može favorizirati isti post više puta
            $table->unique(['user_id', 'post_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clean_favorites');
    }
};

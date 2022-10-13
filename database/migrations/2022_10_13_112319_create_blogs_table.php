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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->tinyText('summary');
            $table->tinyInteger('published');
            $table->longText('content');
            $table->string('title');
            $table->date('published_at');
            $table->unsignedBigInteger('blog_category_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('blog_category_id')->references('id')->on('blog_cateogires');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};

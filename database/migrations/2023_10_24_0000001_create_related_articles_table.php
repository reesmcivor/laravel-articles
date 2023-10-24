<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('related_articles', function (Blueprint $table) {
            $table->foreignIdFor(\ReesMcIvor\Articles\Models\Article::class, 'article_id');
            $table->foreignIdFor(\ReesMcIvor\Articles\Models\Article::class, 'related_article_id');
            $table->timestamps();

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('related_article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('related_articles');
    }
};
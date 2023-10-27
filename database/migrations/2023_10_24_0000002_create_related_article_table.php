<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('article_routine', function (Blueprint $table) {
            $table->foreignIdFor(\ReesMcIvor\Articles\Models\Article::class, 'article_id');
            $table->foreignIdFor(\App\Models\Routine::class, 'routine_id');
            $table->timestamps();

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('routine_id')->references('id')->on('routines')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_routine');
    }
};
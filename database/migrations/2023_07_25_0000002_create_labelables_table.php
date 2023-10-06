<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('articleables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('articleable_id');
            $table->string('articleable_type');
            $table->timestamps();
            $table->index(['articleable_id', 'articleable_type']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('articleables');
    }
};

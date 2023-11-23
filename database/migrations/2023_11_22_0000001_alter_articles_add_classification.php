<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->enum('classification', ['article', 'news'])->after('id');
        });
        \ReesMcIvor\Articles\Models\Article::query()->update(['classification' => 'article']);
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('classification');
        });
    }
};
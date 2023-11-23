<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::table('article_categories', function (Blueprint $table) {
            $table->enum('classification', ['article', 'news'])->after('id');
        });
        \ReesMcIvor\Articles\Models\ArticleCategory::query()->update(['classification' => 'article']);
    }

    public function down()
    {
        Schema::table('article_categories', function (Blueprint $table) {
            $table->dropColumn('classification');
        });
    }
};
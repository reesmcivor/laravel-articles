<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::table('article_categories', function (Blueprint $table) {
            $table->integer('sort_order')->nullable()->default(0)->after('slug');
        });
    }

    public function down()
    {
        Schema::table('article_categories', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::table('article_categories', function (Blueprint $table) {
            $table->boolean('featured')->nullable()->default(false)->after('sort_order');
            $table->dateTime('publish_from')->nullable()->before('created_at');
            $table->dateTime('publish_to')->nullable()->before('created_at');
        });
    }

    public function down()
    {
        Schema::table('article_categories', function (Blueprint $table) {
            $table->dropColumn('featured');
            $table->dropColumn('publish_from');
            $table->dropColumn('publish_to');
        });
    }
};

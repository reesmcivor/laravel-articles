<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::statement("ALTER TABLE `article_categories` MODIFY `type` ENUM('health_and_fitness', 'sport_and_activity', 'injuries') NULL;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `article_categories` MODIFY `type` ENUM('health_and_fitness', 'sport_and_activity') NULL;");
    }
};

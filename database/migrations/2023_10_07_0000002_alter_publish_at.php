<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('publish_at');
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->dateTimeTz('publish_at')->before('deleted_at');
        });
    }
};

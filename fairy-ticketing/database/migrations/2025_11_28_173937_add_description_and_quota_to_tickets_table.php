<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name');
            $table->integer('quota')->after('price');
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['description', 'quota']);
        });
    }
};

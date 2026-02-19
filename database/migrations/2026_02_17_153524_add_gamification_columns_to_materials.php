<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('materials', function (Blueprint $table) {

        if (!Schema::hasColumn('materials', 'xp_point')) {
            $table->integer('xp_point')->default(0);
        }

        if (!Schema::hasColumn('materials', 'total_score')) {
            $table->integer('total_score')->default(0);
        }

        if (!Schema::hasColumn('materials', 'progress_level')) {
            $table->integer('progress_level')->default(0);
        }
    });
}

public function down()
{
    Schema::table('materials', function (Blueprint $table) {
        $table->dropColumn([
            'xp_point',
            'total_score',
            'progress_level'
        ]);
    });
}

};

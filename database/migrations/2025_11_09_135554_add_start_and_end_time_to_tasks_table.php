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
    Schema::table('tasks', function (Blueprint $table) {
        if (!Schema::hasColumn('tasks', 'start_time')) {
            $table->date('start_time')->nullable();
        }
        if (!Schema::hasColumn('tasks', 'end_time')) {
            $table->date('end_time')->nullable();
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['start_time', 'end_time']);
        });
    }
};

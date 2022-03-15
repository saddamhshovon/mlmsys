<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->tinyInteger('has_children')->default(0);
            $table->integer('current_level')->default(0);
            $table->integer('total_levels_underneath')->default(0);
            $table->integer('total_user_underneath')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('has_children');
            $table->dropColumn('current_level');
            $table->dropColumn('total_levels_underneath');
            $table->dropColumn('total_user_underneath');
        });
    }
}

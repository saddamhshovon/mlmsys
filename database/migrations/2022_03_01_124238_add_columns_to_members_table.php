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
            $table->tinyInteger('has_children')->nullable();
            $table->integer('current_level')->nullable();
            $table->integer('total_levels_underneath')->nullable();
            $table->integer('total_user_underneath')->nullable();
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
            $table->dropColumn('has_children')->nullable();
            $table->dropColumn('current_level')->nullable();
            $table->dropColumn('total_levels_underneath')->nullable();
            $table->dropColumn('total_user_underneath')->nullable();
        });
    }
}

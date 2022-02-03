<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('user_name')->unique();
            $table->string('email');
            $table->string('mobile_no');
            $table->string('moblie_banking_service');
            $table->string('city');
            $table->string('country');
            $table->string('password');
            $table->string('pin');
            $table->integer('account_balance')->nullable();
            $table->string('membership_type');
            $table->integer('referral_id')->nullable();
            $table->integer('placement_id')->nullable();
            $table->tinyInteger('max_children')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->tinyInteger('is_expired')->default(0);
            $table->tinyInteger('is_blocked')->default(0);
            $table->timestamp('will_expire_on')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}

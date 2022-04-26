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
            $table->string('mobile_banking_service');
            $table->string('city');
            $table->string('country');
            $table->string('password');
            $table->string('pin');
            $table->float('account_balance')->default(0);
            $table->string('membership_type');
            $table->string('referral_id')->nullable();
            $table->string('placement_id')->nullable();
            $table->tinyInteger('max_children')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_expired')->default(0);
            $table->tinyInteger('is_blocked')->default(0);
            $table->timestamp('will_expire_on')->nullable();
            $table->integer('withdraw_count')->default(0);
            $table->integer('total_withdraw')->default(0);
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

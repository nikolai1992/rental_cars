<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->string('first_name')->nullable();
            $table->integer('role_id')->nullable();
            $table->string('email')->unique();
            $table->boolean('active')->default(1)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('notification')->default(0);
            $table->boolean('sms_notification')->default(0);
            $table->string('site')->nullable();
            $table->string('state')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('twitter_provider_id')->nullable();
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
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable();
            $table->string('engine')->nullable();
            $table->string('max_speed')->nullable();
            $table->string('time_to_100')->nullable();
            $table->string('color')->nullable();
            $table->string('model')->nullable();
            $table->string('horsepower')->nullable();
            $table->string('cabin_color')->nullable();
            $table->string('year_created')->nullable();
            $table->string('transmission')->nullable();
            $table->string('trunk_capacity')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('set null');
            $table->string('video')->nullable();
            $table->string('work_location')->nullable();
            $table->string('rent_type')->nullable();
            $table->boolean('saved')->default(0);
            $table->integer('booking')->default(0);
            $table->integer('seats_number')->default(0);
            $table->timestamps();
            $table->timestamp('last_booking');
            $table->unsignedInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')
                ->onDelete('set null');
            $table->string('car_class')->nullable();
            $table->string('alias')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}

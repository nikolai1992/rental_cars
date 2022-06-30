<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->string('deposit', 255)->nullable();
            $table->string('mileage_limit', 255)->nullable();
            $table->string('const_for_one_km', 255)->nullable();
            $table->string('age_limit', 255)->nullable();
            $table->string('driving_experience', 255)->nullable();
            $table->double('price_day_1')->nullable();
            $table->double('price_day_2')->nullable();
            $table->double('price_day_3_6')->nullable();
            $table->double('price_day_7_13')->nullable();
            $table->double('price_day_14_20')->nullable();
            $table->double('price_day_21_29')->nullable();
            $table->double('price_day_30')->nullable();
            $table->unsignedInteger('car_id')->nullable();
            $table->foreign('car_id')->references('id')->on('cars')
                ->onDelete('cascade');
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
        Schema::dropIfExists('rents');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_images', function (Blueprint $table) {
            $table->id();
            $table->string('url', 255)->nullable();
            $table->string('order_id', 255)->nullable();
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
        Schema::dropIfExists('car_images');
    }
}

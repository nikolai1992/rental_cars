<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_rents', function (Blueprint $table) {
            $table->id();
            for($i=1; $i<=24; $i++)
            {
                $table->string('price_per_hour_'.$i)->nullable();
            }
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
        Schema::dropIfExists('driver_rents');
    }
}

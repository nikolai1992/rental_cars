<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_drivers', function (Blueprint $table) {
            $table->id();
            $table->string('fio')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->unsignedInteger('car_id')->nullable();
            $table->foreign('car_id')->references('id')->on('cars')
                ->onDelete('cascade');
            $table->timestamp('date')->nullable();
            $table->string('time', 255)->nullable();
            $table->string('price')->nullable();
            $table->string('duration')->nullable();
            $table->string('location')->nullable();
            $table->integer('order_number')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_status')->nullable();
            $table->timestamp('approved_booking')->nullable();
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
        Schema::dropIfExists('order_drivers');
    }
}

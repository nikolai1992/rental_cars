<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->boolean('international_law')->default(0);
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('fio')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedInteger('car_id')->nullable();
            $table->foreign('car_id')->references('id')->on('cars')
                ->onDelete('cascade');
            $table->string('city', 255)->nullable();
            $table->double('total_per_days')->nullable();
            $table->double('vat_tax')->nullable();
            $table->double('total_price')->nullable();
            $table->text('message')->nullable();
            $table->timestamp('from_date');
            $table->timestamp('to_date');
            $table->string('time');
            $table->integer('order_number');
            $table->string('status', 255);
            $table->string('payment_status');
            $table->timestamp('approved_booking');
            $table->boolean('another_location');
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
        Schema::dropIfExists('orders');
    }
}

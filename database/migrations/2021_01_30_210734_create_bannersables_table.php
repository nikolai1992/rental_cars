<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bannersables', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('banner_id')->nullable();
            $table->foreign('banner_id')->references('id')->on('banners')
                ->onDelete('cascade');
            $table->integer('bannersable_id')->nullable();
            $table->string('bannersable_type')->nullable();
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
        Schema::dropIfExists('bannersables');
    }
}

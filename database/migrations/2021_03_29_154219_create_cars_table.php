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
            $table->float('price');
            $table->string('phone');
            $table->string('title');
            $table->unsignedBigInteger('make_id')->nullable();
            $table->unsignedBigInteger('car_model_id')->nullable();
            $table->integer('year');
            $table->float('mileage');
            $table->string('transmission');
            $table->smallInteger('doors');
            $table->smallInteger('cylinders');
            $table->string('fuel');
            $table->text('description');
            $table->text('remarks')->nullable();
            $table->text('image')->nullable();
            $table->enum('status', ['publish', 'unPublish'])->default('Publish');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('car_model_id')->references('id')->on('car_models')->onDelete('cascade');
            $table->foreign('make_id')->references('id')->on('makes')->onDelete('cascade');
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

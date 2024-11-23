<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id('tour_id');
            $table->unsignedBigInteger('company_id');
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('location', 150)->nullable();
            $table->string('duration', 50)->nullable();
            $table->string('tour_type', 50)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('available_seats');
            $table->string('cover_image', 255)->nullable();
            $table->boolean('deleted')->default(false);
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tours');
    }
}
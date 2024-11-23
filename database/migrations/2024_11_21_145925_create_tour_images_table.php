<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourImagesTable extends Migration
{
    public function up()
    {
        Schema::create('tour_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id'); // Foreign key to the tours table
            $table->string('image_path');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('tour_id')->references('tour_id')->on('tours')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tour_images');
    }
}
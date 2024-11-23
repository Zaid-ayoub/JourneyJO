<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id'); // Primary key (category_id)
            $table->string('category_name', 100)->unique(); // Category name (unique)
            $table->string('category_image', 255)->nullable(); // Category image (nullable)
            $table->text('category_description')->nullable(); // Category description (nullable)
            $table->boolean('deleted')->default(false); // Soft delete flag (default: false)
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
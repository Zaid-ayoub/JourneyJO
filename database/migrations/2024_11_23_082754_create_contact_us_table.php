<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id('contact_id');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('user_email')->index(); // Email of the user contacting
            $table->string('message', 500); // Message content
            $table->timestamps(); // Created and Updated timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
}
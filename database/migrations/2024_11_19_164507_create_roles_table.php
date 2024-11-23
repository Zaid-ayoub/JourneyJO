<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
            $table->timestamps();
        }, 'ENGINE=InnoDB');
        

        // Insert default roles directly in the migration
        DB::table('roles')->insert([
            ['role_name' => 'user', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'company', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'super_admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
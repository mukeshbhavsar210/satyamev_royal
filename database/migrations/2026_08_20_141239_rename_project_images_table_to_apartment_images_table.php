<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('apartment_images', function (Blueprint $table) {
             Schema::rename('project_images', 'apartment_images');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartment_images', function (Blueprint $table) {
            Schema::rename('apartment_images', 'project_images');
        });
    }
};

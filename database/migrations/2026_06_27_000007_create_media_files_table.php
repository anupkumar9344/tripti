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
        Schema::create('media_files', function (Blueprint $table) {
            $table->id();
            $table->string('display_name');
            $table->string('original_name');
            $table->string('file_path')->unique();
            $table->string('mime_type', 120);
            $table->string('extension', 20);
            $table->unsignedBigInteger('file_size')->default(0);
            $table->string('file_category', 20);
            $table->string('usage_summary')->nullable();
            $table->timestamps();

            $table->index('file_category');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_files');
    }
};

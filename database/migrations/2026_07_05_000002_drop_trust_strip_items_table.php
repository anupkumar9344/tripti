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
        Schema::dropIfExists('trust_strip_items');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('trust_strip_items', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('image');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }
};

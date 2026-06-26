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
        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('photo');
            $table->string('designation')->nullable();
            $table->string('specialty')->nullable();
            $table->string('qualifications', 500)->nullable();
            $table->string('short_description', 500)->nullable();
            $table->string('specialty_location')->nullable();
            $table->string('experience_label')->nullable();
            $table->string('patients_treated')->nullable();
            $table->string('highlight_quote', 500)->nullable();
            $table->longText('long_description')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experts');
    }
};

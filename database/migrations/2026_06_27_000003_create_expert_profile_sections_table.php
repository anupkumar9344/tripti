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
        Schema::create('expert_profile_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expert_id')->constrained()->cascadeOnDelete();
            $table->foreignId('expert_profile_category_id')->constrained()->cascadeOnDelete();
            $table->longText('content')->nullable();
            $table->timestamps();

            $table->unique(['expert_id', 'expert_profile_category_id'], 'expert_profile_sections_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expert_profile_sections');
    }
};

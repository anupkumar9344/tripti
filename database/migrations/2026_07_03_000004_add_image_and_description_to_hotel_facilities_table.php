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
        Schema::table('hotel_facilities', function (Blueprint $table) {
            $table->string('image')->nullable()->after('icon');
            $table->text('short_description')->nullable()->after('image');
            $table->boolean('is_featured')->default(false)->after('short_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotel_facilities', function (Blueprint $table) {
            $table->dropColumn(['image', 'short_description', 'is_featured']);
        });
    }
};

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
        Schema::create('hotel_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('inquiry_type', 30);
            $table->foreignId('room_type_id')->nullable()->constrained('room_types')->nullOnDelete();
            $table->string('guest_name');
            $table->string('guest_email')->nullable();
            $table->string('guest_phone', 30);
            $table->string('subject')->nullable();
            $table->text('message');
            $table->date('check_in_date')->nullable();
            $table->date('check_out_date')->nullable();
            $table->unsignedTinyInteger('adults')->nullable();
            $table->unsignedTinyInteger('children')->default(0);
            $table->string('source', 30)->default('manual');
            $table->string('status', 30)->default('new');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_inquiries');
    }
};

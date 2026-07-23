<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('booking_type', 30);
            $table->string('contact_name');
            $table->string('email')->nullable();
            $table->string('phone', 30);
            $table->string('company_name')->nullable();
            $table->unsignedSmallInteger('number_of_people');
            $table->string('program_name');
            $table->date('event_date');
            $table->string('event_time', 20)->nullable();
            $table->text('purpose');
            $table->text('additional_notes')->nullable();
            $table->string('source', 30)->default('website');
            $table->string('status', 30)->default('new');
            $table->text('admin_notes')->nullable();
            $table->timestamps();

            $table->index(['status', 'event_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_bookings');
    }
};

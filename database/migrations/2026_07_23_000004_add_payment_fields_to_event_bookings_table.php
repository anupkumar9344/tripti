<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('event_bookings', function (Blueprint $table) {
            $table->decimal('booking_amount', 10, 2)->nullable()->after('additional_notes');
            $table->decimal('advance_amount', 10, 2)->nullable()->after('booking_amount');
            $table->date('advance_paid_at')->nullable()->after('advance_amount');
        });
    }

    public function down(): void
    {
        Schema::table('event_bookings', function (Blueprint $table) {
            $table->dropColumn(['booking_amount', 'advance_amount', 'advance_paid_at']);
        });
    }
};

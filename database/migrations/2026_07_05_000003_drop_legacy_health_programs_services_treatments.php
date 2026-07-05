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
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn(['service_id', 'display_on_service_detail']);
        });

        Schema::table('video_feedbacks', function (Blueprint $table) {
            $table->dropColumn('display_on_services');
        });

        Schema::dropIfExists('service_benefits');
        Schema::dropIfExists('service_sub_services');
        Schema::dropIfExists('service_images');
        Schema::dropIfExists('services');
        Schema::dropIfExists('treatments');
        Schema::dropIfExists('health_programs');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('health_programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image')->nullable();
            $table->string('video_url')->nullable();
            $table->string('eyebrow')->nullable();
            $table->string('section_title')->nullable();
            $table->text('section_lead')->nullable();
            $table->string('date_time')->nullable();
            $table->string('location')->nullable();
            $table->string('chief_consultant')->nullable();
            $table->text('key_benefits')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->boolean('active_on_home')->default(false);
            $table->timestamps();
        });

        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('image')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->boolean('display_on_home')->default(false);
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable();
            $table->string('tags')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('icon_tags')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->boolean('display_on_home')->default(false);
            $table->boolean('show_faq_section')->default(false);
            $table->string('sub_services_heading')->nullable();
            $table->string('benefits_heading')->nullable();
            $table->timestamps();
        });

        Schema::create('service_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('service_sub_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('service_benefits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->boolean('display_on_service_detail')->default(false)->after('display_on_home');
            $table->foreignId('service_id')->nullable()->constrained()->nullOnDelete()->after('display_on_expert_detail');
        });

        Schema::table('video_feedbacks', function (Blueprint $table) {
            $table->boolean('display_on_services')->default(false)->after('display_on_home');
        });
    }
};

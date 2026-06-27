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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('featured_image');
            $table->string('author')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('tags')->nullable();
            $table->date('published_at')->nullable();
            $table->boolean('display_on_home')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->string('seo_meta_title')->nullable();
            $table->string('seo_meta_description')->nullable();
            $table->string('seo_meta_keywords')->nullable();
            $table->string('seo_og_title')->nullable();
            $table->string('seo_og_description')->nullable();
            $table->string('seo_og_image')->nullable();
            $table->string('seo_robots')->default('index, follow');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};

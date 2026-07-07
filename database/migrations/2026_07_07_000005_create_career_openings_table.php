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
        Schema::create('career_openings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('department')->nullable();
            $table->string('job_type')->default('Full Time');
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::table('career_applications', function (Blueprint $table) {
            $table->foreignId('career_opening_id')->nullable()->after('id')->constrained()->nullOnDelete();
        });

        foreach (['career-openings.view', 'career-openings.create', 'career-openings.edit', 'career-openings.delete'] as $permission) {
            \Spatie\Permission\Models\Permission::query()->firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $superAdmin = \Spatie\Permission\Models\Role::query()->where('name', \App\Support\AdminPermissions::SUPER_ADMIN_ROLE)->first();

        if ($superAdmin) {
            $superAdmin->givePermissionTo([
                'career-openings.view',
                'career-openings.create',
                'career-openings.edit',
                'career-openings.delete',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('career_applications', function (Blueprint $table) {
            $table->dropConstrainedForeignId('career_opening_id');
        });

        Schema::dropIfExists('career_openings');
    }
};

<?php

use App\Models\Setting;
use App\Support\AdminPermissions;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Remove team/experts feature and add career page settings.
     */
    public function up(): void
    {
        if (Schema::hasTable('faqs')) {
            Schema::table('faqs', function (Blueprint $table) {
                if (Schema::hasColumn('faqs', 'expert_id')) {
                    $table->dropForeign(['expert_id']);
                    $table->dropColumn('expert_id');
                }

                if (Schema::hasColumn('faqs', 'display_on_expert_detail')) {
                    $table->dropColumn('display_on_expert_detail');
                }
            });
        }

        Schema::dropIfExists('experts');

        Setting::query()->whereIn('key', [
            'team_page_eyebrow',
            'team_page_title',
            'team_page_intro',
        ])->delete();

        $defaults = [
            'career_page_eyebrow' => 'Join Our Team',
            'career_page_title' => 'Build Your Career at Tripti Hotel',
            'career_page_intro' => 'We are always looking for passionate people to deliver warm hospitality and memorable guest experiences.',
            'career_form_title' => 'Apply Now',
            'career_form_description' => 'Share your details and our HR team will contact you if your profile matches an open role.',
        ];

        foreach ($defaults as $key => $value) {
            if (Setting::getValue($key) === null) {
                Setting::setValue($key, $value);
            }
        }

        foreach (['careers.view', 'careers.update', 'careers.delete'] as $permission) {
            Permission::query()->firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $superAdmin = Role::query()->where('name', AdminPermissions::SUPER_ADMIN_ROLE)->first();

        if ($superAdmin) {
            $superAdmin->givePermissionTo(['careers.view', 'careers.update', 'careers.delete']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

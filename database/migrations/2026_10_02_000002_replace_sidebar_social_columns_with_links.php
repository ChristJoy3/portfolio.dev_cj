<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sidebar_profiles', function (Blueprint $table) {
            $table->json('links')->nullable()->after('email'); // [{label, url}] shown in the sidebar footer
        });

        // Carry over whatever the two fixed columns held.
        foreach (DB::table('sidebar_profiles')->get() as $row) {
            $links = array_values(array_filter([
                $row->github_url ? ['label' => 'GitHub', 'url' => $row->github_url] : null,
                $row->linkedin_url ? ['label' => 'LinkedIn', 'url' => $row->linkedin_url] : null,
            ]));

            DB::table('sidebar_profiles')->where('id', $row->id)->update(['links' => json_encode($links)]);
        }

        Schema::table('sidebar_profiles', function (Blueprint $table) {
            $table->dropColumn(['github_url', 'linkedin_url']);
        });
    }

    public function down(): void
    {
        Schema::table('sidebar_profiles', function (Blueprint $table) {
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->dropColumn('links');
        });
    }
};

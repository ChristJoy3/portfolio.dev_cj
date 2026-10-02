<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Singleton: one row holds the profile card at the top/bottom of the left sidebar.
        Schema::create('sidebar_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->string('tagline')->nullable();
            $table->string('image_url')->nullable(); // URL or path under public/, see abouts table
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->timestamps();
        });

        // The percentage meters. `group` decides how a row is drawn:
        // language = circular badge, core = first bar block, extended = scrollable bar list.
        Schema::create('sidebar_skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedTinyInteger('level')->default(50);
            $table->string('group', 16)->default('extended');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sidebar_skills');
        Schema::dropIfExists('sidebar_profiles');
    }
};

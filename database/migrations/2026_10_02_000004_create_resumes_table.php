<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Singleton: one row holds the whole CV page.
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->string('headline')->nullable();   // "Web Developer"
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('summary')->nullable();
            $table->json('skills')->nullable();       // [{label, items}]
            $table->json('experience')->nullable();   // [{role, organization, details, period, bullets}]
            $table->json('education')->nullable();    // [{degree, school, period, highlights}]
            $table->json('soft_skills')->nullable();  // ["Problem-Solving", ...]
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};

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
        // Singleton: one row holds the whole About Me section.
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->default('About Me');
            $table->string('heading')->default('Hi! I\'m CJ');
            $table->text('lead')->nullable();        // the bold opening line
            $table->text('body')->nullable();        // blank line = new paragraph
            $table->string('image_url')->nullable(); // URL or /assets/... path, see projects table
            $table->string('badge_text')->nullable();
            $table->json('chips')->nullable();       // [{label, icon}] rendered as .tech-chip
            $table->string('cta_label')->nullable();
            $table->string('cta_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};

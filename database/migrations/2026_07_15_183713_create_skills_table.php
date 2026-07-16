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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('href')->nullable();
            $table->string('accent', 32)->default('#00b0ff'); // hover glow + tooltip border
            // Either an image URL (devicon / simple-icons) or a Font Awesome class. Image wins.
            $table->string('icon_url')->nullable();
            $table->string('icon_class')->nullable();
            // Font Awesome glyphs only. Leave null to inherit the page colour, which is what keeps
            // the GitHub mark readable in both light and dark themes.
            $table->string('icon_color', 32)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Admin uploads live in the database: Vercel's filesystem is read-only, so a file written
        // to disk would vanish on the next deploy. base64 text (not a binary column) because
        // Postgres hands bytea back as a stream, which is awkward to serve.
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('mime', 64);
            $table->longText('data');
            $table->unsignedInteger('size');
            $table->unsignedInteger('width');
            $table->unsignedInteger('height');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};

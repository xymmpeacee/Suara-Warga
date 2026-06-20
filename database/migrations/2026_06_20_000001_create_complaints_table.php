<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_code', 20)->unique();
            $table->enum('category', ['jalan_rusak', 'sampah', 'penerangan', 'drainase', 'fasilitas_umum', 'lainnya']);
            $table->string('title', 150);
            $table->text('description');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('address')->nullable();
            $table->string('photo_path');
            $table->enum('priority', ['rendah', 'sedang', 'tinggi']);
            $table->string('whatsapp');
            $table->string('reporter_name')->nullable();
            $table->string('reporter_email');
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
            $table->unsignedInteger('upvote_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};

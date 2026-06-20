<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('upvotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')->constrained()->cascadeOnDelete();
            $table->string('email');
            $table->timestamps();

            // Satu email hanya bisa upvote satu laporan sekali
            $table->unique(['complaint_id', 'email']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('upvotes');
    }
};

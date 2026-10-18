<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_destinasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destinasi_id')->constrained('destinasis')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('pesan_laporan');
            $table->string('status')->default('Pending'); // Pending, Diterima, Ditolak
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_destinasis');
    }
};
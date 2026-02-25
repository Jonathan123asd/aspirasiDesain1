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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->enum('urgensi', ['rendah', 'sedang', 'tinggi'])->default('sedang');
            $table->string('kategori');
            $table->text('deskripsi');
            $table->string('lokasi')->nullable();
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};

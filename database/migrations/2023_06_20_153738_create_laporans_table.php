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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('id_laporan', 100);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('user_image')->nullable();
            $table->string('nama', 150);
            $table->string('nomor', 16);
            $table->text('alamat');
            $table->dateTime('tanggal');
            $table->foreignId('kategori_lapor')->constrained('kategoris');
            $table->foreignId('status_lapor')->constrained('statuses');
            $table->unsignedBigInteger('daerah_kelurahan')->nullable();
            $table->foreign('daerah_kelurahan')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('dinas_ajuan')->nullable();
            $table->foreign('dinas_ajuan')->references('id')->on('users')->onDelete('set null');
            $table->text('deskripsi');
            $table->string('maps');
            $table->enum('konfirmasi_dinas', [true, false])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};

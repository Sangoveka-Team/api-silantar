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
            $table->integer('IDlaporan');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama', 150);
            $table->string('nomor', 15);
            $table->text('alamat');
            $table->dateTime('tanggal');
            $table->foreignId('kategori_lapor')->constrained('kategoris');
            $table->foreignId('status_lapor')->constrained('statuses');
            $table->foreignId('daerah_lapor')->constrained('daerahs');
            $table->string('maps');
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

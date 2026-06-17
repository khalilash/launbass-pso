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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('IDPesanan'); // Primary Key Pesanan
            $table->integer('IDPelanggan');
            $table->integer('IDUser');
            $table->date('Tanggal_Masuk');
            $table->date('Tanggal_Keluar')->nullable(); // Dibuat nullable jika belum selesai
            $table->string('Status_Pesanan');
            $table->integer('Total_Biaya');
            $table->text('Catatan')->nullable();
            $table->string('Tipe_Pengiriman');
            $table->double('Berat_Kg', 8, 2);
            $table->integer('Jumlah_Pcs');
            $table->integer('IDPaket');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};

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
        Schema::table('pemasukan', function (Blueprint $table) {

            if (!Schema::hasColumn('pemasukan', 'Jumlah')) {
                $table->double('Jumlah')->default(0);
            }

            if (!Schema::hasColumn('pemasukan', 'Tanggal_Transaksi')) {
                $table->dateTime('Tanggal_Transaksi')->nullable();
            }

            if (!Schema::hasColumn('pemasukan', 'Catatan')) {
                $table->text('Catatan')->nullable();
            }

            if (!Schema::hasColumn('pemasukan', 'IDUser')) {
                $table->integer('IDUser')->nullable();
            }
        });

        Schema::table('pengeluaran', function (Blueprint $table) {

            if (!Schema::hasColumn('pengeluaran', 'Jumlah')) {
                $table->double('Jumlah')->default(0);
            }

            if (!Schema::hasColumn('pengeluaran', 'Tanggal_Pengeluaran')) {
                $table->dateTime('Tanggal_Pengeluaran')->nullable();
            }

            if (!Schema::hasColumn('pengeluaran', 'Kategori')) {
                $table->string('Kategori')->nullable();
            }

            if (!Schema::hasColumn('pengeluaran', 'Catatan')) {
                $table->text('Catatan')->nullable();
            }

            if (!Schema::hasColumn('pengeluaran', 'IDUser')) {
                $table->integer('IDUser')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemasukan', function (Blueprint $table) {
            $table->dropColumn([
                'Jumlah',
                'Tanggal_Transaksi',
                'Catatan',
                'IDUser'
            ]);
        });

        Schema::table('pengeluaran', function (Blueprint $table) {
            $table->dropColumn([
                'Jumlah',
                'Tanggal_Pengeluaran',
                'Kategori',
                'Catatan',
                'IDUser'
            ]);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

public function up(): void
{
    if (!Schema::hasColumn('pelanggan', 'IDPelanggan')) {

        Schema::table('pelanggan', function (Blueprint $table) {
            $table->integer('IDPelanggan')->nullable();
        });

    }

    DB::statement("
        UPDATE pelanggan
        SET IDPelanggan = id
        WHERE IDPelanggan IS NULL
    ");
}

    public function down(): void
    {
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->dropColumn('IDPelanggan');
        });
    }
};

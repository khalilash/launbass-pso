<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('user')) {

            Schema::create('user', function (Blueprint $table) {
                $table->id('IDUser');
                $table->string('Nama', 100);
                $table->string('Email', 100)->unique();
                $table->string('Password', 255);
                $table->string('Jabatan', 50)->nullable();
            });

        }
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};

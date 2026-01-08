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
        Schema::create('suratjalan', function (Blueprint $table) {
    $table->string('nosuratjalan', 30)->primary();
    $table->string('nopo', 30);
    $table->foreignId('idcustomer')->constrained('customer', 'idcustomer');
    $table->date('tglpengiriman');
    $table->string('nopol', 15)->constrained('kendaraan', 'nopol');
    $table->foreignId('idpetugas')->constrained('petugas', 'idpetugas');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_jalans');
    }
};

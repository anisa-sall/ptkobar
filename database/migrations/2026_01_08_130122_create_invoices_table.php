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
        Schema::create('invoice', function (Blueprint $table) {
    $table->string('noinvoice', 15)->primary();
    $table->date('tgl');
    $table->string('nopo', 30);
    $table->string('npwp', 20);
    $table->foreignId('idcustomer')->constrained('customer', 'idcustomer');
    $table->foreignId('idpetugas')->constrained('petugas', 'idpetugas');
    $table->decimal('subtotal', 20, 2);
    $table->decimal('ppn', 20, 2);
    $table->decimal('total', 20, 2);
    $table->string('nodokumen', 30);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

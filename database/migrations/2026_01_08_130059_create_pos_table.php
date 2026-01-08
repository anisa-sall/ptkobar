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
        Schema::create('po', function (Blueprint $table) {
    $table->string('nopo', 30)->primary();
    $table->foreignId('idcustomer')->constrained('customer', 'idcustomer');
    $table->date('tglpo');
    $table->date('deliveryschedule');
    $table->foreignId('idpetugas')->constrained('petugas', 'idpetugas');
    $table->decimal('harga', 20, 2);
    $table->decimal('subtotal', 20, 2);
    $table->decimal('ppn', 20, 2);
    $table->decimal('total', 20, 2);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos');
    }
};

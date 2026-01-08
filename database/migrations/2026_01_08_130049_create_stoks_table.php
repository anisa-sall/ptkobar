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
        // Tabel: stok
Schema::create('stok', function (Blueprint $table) {
    $table->string('nopart', 25);
    $table->string('namapart', 50);
    $table->integer('idcustomer');
    $table->integer('stokawal');
    $table->integer('stokmasuk');
    $table->integer('stokkeluar');
    $table->integer('stokakhir');
    $table->integer('minimumstok');

    $table->foreign('nopart')->references('nopart')->on('part');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stoks');
    }
};

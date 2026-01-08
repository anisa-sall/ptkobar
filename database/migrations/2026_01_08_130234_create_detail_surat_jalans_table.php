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
        // Tabel: detailsuratjalan
Schema::create('detailsuratjalan', function (Blueprint $table) {
    $table->string('nosuratjalan', 30);
    $table->string('nopart', 25);
    $table->integer('quantity');
    $table->string('keterangan', 50);

    $table->foreign('nosuratjalan')->references('nosuratjalan')->on('suratjalan');
    $table->foreign('nopart')->references('nopart')->on('part');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_surat_jalans');
    }
};

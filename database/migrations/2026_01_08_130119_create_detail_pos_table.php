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
        // Tabel: detailpo
Schema::create('detailpo', function (Blueprint $table) {
    $table->string('nopo', 30);
    $table->string('nopart', 25);
    $table->integer('quantity');
    $table->string('unit', 25);
    $table->decimal('total', 20, 2);
    
    $table->foreign('nopo')->references('nopo')->on('po');
    $table->foreign('nopart')->references('nopart')->on('part');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pos');
    }
};

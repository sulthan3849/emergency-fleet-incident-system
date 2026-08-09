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
        Schema::create('armada_mobil_laporan_kejadian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_kejadian_id')->constrained('laporan_kejadians')->onDelete('cascade');
            $table->foreignId('armada_mobil_id')->constrained('armada_mobils')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('armada_mobil_laporan_kejadian');
    }
};

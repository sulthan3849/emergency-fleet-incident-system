<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('armada_mobils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posko_id')->constrained('poskos')->onDelete('cascade');
            $table->string('plat_nomor');
            $table->string('tipe');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('armada_mobils');
    }
};

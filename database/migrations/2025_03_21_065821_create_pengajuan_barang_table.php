<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengajuan_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengaju');
            $table->string('nama_barang');
            $table->date('tanggal_pengajuan');
            $table->integer('qty');
            $table->boolean('terpenuhi')->default(0); // 0 = belum terpenuhi, 1 = terpenuhi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_barang');
    }
};
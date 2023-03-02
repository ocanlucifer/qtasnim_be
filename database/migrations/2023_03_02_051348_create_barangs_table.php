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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 6)->unique();
            $table->string('nama_barang', 50)->unique();
            $table->decimal('stock', 30, 3);
            $table->string('satuan', 50);
            $table->unsignedBigInteger('jenis_barang_id');
            $table->timestamps();

            $table->foreign('jenis_barang_id')->references('id')->on('jenis_barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};

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
        Schema::create('rumah', function (Blueprint $table) {
            $table->id();
            $table->integer('lokasi_id');
            $table->string('no_rumah');
            $table->string('tipe')->nullable();
            $table->string('harga')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('detail')->nullable();
            $table->string('status');
            $table->string('foto_rumah')->default('logo-rautama.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumah');
    }
};

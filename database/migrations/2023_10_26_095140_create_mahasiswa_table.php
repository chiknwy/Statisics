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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id()->unique();
            $table->integer('skor1');
            $table->integer('skor2');
            $table->integer('skor3');
            $table->integer('skor4');
            $table->integer('skor5');
            $table->integer('skor6');
            $table->integer('skor7');
            $table->integer('skor8');
            $table->integer('skor9');
            $table->integer('skor10');
            $table->timestamps();
        });   

    // Reset auto-increment value to 1 if table is empty
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};

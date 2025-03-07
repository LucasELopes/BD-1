<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('aplicacoes', function (Blueprint $table){

            $table->string('cpfMorador', 11);
            $table->string('idVacina', 15);
            $table->string('idLote', 15);
            $table->date('dataAplicacao');
            $table->integer('doseAplicada');
            $table->foreign('cpfMorador')->references('cpfMorador')->on('moradores')->onDelete('restrict');

            $table->foreign(['idLote', 'idVacina'])->references(['idLote', 'idVacina'])->on('lotes')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aplicacoes');
    }
};

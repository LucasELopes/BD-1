<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('aplicacoes', function (Blueprint $table){

            $table->id();
            $table->string('cpfMorador', 11);
            $table->string('idVacina', 15);
            $table->string('idLote', 15);
            $table->date('dataAplicacao');
            $table->integer('doseAplicada');

            $table->foreign('cpfMorador')->references('cpfMorador')->on('moradores')->onDelete('restrict');
            $table->foreign('idVacina')->references('idVacina')->on('vacinas')->onDelete('restrict');
            $table->foreign('idLote')->references('idLote')->on('lotes')->onDelete('restrict');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aplicacoes');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('aplicacoes', function (Blueprint $table){

            $table->char('cpfMorador', 11);
            $table->char('idVacina', 6);
            $table->char('idLote', 6);
            $table->date('dataAplicacao');
            $table->integer('doseAplicada');
            $table->string('funcionarioAplicador', 100);

            // Chaves primárias
            $table->primary(['cpfMorador', 'idVacina', 'idLote']);

            // Chaves estrangeiras
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('lote', function (Blueprint $table){

        $table->char('idLote', 6);
        $table->char('idVacina', 6);
        $table->date('dataEntrada');
        $table->integer('qtdOriginal');
        $table->integer('qtdDisponivel');
        $table->string('statusVencimento', 50);
        $table->date('validade');

        // Chave estrangeira
        $table->foreign('idVacina')->references('idVacina')->on('vacina')->onDelete('cascade');
        // usar onDelete restrict aqui??

        // Chave primária
        $table->primary('idLote');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lote');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('lotes', function (Blueprint $table){

            $table->char('idLote', 6);
            $table->char('idVacina', 6);
            $table->integer('qtdRecebida');
            $table->integer('qtdDisponivel');
            $table->date('validade');

            $table->foreign('idVacina')->references('idVacina')->on('vacinas')->onDelete('restrict');

            $table->primary(['idLote', 'idVacina']);
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lotes');
    }
};

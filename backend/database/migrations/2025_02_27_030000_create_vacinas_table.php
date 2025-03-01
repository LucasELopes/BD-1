<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('vacinas', function (Blueprint $table){

            $table->char('idVacina', 6);
            $table->string('fabricante', 100);
            $table->string('nomeVacina', 100);
            $table->integer('qtdDoses');

            // Chave primária
            $table->primary('idVacina');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('vacinas');
    }
};

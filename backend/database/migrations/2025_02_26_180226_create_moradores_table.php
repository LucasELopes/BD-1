<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('moradores', function (Blueprint $table){

            $table->char('cpfMorador', 11);
            $table->char('nmrSUS', 15);
            $table->string('nomeMorador', 100);
            $table->string('nomeMae', 100);
            $table->date('dataNascimento');
            $table->char('sexo', 1);
            $table->text('endereco');
            $table->string('estadoCivil', 20);
            $table->string('escolaridade', 50);
            $table->string('etnia', 50);
            $table->boolean('planoSaude')->default(false);

            // Chave primária
            $table->primary('cpfMorador');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moradores');
    }
};

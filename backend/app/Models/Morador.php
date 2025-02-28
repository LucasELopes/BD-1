<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Morador extends Model
{
    /** @use HasFactory<\Database\Factories\MoradorFactory> */
    use HasFactory;

    protected $table = "moradores";
    protected $primaryKey = 'cpfMorador';
    
    protected $fillable = [
        "cpfMorador",
        "nmrSUS",
        "nomeMorador",
        "nomeMae",
        "dataNascimento",
        "sexo",
        "endereco",
        "estadoCivil",
        "escolaridade",
        "etnia",
        "planoSaude"
    ];

}

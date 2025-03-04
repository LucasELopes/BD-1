<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacina extends Model
{
    /** @use HasFactory<\Database\Factories\VacinaFactory> */
    use HasFactory;

    protected $primaryKey = "idVacina";
    public $incrementing = false;

    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        "idVacina",
        "fabricante",
        "nomeVacina",
        "qtdDoses"
    ];

    public function lotes() {
        return $this->hasMany(Lote::class, 'idVacina', 'idVacina');
    }

}

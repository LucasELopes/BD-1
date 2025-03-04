<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    /** @use HasFactory<\Database\Factories\LoteFactory> */
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;

    public $keyType = "string";

    protected $primaryKey = "idLote";

    protected $fillable = [
        "idLote",
        "idVacina",
        "qtdRecebida",
        "qtdDisponivel",
        "validade"
    ];

    public function vacina() {
        return $this->belongsTo(Vacina::class, "idVacina", "idVacina");
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplicacao extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'aplicacoes';
    protected $keytype = 'string';
    protected $primaryKey = 'cpfMorador';
    public $incrementing = false;

    protected $fillable = [
        'cpfMorador',
        'idVacina',
        'idLote',
        'dataAplicacao',
        'doseAplicada',
    ];

    public function morador(){
        return $this->belongsTo(Morador::class, 'cpfMorador', 'cpfMorador');
    }

    public function vacina() {
        return $this->belongsTo(Vacina::class, 'idVacina', 'idVacina');
    }

    public function lote() {
        return $this->belongsTo(Lote::class, 'idLote', 'idLote');
    }
}





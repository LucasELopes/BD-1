<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplicacao extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'aplicacoes';

    // protected $keytype = 'int';
    // protected $primaryKey = 'id';
    // //public $incrementing = true;

    protected $fillable = [
        'id',
        'cpfMorador',
        'idVacina',
        'idLote',
        'dataAplicacao',
        'doseAplicada',
    ];

    public function morador(){
        return $this->belongsTo(Morador::class, 'cpfMorador');

    }

    public function vacina() {
        return $this->belongsTo(Vacina::class, 'idVacina');
    }

    public function lote() {
        return $this->belongsTo(Lote::class, 'idLote');
    }
}





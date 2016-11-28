<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LanzamientoCarrera extends Model
{
    use SoftDeletes;

    protected $table = 'lanzamiento_carrera';

    protected $fillable = ['mensualidad', 'matricula', 'confirmado', 'carrera_codigo', 'cronograma_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Relationships
    // 1 -> (1:N)
    public function carrera(){
        return $this->belongsTo('App\Carrera', 'carrera_codigo');
    }

    // 1 -> (1:1)
    public function cronograma(){
        return $this->belongsTo('App\Cronograma');
    }

    // Scopes
    public function scopeSearch($query, $filtro){
        return $query->join('carreras', 'lanzamiento_carrera.carrera_codigo', '=', 'carrera.codigo')->join('cronogramas', 'lanzamiento_carrera.cronograma_id', '=', 'cronogramas.id')->where('carrera_codigo', 'LIKE', "%$filtro%")->orWhere('carrera.nombre', 'LIKE', "%$filtro%")->orWhere('inicio', 'LIKE', "%$filtro%");
    }
}

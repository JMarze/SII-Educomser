<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Cronograma extends Model
{
    use SoftDeletes;

    protected $table = 'cronogramas';

    protected $fillable = ['inicio', 'duracion_clase', 'promocion', 'slider', 'tipo_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'inicio'];

    // Mutators
    public function setInicioAttribute($date){
        return $this->attributes['inicio'] = Carbon::createFromFormat('Y-m-d\TH:i', $date);
    }

    // Relationships
    // 1 -> (1:N)
    public function tipo(){
        return $this->belongsTo('App\Tipo');
    }

    // 1 -> (1:1)
    public function lanzamientoCurso(){
        return $this->hasOne('App\LanzamientoCurso');
    }
}

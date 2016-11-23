<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InscripcionCarrera extends Model
{
    use SoftDeletes;

    protected $table = 'inscripciones_carrera';

    protected $fillable = ['observaciones', 'alumno_id', 'lanzamiento_carrera_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Mutators
    public function setObservacionesAttribute($obs){
        $this->attributes['observaciones'] = (empty($obs))?null:$obs;
    }

    // Relationships
    // 1 -> (1:N)
    public function alumno(){
        return $this->belongsTo('App\Alumno');
    }

    // 1 -> (1:N)
    public function lanzamientoCarrera(){
        return $this->belongsTo('App\LanzamientoCarrera');
    }

    // N -> (N:N)
    public function modulos(){
        return $this->belongsToMany('App\Inscripcion', 'inscripciones_modulos', 'inscripcion_carrera_id', 'inscripcion_id');
    }
}

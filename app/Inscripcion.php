<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inscripcion extends Model
{
    use SoftDeletes;

    protected $table = 'inscripciones';

    protected $fillable = ['observaciones', 'modulo_carrera', 'tipo_asistencia', 'publicidad_id', 'alumno_id', 'lanzamiento_curso_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Mutators
    public function setObservacionesAttribute($obs){
        $this->attributes['observaciones'] = (empty($obs))?null:$obs;
    }

    // Relationships
    // 1 -> (1:N)
    public function publicidad(){
        return $this->belongsTo('App\Publicidad');
    }
    public function alumno(){
        return $this->belongsTo('App\Alumno');
    }
    public function lanzamientoCurso(){
        return $this->belongsTo('App\LanzamientoCurso');
    }
    public function pagos(){
        return $this->hasMany('App\Pago');
    }
    public function evaluaciones(){
        return $this->hasMany('App\Evaluacion');
    }

    // 1 -> (1:1)
    public function historial(){
        return $this->hasOne('App\Historial');
    }
}

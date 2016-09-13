<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alumno extends Model
{
    use SoftDeletes;

    protected $table = 'alumnos';

    protected $fillable = ['preinscripciones_incompletas'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Mutators
    public function setPreinscripcionesIncompletasAttribute($value){
        $this->attributes['preinscripciones_incompletas'] = (empty($value))?null:$value;
    }

    // Scopes
    public function scopeSearch($query, $filtro){
        return $query->join('personas', 'alumnos.persona_codigo', '=', 'personas.codigo')->where('personas.codigo', 'LIKE', "%$filtro%")->orWhere('personas.nombres', 'LIKE', "%$filtro%")->orWhere('personas.primer_apellido', 'LIKE', "%$filtro%")->orWhere('personas.segundo_apellido', 'LIKE', "%$filtro%");
    }

    // Relationships
    // 1 -> (1:1)
    public function persona(){
        return $this->belongsTo('App\Persona', 'persona_codigo');
    }

    // N -> (1:N)
    public function inscripciones(){
        return $this->hasMany('App\Inscripcion');
    }
}

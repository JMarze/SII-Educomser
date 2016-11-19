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
        $criterios = explode(" ", $filtro);
        switch(count($criterios)){
            case 1:
                return $query->join('personas', 'alumnos.persona_codigo', '=', 'personas.codigo')
                    ->where('personas.codigo', 'LIKE', "%$filtro%")
                    ->orWhere('personas.nombres', 'LIKE', "%$filtro%")
                    ->orWhere('personas.primer_apellido', 'LIKE', "%$filtro%")
                    ->orWhere('personas.segundo_apellido', 'LIKE', "%$filtro%");
                break;
            case 2:
                return $query->join('personas', 'alumnos.persona_codigo', '=', 'personas.codigo')
                    ->where([
                        ['personas.primer_apellido', 'LIKE', "%$criterios[0]%"],
                        ['personas.nombres', 'LIKE', "%$criterios[1]%"],
                    ])
                    ->orWhere([
                        ['personas.primer_apellido', 'LIKE', "%$criterios[0]%"],
                        ['personas.segundo_apellido', 'LIKE', "%$criterios[1]%"],
                    ]);
                break;
            case 3:
                return $query->join('personas', 'alumnos.persona_codigo', '=', 'personas.codigo')
                    ->where('personas.primer_apellido', 'LIKE', "%$criterios[0]%")
                    ->where('personas.segundo_apellido', 'LIKE', "%$criterios[1]%")
                    ->where('personas.nombres', 'LIKE', "%$criterios[2]%");
                break;
            default:
                return $query->join('personas', 'alumnos.persona_codigo', '=', 'personas.codigo')->where('personas.codigo', 'LIKE', "%$criterios[0]%")->orWhere('personas.nombres', 'LIKE', "%$criterios[0]%")->orWhere('personas.primer_apellido', 'LIKE', "%$criterios[0]%")->orWhere('personas.segundo_apellido', 'LIKE', "%$criterios[0]%");
        }
    }

    // Relationships
    // 1 -> (1:1)
    public function persona(){
        return $this->belongsTo('App\Persona', 'persona_codigo');
    }

    // N -> (1:N)
    public function inscripciones(){
        return $this->hasMany('App\Inscripcion')->orderBy('created_at', 'DESC');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Cronograma extends Model
{
    use SoftDeletes;

    protected $table = 'cronogramas';

    protected $fillable = ['tipo_id', 'curso_codigo', 'inicio_carrera', 'inicio', 'duracion_clase', 'costo', 'costo_mensual', 'matricula', 'promocion', 'slider'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'inicio'];

    // Mutators
    public function setCostoMensualAttribute($costo){
        $this->attributes['costo_mensual'] = (empty($costo))?null:$costo;
    }

    public function setMatriculaAttribute($costo){
        $this->attributes['matricula'] = (empty($costo))?null:$costo;
    }

    public function setInicioAttribute($date){
        return $this->attributes['inicio'] = Carbon::createFromFormat('Y-m-d\TH:i', $date);
    }

    // Scopes
    public function scopeSearch($query, $filtro){
        return $query->join('cursos', 'cronogramas.curso_codigo', '=', 'cursos.codigo')->where('curso_codigo', 'LIKE', "%$filtro%")->orWhere('cursos.nombre', 'LIKE', "%$filtro%")->orWhere('inicio', 'LIKE', "%$filtro%");
    }

    // Relationships
    // 1 -> (N:N)
    public function curso(){
        return $this->belongsTo('App\Curso', 'curso_codigo');
    }

    // 1 -> (N:N)
    public function tipo(){
        return $this->belongsTo('App\Tipo');
    }

    // N -> (N:N)
    public function docentes(){
        return $this->belongsToMany('App\Docente', 'cronograma_docente');
    }

    // N -> (1:N)
    public function inscripciones(){
        return $this->hasMany('App\Inscripcion');
    }
}

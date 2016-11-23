<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LanzamientoCurso extends Model
{
    use SoftDeletes;

    protected $table = 'lanzamiento_curso';

    protected $fillable = ['costo', 'docente_id', 'curso_codigo', 'cronograma_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Relationships
    // N -> (N:N)
    public function docentes(){
        return $this->belongsToMany('App\Docente', 'lanzamiento_curso_docente', 'lanzamiento_curso_id', 'docente_id');
    }

    // 1 -> (1:N)
    public function curso(){
        return $this->belongsTo('App\Curso', 'curso_codigo');
    }

    // 1 -> (1:1)
    public function cronograma(){
        return $this->belongsTo('App\Cronograma');
    }

    // 1 -> (1:N)
    public function inscritos(){
        return $this->hasMany('App\Inscripcion');
    }

    // Scopes
    public function scopeSearch($query, $filtro){
        return $query->join('cursos', 'lanzamiento_curso.curso_codigo', '=', 'cursos.codigo')->join('cronogramas', 'lanzamiento_curso.cronograma_id', '=', 'cronogramas.id')->where('curso_codigo', 'LIKE', "%$filtro%")->orWhere('cursos.nombre', 'LIKE', "%$filtro%")->orWhere('inicio', 'LIKE', "%$filtro%");
    }
}

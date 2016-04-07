<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use SoftDeletes;

    protected $table = 'cursos';
    protected $primaryKey = 'codigo';
    public $incrementing = false;

    protected $fillable = ['codigo', 'nombre', 'logo', 'color_hexa', 'costo_personalizado', 'costo_referencial', 'eslogan', 'descripcion', 'horas_academicas', 'horas_reales', 'area_id', 'dificultad_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Relationships
    // 1 -> (1:N)
    public function area(){
        return $this->belongsTo('App\Area');
    }
    public function dificultad(){
        return $this->belongsTo('App\Dificultad');
    }

    // N -> (1:N)
    public function capitulos(){
        return $this->hasMany('App\Capitulo');
    }

    // N -> (N:N)
    public function carreras(){
        return $this->belongsToMany('App\Carrera', 'carrera_curso', 'carrera_codigo', 'curso_codigo')->withPivot('orde');
    }
}

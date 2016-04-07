<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrera extends Model
{
    use SoftDeletes;

    protected $table = 'carreras';
    protected $primaryKey = 'codigo';
    public $incrementing = false;

    protected $fillable = ['codigo', 'nombre', 'logo', 'color_hexa', 'costo_mensual'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Relationships
    // N -> (N:N)
    public function cursos(){
        return $this->belongsToMany('App\Curso', 'carrera_curso', 'curso_codigo', 'carrera_codigo')->withPivot('orde');
    }
}

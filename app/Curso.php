<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Curso extends Model
{
    use SoftDeletes;

    protected $table = 'cursos';
    protected $primaryKey = 'codigo';
    public $incrementing = false;

    protected $fillable = ['codigo', 'nombre', 'logo', 'color_hexa', 'costo_personalizado', 'costo_referencial', 'eslogan', 'descripcion', 'horas_academicas', 'horas_reales', 'area_id', 'dificultad_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Scopes
    public function scopeSearch($query, $filtro){
        return $query->where('codigo', 'LIKE', "%$filtro%")->orWhere('nombre', 'LIKE', "%$filtro%");
    }

    // Mutator
    public function setLogoAttribute($ruta){
        if($ruta){
            $nombreLogo = "CUR_" . Carbon::now()->year . Carbon::now()->month . Carbon::now()->day . "_" . Carbon::now()->hour . Carbon::now()->minute . Carbon::now()->second . "." . $ruta->getClientOriginalExtension();
            $this->attributes['logo'] = $nombreLogo;
            \Storage::disk('local')->put($nombreLogo, \File::get($ruta));
        }
    }

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
        return $this->hasMany('App\Capitulo', 'curso_codigo', 'codigo');
    }

    // N -> (N:N)
    public function carreras(){
        return $this->belongsToMany('App\Carrera', 'carrera_curso', 'curso_codigo', 'carrera_codigo')->withPivot('orden', 'created_at');
    }

    // N -> (1:N)
    public function cronogramas(){
        return $this->hasMany('App\Cronograma');
    }
}

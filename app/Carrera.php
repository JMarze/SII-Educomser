<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Carrera extends Model
{
    use SoftDeletes;

    protected $table = 'carreras';
    protected $primaryKey = 'codigo';
    public $incrementing = false;

    protected $fillable = ['codigo', 'nombre', 'logo', 'color_hexa', 'costo_mensual'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Scopes
    public function scopeSearch($query, $filtro){
        return $query->where('codigo', 'LIKE', "%$filtro%")->orWhere('nombre', 'LIKE', "%$filtro%");
    }

    // Mutator
    public function setLogoAttribute($ruta){
        if($ruta){
            $nombreLogo = "CAR_" . Carbon::now()->year . Carbon::now()->month . Carbon::now()->day . "_" . Carbon::now()->hour . Carbon::now()->minute . Carbon::now()->second . "." . $ruta->getClientOriginalExtension();
            $this->attributes['logo'] = $nombreLogo;
            \Storage::disk('local')->put($nombreLogo, \File::get($ruta));
        }
    }

    // Relationships
    // N -> (N:N)
    public function cursos(){
        return $this->belongsToMany('App\Curso', 'carrera_curso', 'curso_codigo', 'carrera_codigo')->withPivot('orden');
    }
}

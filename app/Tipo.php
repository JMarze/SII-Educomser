<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipos';
    public $timestamps = false;

    protected $fillable = ['nombre', 'horas_reales'];

    // Scopes
    public function scopeSearch($query, $filtro){
        return $query->where('nombre', 'LIKE', "%$filtro%");
    }

    // Relathinships
    // N -> (1:N)
    public function cronogramas(){
        return $this->hasMany('App\Cronograma');
    }
}

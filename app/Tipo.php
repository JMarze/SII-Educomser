<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipos';
    public $timestamps = false;

    protected $fillable = ['nombre', 'horas_reales', 'mostrar_cronograma'];

    // Scopes
    public function scopeSearch($query, $filtro){
        return $query->where('nombre', 'LIKE', "%$filtro%");
    }

    // Relationships
    // N -> (1:N)
    public function cronogramas(){
        return $this->hasMany('App\Cronograma');
    }
}

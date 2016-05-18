<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dificultad extends Model
{
    protected $table = 'dificultades';
    public $timestamps = false;

    protected $fillable = ['nombre'];

    // Scopes
    public function scopeSearch($query, $filtro){
        return $query->where('nombre', 'LIKE', "%$filtro%");
    }

    // Relationships
    // N -> (1:N)
    public function cursos(){
        return $this->hasMany('App\Curso');
    }
}

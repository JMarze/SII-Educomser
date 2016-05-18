<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
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

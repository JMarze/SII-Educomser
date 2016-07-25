<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    protected $table = 'profesiones';
    public $timestamps = false;

    protected $fillable = ['titulo', 'grado_id'];

    // Scopes
    public function scopeSearch($query, $filtro){
        return $query->where('titulo', 'LIKE', "%$filtro%");
    }

    // Relationships
    // 1 -> (1:N)
    public function grado(){
        return $this->belongsTo('App\Grado');
    }

    // N -> (N:N)
    public function personas(){
        return $this->belongsToMany('App\Persona', 'persona_profesion', 'profesion_id', 'persona_codigo');
    }
}

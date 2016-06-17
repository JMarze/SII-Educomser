<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $table = 'grados';
    public $timestamps = false;

    protected $fillable = ['descripcion', 'abreviatura'];

    // Scopes
    public function scopeSearch($query, $filtro){
        return $query->where('descripcion', 'LIKE', "%$filtro%")->orWhere('abreviatura', 'LIKE', "%$filtro%");
    }

    // Relationships
    // N -> (1:N)
    public function profesiones(){
        return $this->hasMany('App\Profesion');
    }
}

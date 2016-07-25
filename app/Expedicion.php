<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expedicion extends Model
{
    protected $table = 'expediciones';
    protected $primaryKey = 'codigo';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['codigo', 'ciudad'];

    // Scopes
    public function scopeSearch($query, $filtro){
        return $query->where('ciudad', 'LIKE', "%$filtro%");
    }

    // Relationships
    // N -> (N:1)
    public function personas(){
        return $this->hasMany('App\Persona', 'expedicion_codigo', 'codigo');
    }
}

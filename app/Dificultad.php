<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dificultad extends Model
{
    protected $table = 'dificultades';
    public $timestamps = false;

    protected $fillable = ['nombre', 'nivel'];

    // Relationships
    // N -> (1:N)
    public function cursos(){
        return $this->hasMany('App\Curso');
    }
}

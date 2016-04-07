<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    public $timestamps = false;

    protected $fillable = ['nombre'];

    // Relationships
    // N -> (1:N)
    public function cursos(){
        return $this->hasMany('App\Curso');
    }
}

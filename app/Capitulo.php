<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    protected $table = 'capitulos';

    protected $fillable = ['titulo', 'curso_codigo'];

    // Relationships
    // 1 -> (1:N)
    public function curso(){
        return $this->belongsTo('App\Curso');
    }

    // N -> (1:N)
    public function topicos(){
        return $this->hasMany('App\Topico');
    }
}

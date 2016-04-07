<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topico extends Model
{
    protected $table = 'topicos';

    protected $fillable = ['subtitulo', 'archivo_url', 'archivo_tipo', 'capitulo_id'];

    // Relationships
    // 1 -> (1:N)
    public function capitulo(){
        return $this->belongsTo('App\Capitulo');
    }
}

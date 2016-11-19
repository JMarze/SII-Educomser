<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicidad extends Model
{
    protected $table = 'publicidades';
    public $timestamps = false;

    protected $fillable = ['descripcion'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    protected $table = 'conceptos';
    public $timestamps = false;

    protected $fillable = ['descripcion'];

    // Relationships
    // 1 -> (1:N)
    public function pagos(){
        return $this->hasMany('App\Pago');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inscripcion extends Model
{
    use SoftDeletes;

    protected $table = 'inscripciones';

    protected $fillable = ['observacion', 'alumno_id', 'cronograma_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Mutators
    public function setObservacionAttribute($obs){
        $this->attributes['observacion'] = (empty($obs))?null:$obs;
    }

    // Relationships
    // 1 -> (1:N)
    public function alumno(){
        return $this->belongsTo('App\Alumno');
    }

    // 1 -> (1:N)
    public function cronograma(){
        return $this->belongsTo('App\Cronograma');
    }

    // 1 -> (1:N)
    public function pagos(){
        return $this->hasMany('App\Pago');
    }
}

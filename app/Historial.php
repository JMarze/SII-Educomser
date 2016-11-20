<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Historial extends Model
{
    use SoftDeletes;

    protected $table = 'historiales';

    protected $fillable = ['fecha_finalizacion', 'nota', 'certificado', 'observaciones', 'inscripcion_id'];

    protected $dates = ['fecha_finalizacion', 'created_at', 'updated_at', 'deleted_at'];

    // Mutators
    public function setObservacionesAttribute($obs){
        $this->attributes['observaciones'] = (empty($obs))?null:$obs;
    }

    // Relationships
    // 1 -> (1:1)
    public function inscripcion(){
        return $this->belongsTo('App\Inscripcion');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    use SoftDeletes;

    protected $table = 'pagos';

    protected $fillable = ['monto', 'observacion', 'numero_factura', 'concepto_id', 'inscripcion_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Relationships
    // N -> (1:N)
    public function inscripcion(){
        return $this->belongsTo('App\Inscripcion');
    }

    // N -> (1:N)
    public function concepto(){
        return $this->belongsTo('App\Concepto');
    }
}

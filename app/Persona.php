<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Persona extends Model
{
    use SoftDeletes;

    protected $table = 'personas';
    protected $primaryKey = 'codigo';
    public $incrementing = false;

    protected $fillable = ['codigo', 'primer_apellido', 'segundo_apellido', 'nombres', 'email', 'fecha_nacimiento', 'numero_ci', 'genero', 'direccion', 'telefono_1', 'telefono_2', 'expedicion_codigo'];

    protected $dates = ['fecha_nacimiento', 'created_at', 'updated_at', 'deleted_at'];

    // Mutators
    public function setPrimerApellidoAttribute($value){
        $this->attributes['primer_apellido'] = (empty($value))?'-':$value;
    }

    public function setSegundoApellidoAttribute($value){
        $this->attributes['segundo_apellido'] = (empty($value))?'-':$value;
    }

    public function setEmailAttribute($value){
        $this->attributes['email'] = (empty($value))?null:$value;
    }

    public function setFechaNacimientoAttribute($value){
        $this->attributes['fecha_nacimiento'] = (empty($value))?Carbon::now():$value;
    }

    public function setNumeroCiAttribute($value){
        $this->attributes['numero_ci'] = (empty($value))?null:$value;
    }

    public function setDireccionAttribute($value){
        $this->attributes['direccion'] = (empty($value))?null:$value;
    }

    public function setTelefono1Attribute($value){
        $this->attributes['telefono_1'] = (empty($value))?null:$value;
    }

    public function setTelefono2Attribute($value){
        $this->attributes['telefono_2'] = (empty($value))?null:$value;
    }

    // Relationships
    // 1 -> (N:1)
    public function expedicion(){
        return $this->belongsTo('App\Expedicion', 'expedicion_codigo', 'codigo');
    }

    // Relationships
    // 1 -> (1:1)
    public function docente(){
        return $this->hasOne('App\Docente', 'persona_codigo', 'codigo');
    }
}

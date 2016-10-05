<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Docente extends Model
{
    use SoftDeletes;

    protected $table = 'docentes';

    protected $fillable = ['biografia', 'email_institucional', 'vigente', 'social_facebook', 'social_twitter', 'social_googleplus', 'social_youtube', 'social_linkedin', 'social_website', 'persona_codigo'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Mutators
    public function setEmailInstitucionalAttribute($value){
        $this->attributes['email_institucional'] = (empty($value))?null:$value;
    }

    public function setSocialFacebookAttribute($value){
        $this->attributes['social_facebook'] = (empty($value))?null:$value;
    }

    public function setSocialTwitterAttribute($value){
        $this->attributes['social_twitter'] = (empty($value))?null:$value;
    }

    public function setSocialGoogleplusAttribute($value){
        $this->attributes['social_googleplus'] = (empty($value))?null:$value;
    }

    public function setSocialYoutubeAttribute($value){
        $this->attributes['social_youtube'] = (empty($value))?null:$value;
    }

    public function setSocialLinkedinAttribute($value){
        $this->attributes['social_linkedin'] = (empty($value))?null:$value;
    }

    public function setSocialWebsiteAttribute($value){
        $this->attributes['social_website'] = (empty($value))?null:$value;
    }

    // Scopes
    public function scopeSearch($query, $filtro){
        return $query->join('personas', 'docentes.persona_codigo', '=', 'personas.codigo')->where('personas.codigo', 'LIKE', "%$filtro%")->orWhere('personas.nombres', 'LIKE', "%$filtro%")->orWhere('personas.primer_apellido', 'LIKE', "%$filtro%")->orWhere('personas.segundo_apellido', 'LIKE', "%$filtro%");
    }

    // Relationships
    // 1 -> (1:1)
    public function persona(){
        return $this->belongsTo('App\Persona', 'persona_codigo');
    }

    // N -> (N:N)
    public function lanzamientosCurso(){
        return $this->belongsToMany('App\LanzamientoCurso', 'lanzamiento_curso_docente', 'docente_id', 'lanzamiento_curso_id');
    }
}

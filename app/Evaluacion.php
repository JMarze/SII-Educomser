<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table = 'cursos';

    protected $fillable = ['clase_entendible_clara', 'curso_docente', 'falta_docente', 'practicas', 'pregunta_docente', 'falta_curso', 'informacion_proporcionada', 'observaciones', 'inscripcion_id'];

    protected $dates = ['created_at'];

    // Relationships
    // N -> (1:N)
    public function inscripcion(){
        return $this->belongsTo('App\Inscripcion');
    }
}

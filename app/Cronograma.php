<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Cronograma extends Model
{
    use SoftDeletes;

    protected $table = 'cronogramas';

    protected $fillable = ['docente_id', 'tipo_id', 'curso_codigo'];
}

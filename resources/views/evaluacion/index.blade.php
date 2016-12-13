@extends('layouts.frontend')

@section('title', 'Educomser SRL - Evaluación')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="margin-top: 20px;">
                <div class="panel-heading" style="font-size: x-large; font-weight: bold; text-align: center; padding: 20px 0;">Evaluación de Curso</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="#">
                        {!! csrf_field() !!}

                        <div class="form-group text-right">
                            <strong class="col-md-4">Curso:</strong>
                            <span class="col-md-6">{{ $inscripcion->lanzamientoCurso->curso->nombre }}</span>
                        </div>

                        <div class="form-group text-right">
                            <strong class="col-md-4">Docente:</strong>
                            <span class="col-md-6">
                                @foreach($inscripcion->lanzamientoCurso->docentes as $docente)
                                {{ $docente->persona->primer_apellido }} {{ $docente->persona->segundo_apellido }} {{ $docente->persona->nombres }}
                                @endforeach
                            </span>
                        </div>

                        <div class="form-group text-right">
                            <strong class="col-md-4">Alumno:</strong>
                            <span class="col-md-6">
                                {{ $inscripcion->alumno->persona->primer_apellido }} {{ $inscripcion->alumno->persona->segundo_apellido }} {{ $inscripcion->alumno->persona->nombres }}
                            </span>
                        </div>

                        <div class="form-group{{ $errors->has('clase_entendible_clara') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">¿Cree que las clases son entendibles y claras?</label>

                            <div class="col-md-6">
                                {!! Form::select('clase_entendible_clara', ['Si' => 'Si', 'No' => 'No', 'Mas o Menos' => 'Mas o Menos'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opción', 'style' => 'width:100%;']) !!}

                                @if ($errors->has('clase_entendible_clara'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('clase_entendible_clara') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('curso_docente') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">¿Cómo califica al curso y/o docente?</label>

                            <div class="col-md-6">
                                {!! Form::select('curso_docente', ['Excelente' => 'Excelente', 'Muy Bueno' => 'Muy Bueno', 'Bueno' => 'Bueno', 'Regular' => 'Regular', 'Malo' => 'Malo'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opción', 'style' => 'width:100%;']) !!}

                                @if ($errors->has('curso_docente'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('curso_docente') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('falta_docente') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">¿Que cree que le falta a la exposición del docente?</label>

                            <div class="col-md-6">
                                {!! Form::select('falta_docente', ['Claridad' => 'Claridad', 'Orden' => 'Orden', 'Dominio' => 'Dominio', 'Paciencia' => 'Paciencia', 'Ninguno' => 'Ninguno'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opción', 'style' => 'width:100%;']) !!}

                                @if ($errors->has('falta_docente'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('falta_docente') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('practicas') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Las prácticas realizadas son:</label>

                            <div class="col-md-6">
                                {!! Form::select('practicas', ['Adecuadas' => 'Adecuadas', 'Difíciles' => 'Difíciles', 'No Aplicables' => 'No Aplicables'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opción', 'style' => 'width:100%;']) !!}

                                @if ($errors->has('practicas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('practicas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pregunta_docente') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Cuando usted realiza una pregunta al docente:</label>

                            <div class="col-md-6">
                                {!! Form::select('pregunta_docente', ['Aclara la duda' => 'Aclara la duda', 'Lo confunde' => 'Lo confunde', 'No le responde' => 'No le responde'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opción', 'style' => 'width:100%;']) !!}

                                @if ($errors->has('pregunta_docente'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pregunta_docente') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('falta_curso') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">¿Qué cree que le falta al curso para que cubra todas sus expectativas?</label>

                            <div class="col-md-6">
                                {!! Form::select('falta_curso', ['Práctica' => 'Práctica', 'Teoría' => 'Teoría', 'Más tiempo' => 'Más tiempo'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opción', 'style' => 'width:100%;']) !!}

                                @if ($errors->has('falta_curso'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('falta_curso') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('informacion_proporcionada') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">¿Cómo califica la atención e información proporcionada?</label>

                            <div class="col-md-6">
                                {!! Form::select('informacion_proporcionada', ['Excelente' => 'Excelente', 'Muy Bueno' => 'Muy Bueno', 'Bueno' => 'Bueno', 'Regular' => 'Regular', 'Malo' => 'Malo'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opción', 'style' => 'width:100%;']) !!}

                                @if ($errors->has('informacion_proporcionada'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('informacion_proporcionada') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>&nbsp;&nbsp;&nbsp;Registrar Evaluación
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

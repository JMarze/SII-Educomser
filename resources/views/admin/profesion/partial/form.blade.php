<div class="form-group wrapper-grado_id">
    {!! Form::label('grado_id', 'Grado académico', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::select('grado_id', [], null, ['class' => 'form-control', 'placeholder' => 'Seleccione grado académico']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-titulo">
    {!! Form::label('titulo', 'Título', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('titulo', null, ['class' => 'form-control', 'placeholder' => 'Ej. Sistemas']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

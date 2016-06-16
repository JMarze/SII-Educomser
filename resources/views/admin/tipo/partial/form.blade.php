<div class="form-group wrapper-nombre">
    {!! Form::label('nombre', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ej. Sábados']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-horas_reales">
    {!! Form::label('horas_reales', 'Horas Reales', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::number('horas_reales', null, ['class' => 'form-control', 'placeholder' => 'Ej. 30', 'min' => '1', 'step' => '0.5']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-mostrar_cronograma">
    {!! Form::label('mostrar_cronograma', '¿Mostrar en Cronograma?', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::select('mostrar_cronograma', [true => 'Sí', false => 'No'], true, ['class' => 'form-control']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

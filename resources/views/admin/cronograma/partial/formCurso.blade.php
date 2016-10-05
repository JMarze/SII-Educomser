<div class="form-group wrapper-tipo_id">
    {!! Form::label('tipo_id', 'Tipo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::select('tipo_id', [], null, ['class' => 'form-control', 'placeholder' => 'Seleccione tipo']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-curso_codigo">
    {!! Form::label('curso_codigo', 'Curso', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::select('curso_codigo', [], null, ['class' => 'form-control', 'placeholder' => 'Seleccione curso', 'style' => 'width:100%;']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-inicio">
    {!! Form::label('inicio', 'Fecha y hora de Inicio', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::input('datetime-local', 'inicio', null, ['class' => 'form-control', 'placeholder' => 'Ej. dd/mm/yyyy hh:MM:ss']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-duracion_clase">
    {!! Form::label('duracion_clase', 'Duración de la clase', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::number('duracion_clase', null, ['class' => 'form-control', 'placeholder' => 'Ej. 1.5', 'min' => '1', 'step' => '0.5']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-costo">
    {!! Form::label('costo', 'Costo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::number('costo', null, ['class' => 'form-control', 'placeholder' => 'Ej. 300', 'min' => '1', 'step' => '0.5']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-promocion">
    {!! Form::label('promocion', '¿Promoción?', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::select('promocion', [1 => 'Sí', 0 => 'No'], 0, ['class' => 'form-control']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-slider">
    {!! Form::label('slider', '¿Mostrar en la página principal?', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::select('slider', [1 => 'Sí', 0 => 'No'], 0, ['class' => 'form-control']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

@section('script')
@parent
<script>
</script>
@endsection

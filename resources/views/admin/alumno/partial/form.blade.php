<div class="form-group wrapper-primer_apellido">
    {!! Form::label('primer_apellido', 'Primer apellido', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('primer_apellido', null, ['class' => 'form-control', 'placeholder' => 'Ej. Arze']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-segundo_apellido">
    {!! Form::label('segundo_apellido', 'Segundo apellido', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('segundo_apellido', null, ['class' => 'form-control', 'placeholder' => 'Ej. Pinto']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-nombres">
    {!! Form::label('nombres', 'Nombres', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('nombres', null, ['class' => 'form-control', 'placeholder' => 'Ej. Jesus Marcelo']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-email">
    {!! Form::label('email', 'Correo electrónico personal', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Ej. arze.jesus@gmail.com']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-fecha_nacimiento">
    {!! Form::label('fecha_nacimiento', 'Fecha de Nacimiento', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::date('fecha_nacimiento', null, ['class' => 'form-control', 'placeholder' => 'Ej. 1988-01-22']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-codigo">
    {!! Form::label('codigo', 'Código', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('codigo', null, ['class' => 'form-control', 'placeholder' => 'Ej. APJ-220188']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-numero_ci">
    {!! Form::label('numero_ci', 'Número de CI', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('numero_ci', null, ['class' => 'form-control', 'placeholder' => 'Ej. 4760961']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-expedicion_codigo">
    {!! Form::label('expedicion_codigo', 'Expedición de CI', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::select('expedicion_codigo', [], null, ['class' => 'form-control', 'placeholder' => 'Seleccione expedición de CI']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-genero">
    {!! Form::label('genero', 'Género', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::select('genero', ['femenino' => 'Femenino', 'masculino' => 'Masculino'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione género']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-direccion">
    {!! Form::label('direccion', 'Dirección', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::textarea('direccion', null, ['class' => 'form-control', 'placeholder' => 'Ej. Villa Adela, Calle K, número 114 ...']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-telefono_1">
    {!! Form::label('telefono_1', 'Número de teléfono personal', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('telefono_1', null, ['class' => 'form-control', 'placeholder' => 'Ej. 70615285']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-telefono_2">
    {!! Form::label('telefono_2', 'Número de teléfono de referencia', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('telefono_2', null, ['class' => 'form-control', 'placeholder' => 'Ej. 2830653']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

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

<div class="form-group wrapper-biografia">
    {!! Form::label('biografia', 'Biografía profesional', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::textarea('biografia', null, ['class' => 'form-control', 'placeholder' => 'Ej. Lic. en Informática ...']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-email_institucional">
    {!! Form::label('email_institucional', 'Correo electrónico institucional', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::email('email_institucional', null, ['class' => 'form-control', 'placeholder' => 'Ej. marze@educomser.com']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-social_facebook">
    {!! Form::label('social_facebook', 'Facebook', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('social_facebook', null, ['class' => 'form-control', 'placeholder' => 'Ej. facebook.com']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-social_twitter">
    {!! Form::label('social_twitter', 'Twitter', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('social_twitter', null, ['class' => 'form-control', 'placeholder' => 'Ej. twitter.com']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-social_googleplus">
    {!! Form::label('social_googleplus', 'Google +', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('social_googleplus', null, ['class' => 'form-control', 'placeholder' => 'Ej. google.com']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-social_youtube">
    {!! Form::label('social_youtube', 'YouTube', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('social_youtube', null, ['class' => 'form-control', 'placeholder' => 'Ej. youtube.com']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-social_linkedin">
    {!! Form::label('social_linkedin', 'LinkedIn', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('social_linkedin', null, ['class' => 'form-control', 'placeholder' => 'Ej. linkedin.com']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-social_website">
    {!! Form::label('social_website', 'Sitio Web Personal', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('social_website', null, ['class' => 'form-control', 'placeholder' => 'Ej. personal.me']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

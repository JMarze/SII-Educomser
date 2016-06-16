<div class="form-group wrapper-descripcion">
    {!! Form::label('descripcion', 'Descripcion', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Ej. Licenciado']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-abreviatura">
    {!! Form::label('abreviatura', 'Abreviatura', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('abreviatura', null, ['class' => 'form-control', 'placeholder' => 'Ej. Lic.']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-codigo">
    {!! Form::label('codigo', 'Código', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('codigo', null, ['class' => 'form-control', 'placeholder' => 'Ej. CAR-TECNET']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-nombre">
    {!! Form::label('nombre', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ej. Tecnología .Net']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-color_hexa">
    {!! Form::label('color_hexa', 'Color', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('color_hexa', null, ['class' => 'form-control', 'placeholder' => 'Ej. #682079']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-costo_mensual">
    {!! Form::label('costo_mensual', 'Costo mensual', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::number('costo_mensual', null, ['class' => 'form-control', 'placeholder' => 'Ej. 300', 'min' => '1', 'step' => '0.5']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

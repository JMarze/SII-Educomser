<div class="form-group wrapper-codigo">
    {!! Form::label('codigo', 'Código', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('codigo', null, ['class' => 'form-control', 'placeholder' => 'Ej. CUR-VBNET']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-nombre">
    {!! Form::label('nombre', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ej. Visual Basic .Net']) !!}
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

<div class="form-group wrapper-costo_personalizado">
    {!! Form::label('costo_personalizado', 'Costo personalizado', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::number('costo_personalizado', null, ['class' => 'form-control', 'placeholder' => 'Ej. 300', 'min' => '1', 'step' => '0.5']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-costo_referencial">
    {!! Form::label('costo_referencial', 'Costo referencial', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::number('costo_referencial', null, ['class' => 'form-control', 'placeholder' => 'Ej. 300', 'min' => '1', 'step' => '0.5']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-esloga">
    {!! Form::label('eslogan', 'Eslogan', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::text('eslogan', null, ['class' => 'form-control', 'placeholder' => 'Ej. Visual Basic hoy con el poder .Net']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-descripcion">
    {!! Form::label('descripcion', 'Descripción', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Ej. Visual Basic no es un lenguaje obsoleto, hoy cuenta con el poder de la tecnología .Net ...']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-vigente">
    {!! Form::label('vigente', '¿Vigente?', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::select('vigente', ['1' => 'Si', '0' => 'No'], '1', ['class' => 'form-control']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-horas_academicas">
    {!! Form::label('horas_academicas', 'Horas Académicas', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::number('horas_academicas', null, ['class' => 'form-control', 'placeholder' => 'Ej. 30', 'min' => '1', 'step' => '0.5']) !!}
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

<div class="form-group wrapper-area_id">
    {!! Form::label('area_id', 'Área', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::select('area_id', [], null, ['class' => 'form-control', 'placeholder' => 'Seleccione área']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

<div class="form-group wrapper-dificultad_id">
    {!! Form::label('dificultad_id', 'Dificultad', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
    {!! Form::select('dificultad_id', [], null, ['class' => 'form-control', 'placeholder' => 'Seleccione dificultad']) !!}
    <span class="help-block">
        <strong></strong>
    </span>
    </div>
</div>

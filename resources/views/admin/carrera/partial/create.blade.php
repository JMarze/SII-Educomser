<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="Agregar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Agregar">Agregar Carrera</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'form', 'class' => 'form-horizontal']) !!}

                <div class="form-group">
                    {!! Form::label('codigo', 'Código', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::text('codigo', null, ['class' => 'form-control', 'placeholder' => 'Ej. CAR-TECNET']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ej. Tecnología .Net']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('logo', 'Logo', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::file('logo', ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('color_hexa', 'Color', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::text('color_hexa', null, ['class' => 'form-control', 'placeholder' => 'Ej. #682079']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('costo_mensual', 'Costo mensual', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::number('costo_mensual', null, ['class' => 'form-control', 'placeholder' => 'Ej. 300', 'min' => '1', 'step' => '0.5']) !!}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button id="btn-agregar" type="button" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</div>

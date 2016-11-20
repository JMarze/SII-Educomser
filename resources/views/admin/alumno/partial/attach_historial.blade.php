<div class="modal fade" id="attach_historial" role="dialog" aria-labelledby="Finalizar Curso">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Finalizar Curso">
                    <i class="fa fa-btn fa-check"></i>Finalizar Curso
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-attach-historial">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.alumno.postattachhistorial', 'IDINSCRIPCION'], 'method' => 'PUT', 'id' => 'form-postattachhistorial', 'class' => 'form-horizontal']) !!}

                <div class="form-group wrapper-fecha_finalizacion">
                    {!! Form::label('fecha_finalizacion', 'Fecha de finalizacion', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::date('fecha_finalizacion', null, ['class' => 'form-control', 'placeholder' => 'Ej. 2016-01-31']) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="form-group wrapper-nota">
                    {!! Form::label('nota', 'Nota', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::number('nota', null, ['class' => 'form-control', 'placeholder' => 'Ej. 71', 'min' => '0', 'step' => '10']) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="form-group wrapper-certificado">
                    {!! Form::label('certificado', '¿Extender certificado?', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::select('certificado', ['1' => 'Si', '0' => 'No'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opción']) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="form-group wrapper-observaciones">
                    {!! Form::label('observaciones', 'Observaciones', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'placeholder' => 'Dejar en blanco si es necesario ...', 'rows' => 5]) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-btn fa-close"></i>Cancelar
                </button>
                <button id="btn-attachhistorial" type="button" class="btn btn-default">
                    <i class="fa fa-btn fa-save"></i>Finalizar
                </button>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script>
    // Reset Form
    $('.modal#attach_historial').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#attach_historial').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });

    // Crear
    var formHistorial = $('#form-postattachhistorial');
    $(document).on('click', '#btn-attachhistorial', function(){
        var url = formHistorial.attr('action').split('/');
        url[url.length-2] = formHistorial.attr('data-id');
        url = url.join("/");
        var data = formHistorial.serialize();
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data: data
        }).done (function (response){
            location.reload();
        }).fail (function (response){
            validation(response);
        });
    });
</script>
@endsection

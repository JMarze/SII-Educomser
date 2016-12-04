<div class="modal fade" id="attach_curso_personalizado" role="dialog" aria-labelledby="Inscribir a Curso Personalizado">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Inscribir a Curso Personalizado">
                    <i class="fa fa-btn fa-cube"></i>Inscribir a Curso (Libre o Personalizado)
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-attach-personalizado">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.alumno.postattachcursopersonalizado', 'CODIGOPERSONA'], 'method' => 'PUT', 'id' => 'form-postattachcursopersonalizado', 'class' => 'form-horizontal']) !!}

                <div class="form-group wrapper-curso_codigo">
                    {!! Form::label('curso_codigo', 'Cursos disponibles', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::select('curso_codigo', [], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un Curso', 'style' => 'width:100%;']) !!}
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

                <div class="form-group wrapper-publicidad_id">
                    {!! Form::label('publicidad_id', '¿Cómo se enteró del curso?', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::select('publicidad_id', [], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opción', 'style' => 'width:100%;']) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="form-group wrapper-tipo_asistencia">
                    {!! Form::label('tipo_asistencia', 'Modo de control de asistencia', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::select('tipo_asistencia', ['hoja' => 'Imprimir hoja para firmar', 'qr' => 'Lectura de código QR'], 'hoja', ['class' => 'form-control', 'placeholder' => 'Seleccione asistencia', 'style' => 'width:100%;']) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="form-group wrapper-tipo_id">
                    {!! Form::label('tipo_id', 'Tipo', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::select('tipo_id', [], null, ['class' => 'form-control', 'placeholder' => 'Seleccione tipo', 'style' => 'width:100%;']) !!}
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
                <button id="btn-attachcursopersonalizado" type="button" class="btn btn-default">
                    <i class="fa fa-btn fa-save"></i>Inscribir
                </button>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script>
    // Reset Form
    $('.modal#attach_curso_personalizado').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#attach_curso_personalizado').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });

    // Select2
    $('select[name="curso_codigo"]').select2({
        placeholder: "Seleccione un Curso",
        language: {
             noResults: function(term) {
                 return "Sin coincidencias...";
            }
        },
        allowClear: true
    });

    $('select[name="publicidad_id"]').select2({
        placeholder: "Seleccione una opción",
        language: {
             noResults: function(term) {
                 return "Sin coincidencias...";
            }
        },
        allowClear: true
    });

    // Crear
    var formInscribirPersonalizado = $('#form-postattachcursopersonalizado');
    $(document).on('click', '#btn-attachcursopersonalizado', function(){
        var url = formInscribirPersonalizado.attr('action').split('/');
        url[url.length-2] = formInscribirPersonalizado.attr('data-id');
        url = url.join("/");
        var data = formInscribirPersonalizado.serialize();
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

    // Mostrar Curso
    $(document).on('change', '#curso_codigo', function(){
        $('#curso_codigo').siblings('.help-block').html($('#curso_codigo option:selected').text());
        $('#costo').val($('#curso_codigo option:selected').text().split(' - Bs ')[1]);
    });
</script>
@endsection

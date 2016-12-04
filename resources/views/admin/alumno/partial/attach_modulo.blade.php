<div class="modal fade" id="attach_modulo" role="dialog" aria-labelledby="Inscribir a Módulo de Carrera">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Inscribir a Módulo de Carrera">
                    <i class="fa fa-btn fa-calendar"></i>Inscribir a Módulo de Carrera (Curso - Cronograma)
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-attach-modulo">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.alumno.postattachmodulo', 'CODIGOPERSONA', 'IDLANZAMIENTOCARRERA'], 'method' => 'PUT', 'id' => 'form-postattachmodulo', 'class' => 'form-horizontal']) !!}

                <div class="form-group wrapper-modulo_id">
                    {!! Form::label('modulo_id', 'Cursos disponibles en Cronograma', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::select('modulo_id', [], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un Curso', 'style' => 'width:100%;']) !!}
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
                <button id="btn-attachmodulo" type="button" class="btn btn-default">
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
    $('.modal#attach_modulo').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#attach_modulo').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });

    // Select2
    $('select[name="modulo_id"]').select2({
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
    var formInscribirModulo = $('#form-postattachmodulo');
    $(document).on('click', '#btn-attachmodulo', function(){
        var url = formInscribirModulo.attr('action').split('/');
        url[url.length-3] = formInscribirModulo.attr('data-id');
        url[url.length-1] = formInscribirModulo.attr('data-lanzamiento');
        url = url.join("/");
        var data = formInscribirModulo.serialize();
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
    $(document).on('change', '#modulo_id', function(){
        $('#modulo_id').siblings('.help-block').html($('#modulo_id option:selected').text());
    });
</script>
@endsection

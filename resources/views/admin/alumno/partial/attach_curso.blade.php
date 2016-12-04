<div class="modal fade" id="attach_curso" role="dialog" aria-labelledby="Inscribir a Curso">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Inscribir a Curso">
                    <i class="fa fa-btn fa-calendar"></i>Inscribir a Curso (Cronograma)
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-attach-curso">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.alumno.postattachcurso', 'CODIGOPERSONA'], 'method' => 'PUT', 'id' => 'form-postattachcurso', 'class' => 'form-horizontal']) !!}

                <div class="form-group wrapper-lanzamiento_curso_id">
                    {!! Form::label('lanzamiento_curso_id', 'Cursos disponibles en Cronograma', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::select('lanzamiento_curso_id', [], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un Curso', 'style' => 'width:100%;']) !!}
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
                <button id="btn-attachcurso" type="button" class="btn btn-default">
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
    $('.modal#attach_curso').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#attach_curso').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });

    // Select2
    $('select[name="lanzamiento_curso_id"]').select2({
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
    var formInscribir = $('#form-postattachcurso');
    $(document).on('click', '#btn-attachcurso', function(){
        var url = formInscribir.attr('action').split('/');
        url[url.length-2] = formInscribir.attr('data-id');
        url = url.join("/");
        var data = formInscribir.serialize();
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
    $(document).on('change', '#lanzamiento_curso_id', function(){
        $('#lanzamiento_curso_id').siblings('.help-block').html($('#lanzamiento_curso_id option:selected').text());
    });
</script>
@endsection

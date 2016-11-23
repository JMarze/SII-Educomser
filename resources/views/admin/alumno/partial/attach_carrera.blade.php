<div class="modal fade" id="attach_carrera" role="dialog" aria-labelledby="Inscribir a Carrera">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Inscribir a Carrera">
                    <i class="fa fa-btn fa-calendar"></i>Inscribir a Carrera (Cronograma)
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-attach-carrera">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.alumno.postattachcarrera', 'CODIGOPERSONA'], 'method' => 'PUT', 'id' => 'form-postattachcarrera', 'class' => 'form-horizontal']) !!}

                <div class="form-group wrapper-lanzamiento_carrera_id">
                    {!! Form::label('lanzamiento_carrera_id', 'Carreras disponibles en Cronograma', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::select('lanzamiento_carrera_id', [], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Carrera', 'style' => 'width:100%;']) !!}
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
                <button id="btn-attachcarrera" type="button" class="btn btn-default">
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
    $('.modal#attach_carrera').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#attach_carrera').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });

    // Select2
    $('select[name="lanzamiento_carrera_id"]').select2({
        placeholder: "Seleccione una Carrera",
        language: {
             noResults: function(term) {
                 return "Sin coincidencias...";
            }
        },
        allowClear: true
    });

    // Crear
    var formInscribirCarrera = $('#form-postattachcarrera');
    $(document).on('click', '#btn-attachcarrera', function(){
        var url = formInscribirCarrera.attr('action').split('/');
        url[url.length-2] = formInscribirCarrera.attr('data-id');
        url = url.join("/");
        var data = formInscribirCarrera.serialize();
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
    $(document).on('change', '#lanzamiento_carrera_id', function(){
        $('#lanzamiento_carrera_id').siblings('.help-block').html($('#lanzamiento_carrera_id option:selected').text());
    });
</script>
@endsection

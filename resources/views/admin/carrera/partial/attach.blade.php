<div class="modal fade" id="attach" tabindex="-1" role="dialog" aria-labelledby="Cursos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Cursos">
                    <i class="fa fa-btn fa-cube"></i>Editar Cursos de la Carrera
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-attach">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.carrera.postattach', 'IDCARRERA'], 'method' => 'PUT', 'id' => 'form-postattach', 'class' => 'form-horizontal']) !!}

                <div class="form-group">
                    {!! Form::label('curso_id', 'Cursos disponibles', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::select('curso_id[]', [], null, ['class' => 'form-control', 'placeholder' => 'Seleccione curso', 'multiple' => 'multiple', 'style' => 'width:100%;']) !!}
                    <span class="help-block">
                        <strong>Selecciona uno o varios cursos y presiona el botón agregar.</strong>
                    </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button class="btn btn-success" id="btn-listar" type="button">
                            <i class="fa fa-btn fa-cube"></i>Agregar
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12" id="cursos_orden">

                    </div>
                </div>

                {!! Form::close() !!}

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-btn fa-close"></i>Cancelar
                </button>
                <button id="btn-attach" type="button" class="btn btn-default">
                    <i class="fa fa-btn fa-save"></i>Guardar
                </button>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script>
    // Clear Form
    function clearForm(form){
        $('#cursos_orden').empty();
    }

    // Reset Form
    $('.modal#attach').on('show.bs.modal', function(e){
        clearForm($(this));
    });
    $('.modal#attach').on('hidden.bs.modal', function(e){
        clearForm($(this));
    });

    // Select2
    $('select[name="curso_id[]"]').select2({
        placeholder: "Seleccione curso",
        language: {
             noResults: function(term) {
                 return "Sin coincidencias...";
            }
        },
        allowClear: true
    });

    // Selección de Cursos
    $('button#btn-listar').on('click', function(){
        var cursos = $('select[name="curso_id[]"]').find(":selected");
        var wrapperCursos = $('#cursos_orden');
        $.each(cursos, function(key, value){
            wrapperCursos.append('<div class="form-group">' +
                       '<input name="curso_codigo[]" type="hidden" value="'+ value.value +'"/>' +
                       '<label class="col-md-8 control-label">'+ value.text +'</label>' +
                       '<div class="col-md-2">'+
                       '<input name="curso_orden[]" type="number" value="0" min="0" class="form-control"/>' +
                       '</div>' +
                       '<button type="button" class="col-md-1 close del-curso" aria-label="Close">' +
                       '<span aria-hidden="true">&times;</span>' +
                       '</button>' +
                       '</div>');
        });
    });

    // Cursos Attach
    var formAttach = $('#form-postattach');
    $(document).on('click', '#btn-attach', function(){
        var url = formAttach.attr('action').split('/');
        url[url.length-2] = formAttach.attr('data-id');
        url = url.join("/");
        var data = formAttach.serialize();
        $.ajax({
            url: url,
            method: 'PUT',
            dataType: 'JSON',
            data: data
        }).done (function (response){
            location.reload();
        }).fail (function (response){
            console.log(response);
        });
    });

    // Del Curso
    $(document).on('click', '.del-curso', function(){
        $(this).parent('.form-group').remove();
    });
</script>
@endsection

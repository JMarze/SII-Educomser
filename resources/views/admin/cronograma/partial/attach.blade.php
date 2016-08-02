<div class="modal fade" id="attach" tabindex="-1" role="dialog" aria-labelledby="Docentes">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Docentes">
                    <i class="fa fa-btn fa-user-plus"></i>Editar Docente del Cronograma
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-attach">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.cronograma.postattach', 'IDCRONOGRAMA'], 'method' => 'PUT', 'id' => 'form-postattach', 'class' => 'form-horizontal']) !!}

                <div class="form-group">
                    {!! Form::label('docente_id', 'Docentes disponibles', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::select('docente_id[]', [], null, ['class' => 'form-control', 'placeholder' => 'Seleccione docente', 'multiple' => 'multiple', 'style' => 'width:100%;']) !!}
                    <span class="help-block">
                        <strong>Selecciona uno o varios docentes y presiona el botón agregar.</strong>
                    </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button class="btn btn-success" id="btn-listar" type="button">
                            <i class="fa fa-btn fa-user-plus"></i>Agregar
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12" id="docentes_lista">

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
        $('#profesiones_lista').empty();
    }

    // Reset Form
    $('.modal#attach').on('show.bs.modal', function(e){
        clearForm($(this));
    });
    $('.modal#attach').on('hidden.bs.modal', function(e){
        clearForm($(this));
    });

    // Select2
    $('select[name="docente_id[]"]').select2({
        placeholder: "Seleccione docentes",
        language: {
             noResults: function(term) {
                 return "Sin coincidencias...";
            }
        },
        allowClear: true
    });

    // Selección de Docentes
    $('button#btn-listar').on('click', function(){
        var docentes = $('select[name="docente_id[]"]').find(":selected");
        var wrapperDocentes = $('#docentes_lista');
        $.each(docentes, function(key, value){
            wrapperDocentes.append('<div class="form-group">' +
                       '<input name="docentes_id[]" type="hidden" value="'+ value.value +'"/>' +
                       '<label class="col-md-8 control-label">'+ value.text +'</label>' +
                       '<button type="button" class="col-md-1 close del-docente" aria-label="Close">' +
                       '<span aria-hidden="true">&times;</span>' +
                       '</button>' +
                       '</div>');
        });
    });

    // Docentes Attach
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

    // Del Docente
    $(document).on('click', '.del-docente', function(){
        $(this).parent('.form-group').remove();
    });
</script>
@endsection

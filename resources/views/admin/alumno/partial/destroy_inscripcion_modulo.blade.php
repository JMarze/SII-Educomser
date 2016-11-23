<div class="modal fade" id="destroy-inscripcion-modulo" tabindex="-1" role="dialog" aria-labelledby="Eliminar Inscripción Módulo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Eliminar Inscripción Módulo">
                    <i class="fa fa-btn fa-cubes"></i>Eliminar Inscripción Módulo
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-destroy-inscripcion-modulo">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.inscripcion.destroy_modulo', 'IDINSCRIPCION', 'IDINSCRIPCIONCARRERA'], 'method' => 'DELETE', 'id' => 'form-destroy-inscripcion-modulo', 'class' => 'form-horizontal']) !!}

                <h4 id="question-destroy-inscripcion-modulo"></h4>

                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-btn fa-close"></i>Cancelar
                </button>
                <button id="btn-eliminar-inscripcion-modulo" type="button" class="btn btn-default">
                    <i class="fa fa-btn fa-trash"></i>Eliminar
                </button>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script>
    // Reset Form
    $('.modal#destroy-inscripcion-modulo').on('show.bs.modal', function(e){
        $('#question-destroy-inscripcion-modulo').html('');
    });
    $('.modal#destroy-inscripcion-modulo').on('hidden.bs.modal', function(e){
        $('#question-destroy-inscripcion-modulo').html('');
    });
    // Eliminar
    var formDestroyInscripcionModulo = $('#form-destroy-inscripcion-modulo');
    $(document).on('click', '#btn-eliminar-inscripcion-modulo', function(){
        var url = formDestroyInscripcionModulo.attr('action').split('/');
        url[url.length-3] = formDestroyInscripcionModulo.attr('data-id');
        url[url.length-1] = formDestroyInscripcionModulo.attr('data-id-carrera');
        url = url.join("/");
        var data = formDestroyInscripcionModulo.serialize();
        $.ajax({
            url: url,
            method: 'DELETE',
            dataType: 'JSON',
            data: data
        }).done (function (response){
            location.reload();
        }).fail (function (response){
            console.log(response);
        });
    });
</script>
@endsection

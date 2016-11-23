<div class="modal fade" id="destroy-inscripcion-curso" tabindex="-1" role="dialog" aria-labelledby="Eliminar Inscripción Curso">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Eliminar Inscripción Curso">
                    <i class="fa fa-btn fa-cubes"></i>Eliminar Inscripción Curso
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-destroy-inscripcion-curso">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.inscripcion.destroy_curso', 'IDINSCRIPCION'], 'method' => 'DELETE', 'id' => 'form-destroy-inscripcion-curso', 'class' => 'form-horizontal']) !!}

                <h4 id="question-destroy-inscripcion-curso"></h4>

                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-btn fa-close"></i>Cancelar
                </button>
                <button id="btn-eliminar-inscripcion-curso" type="button" class="btn btn-default">
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
    $('.modal#destroy-inscripcion-curso').on('show.bs.modal', function(e){
        $('#question-destroy-inscripcion-curso').html('');
    });
    $('.modal#destroy-inscripcion-curso').on('hidden.bs.modal', function(e){
        $('#question-destroy-inscripcion-curso').html('');
    });
    // Eliminar
    var formDestroyInscripcionCurso = $('#form-destroy-inscripcion-curso');
    $(document).on('click', '#btn-eliminar-inscripcion-curso', function(){
        var url = formDestroyInscripcionCurso.attr('action').split('/');
        url[url.length-1] = formDestroyInscripcionCurso.attr('data-id');
        url = url.join("/");
        var data = formDestroyInscripcionCurso.serialize();
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

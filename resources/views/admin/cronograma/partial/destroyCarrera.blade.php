<div class="modal fade" id="destroyCarrera" tabindex="-1" role="dialog" aria-labelledby="Eliminar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Eliminar">
                    <i class="fa fa-btn fa-calendar"></i>Eliminar Carrera de Cronograma
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-destroy">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.cronograma_carrera.destroyCarrera', 'IDLANZAMIENTOCARRERA'], 'method' => 'DELETE', 'id' => 'form-destroyCarrera', 'class' => 'form-horizontal']) !!}

                <h4 id="question-destroy"></h4>

                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-btn fa-close"></i>Cancelar
                </button>
                <button id="btn-eliminar" type="button" class="btn btn-default">
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
    $('.modal#destroyCarrera').on('show.bs.modal', function(e){
        $('#question-destroy').html('');
    });
    $('.modal#destroyCarrera').on('hidden.bs.modal', function(e){
        $('#question-destroy').html('');
    });
    // Eliminar
    var formDestroy = $('#form-destroyCarrera');
    $(document).on('click', '#btn-eliminar', function(){
        var url = formDestroy.attr('action').split('/');
        url[url.length-1] = formDestroy.attr('data-id');
        url = url.join("/");
        var data = formDestroy.serialize();
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

<div class="modal fade" id="destroy" tabindex="-1" role="dialog" aria-labelledby="Eliminar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Eliminar">
                    <i class="fa fa-btn fa-cubes"></i>Eliminar Carrera
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-destroy">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.carrera.destroy', 'IDCARRERA'], 'method' => 'DELETE', 'id' => 'form-destroy', 'class' => 'form-horizontal']) !!}

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
    $('.modal#destroy').on('show.bs.modal', function(e){
        $('#question-destroy').html('');
    });
    $('.modal#destroy').on('hidden.bs.modal', function(e){
        $('#question-destroy').html('');
    });
    // Eliminar
    var formDestroy = $('#form-destroy');
    var progressBar = $('.progress .progress-bar');
    $(document).on('click', '#btn-eliminar', function(){
        var url = formDestroy.attr('action').split('/');
        url[url.length-1] = formDestroy.data('id');
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

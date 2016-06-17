<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="Editar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Editar">
                    <i class="fa fa-btn fa-graduation-cap"></i>Editar Profesión
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-update">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.profesion.update', 'IDPROFESION'], 'method' => 'PUT', 'id' => 'form-update', 'class' => 'form-horizontal']) !!}

                @include('admin.profesion.partial.form')

                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-btn fa-close"></i>Cancelar
                </button>
                <button id="btn-editar" type="button" class="btn btn-default">
                    <i class="fa fa-btn fa-save"></i>Guardar
                </button>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script>
    // Reset Form
    $('.modal#update').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#update').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });
    // Editar
    var formUpdate = $('#form-update');
    $(document).on('click', '#btn-editar', function(){
        var url = formUpdate.attr('action').split('/');
        url[url.length-1] = formUpdate.attr('data-id');
        url = url.join("/");
        var data = formUpdate.serialize();
        $.ajax({
            url: url,
            method: 'PUT',
            dataType: 'JSON',
            data: data
        }).done (function (response){
            location.reload();
        }).fail (function (response){
            validation(response);
        });
    });
</script>
@endsection

<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="Editar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Editar">
                    <i class="fa fa-btn fa-cubes"></i>Editar Carrera
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-update">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.carrera.update', 'IDCARRERA'], 'method' => 'PUT', 'id' => 'form-update', 'class' => 'form-horizontal']) !!}

                @include('admin.carrera.partial.form')

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
    var progressBar = $('.progress .progress-bar');
    $(document).on('click', '#btn-editar', function(){
        //formUpdate.submit();
        var url = formUpdate.attr('action').split('/');
        url[url.length-1] = formUpdate.data('id');
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
    // Ajax
    /*formUpdate.ajaxForm({
        beforeSend: function (){
            progressBar.width('0%');
            progressBar.attr('aria-valuenow', '0');
            progressBar.html('0%');
        },
        uploadProgress: function (event, position, total, percentComplete){
            progressBar.width(percentComplete + '%');
            progressBar.attr('aria-valuenow', percentComplete);
            progressBar.html(percentComplete + '%');
        },
        success: function (){
            progressBar.width('100%');
            progressBar.attr('aria-valuenow', '100');
            progressBar.html('100%');
            location.reload();
        },
        complete: function (response){},
        error: function (response){
            console.log(response);
            if(response.responseJSON['codigo']){
                $('#w-codigo').addClass('has-error');
                $('#w-codigo .help-block>strong').html(response.responseJSON['codigo']);
            }else{
                $('#w-codigo').removeClass('has-error');
                $('#w-codigo .help-block>strong').html('');
            }
            if(response.responseJSON['nombre']){
                $('#w-nombre').addClass('has-error');
                $('#w-nombre .help-block>strong').html(response.responseJSON['nombre']);
            }else{
                $('#w-nombre').removeClass('has-error');
                $('#w-nombre .help-block>strong').html('');
            }
            if(response.responseJSON['logo']){
                $('#w-logo').addClass('has-error');
                $('#w-logo .help-block>strong').html(response.responseJSON['logo']);
            }else{
                $('#w-logo').removeClass('has-error');
                $('#w-logo .help-block>strong').html('');
            }
            if(response.responseJSON['color_hexa']){
                $('#w-color_hexa').addClass('has-error');
                $('#w-color_hexa .help-block>strong').html(response.responseJSON['color_hexa']);
            }else{
                $('#w-color_hexa').removeClass('has-error');
                $('#w-color_hexa .help-block>strong').html('');
            }
            if(response.responseJSON['costo_mensual']){
                $('#w-costo_mensual').addClass('has-error');
                $('#w-costo_mensual .help-block>strong').html(response.responseJSON['costo_mensual']);
            }else{
                $('#w-costo_mensual').removeClass('has-error');
                $('#w-costo_mensual .help-block>strong').html('');
            }
        }
    });*/
</script>
@endsection

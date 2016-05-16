<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="Agregar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Agregar">
                    <i class="fa fa-btn fa-cubes"></i>Agregar Carrera
                </h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['route' => 'admin.carrera.store', 'method' => 'POST', 'id' => 'form-create', 'class' => 'form-horizontal']) !!}

                @include('admin.carrera.partial.form')

                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-btn fa-close"></i>Cancelar
                </button>
                <button id="btn-agregar" type="button" class="btn btn-default">
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
    $('.modal#create').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#create').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });
    // Crear
    var formCreate = $('#form-create');
    var progressBar = $('.progress .progress-bar');
    $(document).on('click', '#btn-agregar', function(){
        //formCreate.submit();
        var url = formCreate.attr('action');
        var data = formCreate.serialize();
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data: data
        }).done (function (response){
            window.location.href = "/admin/carrera";
        }).fail (function (response){
            validation(response);
        });
    });
    // Ajax
    /*formCreate.ajaxForm({
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
            window.location.href = "/admin/carrera";
        },
        complete: function (response){},
        error: function (response){
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

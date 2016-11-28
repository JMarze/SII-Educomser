<div class="modal fade" id="upload_contenido" tabindex="-1" role="dialog" aria-labelledby="Subir Contenido">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Subir Contenido">
                    <i class="fa fa-btn fa-file-pdf-o"></i>Subir Contenido a Curso
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-upload-contenido">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.curso.uploadcontenido', 'IDCURSO'], 'method' => 'PUT', 'id' => 'form-upload-contenido', 'class' => 'form-horizontal']) !!}

                <div class="form-group">
                    <label id="contenido-success" class="col-md-4 control-label"></label>
                    <label id="contenido-nombre" class="col-md-6 control-label"></label>
                </div>

                <div class="form-group wrapper-contenido">
                    {!! Form::label('contenido', 'Contenido', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::file('contenido', ['class' => 'form-control']) !!}
                    <span class="help-block">
                        <strong></strong>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </span>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-btn fa-close"></i>Cancelar
                </button>
                <button id="btn-subir-contenido" type="button" class="btn btn-default">
                    <i class="fa fa-btn fa-upload"></i>Subir Logo
                </button>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script>
    // Reset Form
    $('.modal#upload_contenido').on('show.bs.modal', function(e){
        resetForm($(this));
        progressBar.width('0%');
        progressBar.attr('aria-valuenow', '0');
        progressBar.html('0%');
    });
    $('.modal#upload_contenido').on('hidden.bs.modal', function(e){
        resetForm($(this));
        progressBar.width('0%');
        progressBar.attr('aria-valuenow', '0');
        progressBar.html('0%');
    });
    // Subir Logo
    var formUploadContenido = $('#form-upload-contenido');
    var progressBar = $('.progress .progress-bar');
    $(document).on('click', '#btn-subir-contenido', function(){
        var url = formUploadContenido.attr('action').split('/');
        url[url.length-1] = formUploadContenido.attr('data-id');
        url = url.join("/");
        formUploadContenido.attr('action', url);
        formUploadContenido.submit();
    });
    // Ajax
    formUploadContenido.ajaxForm({
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
            if(response.responseJSON['contenido']){
                $('.wrapper-contenido').addClass('has-error');
                $('.wrapper-contenido .help-block>strong').html(response.responseJSON['contenido']);
            }else{
                $('.wrapper-contenido').removeClass('has-error');
                $('.wrapper-contenido .help-block>strong').html('');
            }
        }
    });
</script>
@endsection

<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="Subir Logo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Subir Logo">
                    <i class="fa fa-btn fa-cubes"></i>Subir Logo a Carrera
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-upload">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.carrera.upload', 'IDCARRERA'], 'method' => 'PUT', 'id' => 'form-upload', 'class' => 'form-horizontal']) !!}

                <div class="form-group">
                    <label id="logo-success" class="col-md-4 control-label"></label>
                    <label id="logo-nombre" class="col-md-6 control-label"></label>
                </div>

                <div class="form-group wrapper-logo">
                    {!! Form::label('logo', 'Logo', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::file('logo', ['class' => 'form-control']) !!}
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
                <button id="btn-subir" type="button" class="btn btn-default">
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
    $('.modal#upload').on('show.bs.modal', function(e){
        resetForm($(this));
        progressBar.width('0%');
        progressBar.attr('aria-valuenow', '0');
        progressBar.html('0%');
    });
    $('.modal#upload').on('hidden.bs.modal', function(e){
        resetForm($(this));
        progressBar.width('0%');
        progressBar.attr('aria-valuenow', '0');
        progressBar.html('0%');
    });
    // Subir Logo
    var formUpload = $('#form-upload');
    var progressBar = $('.progress .progress-bar');
    $(document).on('click', '#btn-subir', function(){
        var url = formUpload.attr('action').split('/');
        url[url.length-1] = formUpload.attr('data-id');
        url = url.join("/");
        formUpload.attr('action', url);
        formUpload.submit();
    });
    // Ajax
    formUpload.ajaxForm({
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
            if(response.responseJSON['logo']){
                $('.wrapper-logo').addClass('has-error');
                $('.wrapper-logo .help-block>strong').html(response.responseJSON['logo']);
            }else{
                $('.wrapper-logo').removeClass('has-error');
                $('.wrapper-logo .help-block>strong').html('');
            }
        }
    });
</script>
@endsection

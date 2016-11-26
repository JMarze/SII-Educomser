<div class="modal fade" id="attach_certificado" role="dialog" aria-labelledby="Extender Certificado">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Extender Certificado">
                    <i class="fa fa-btn fa-address-card"></i>Extender Certificado
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-attach-certificado">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.alumno.postattachcertificado', 'IDHISTORIAL'], 'method' => 'PUT', 'id' => 'form-postattachcertificado', 'class' => 'form-horizontal']) !!}

                <div class="form-group wrapper-certificado">
                    {!! Form::label('certificado', '¿Extender certificado?', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::select('certificado', ['1' => 'Si', '0' => 'No'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una opción']) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-btn fa-close"></i>Cancelar
                </button>
                <button id="btn-attachcertificado" type="button" class="btn btn-default">
                    <i class="fa fa-btn fa-save"></i>Extender
                </button>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script>
    // Reset Form
    $('.modal#attach_certificado').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#attach_certificado').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });

    // Crear
    var formCertificado = $('#form-postattachcertificado');
    $(document).on('click', '#btn-attachcertificado', function(){
        var url = formCertificado.attr('action').split('/');
        url[url.length-2] = formCertificado.attr('data-id');
        url = url.join("/");
        var data = formCertificado.serialize();
        $.ajax({
            url: url,
            method: 'POST',
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

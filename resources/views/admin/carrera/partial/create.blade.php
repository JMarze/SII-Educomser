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
                {!! Form::open(['id' => 'form', 'class' => 'form-horizontal']) !!}

                <div class="form-group" id="w-codigo">
                    {!! Form::label('codigo', 'Código', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::text('codigo', null, ['class' => 'form-control', 'placeholder' => 'Ej. CAR-TECNET']) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="form-group" id="w-nombre">
                    {!! Form::label('nombre', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ej. Tecnología .Net']) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="form-group" id="w-logo">
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

                <div class="form-group" id="w-color_hexa">
                    {!! Form::label('color_hexa', 'Color', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::text('color_hexa', null, ['class' => 'form-control', 'placeholder' => 'Ej. #682079']) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="form-group" id="w-costo_mensual">
                    {!! Form::label('costo_mensual', 'Costo mensual', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::number('costo_mensual', null, ['class' => 'form-control', 'placeholder' => 'Ej. 300', 'min' => '1', 'step' => '0.5']) !!}
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
                <button id="btn-agregar" type="button" class="btn btn-success">
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
    $('.modal#create').on('hidden.bs.modal', function(e){
        $(this).find('form')[0].reset();
        $('.has-error .help-block>strong').html('');
        $('.has-error').removeClass('has-error');
    });
    // Crear
    var form = $('#form');
    var progressBar = $('.progress .progress-bar');
    $(document).on('click', '#btn-agregar', function(){
        form.submit();
    });
    form.ajaxForm({
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
    });
</script>
@endsection

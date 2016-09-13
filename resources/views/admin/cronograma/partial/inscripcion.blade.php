<div class="modal fade" id="inscribir" tabindex="-1" role="dialog" aria-labelledby="Inscripción">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Agregar">
                    <i class="fa fa-btn fa-user"></i>Inscribir alumno
                </h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['route' => ['admin.inscripcion.inscribir', 'IDCRONOGRAMA', 'IDALUMNO'], 'method' => 'POST', 'id' => 'form-inscribir', 'class' => 'form-horizontal']) !!}

                <div class="form-group wrapper-lblCronograma">
                    <label class="col-md-4 control-label">Inscribir a</label>
                    <div class="col-md-6">
                        <label class='control-label' id="lblCronograma"></label>
                        <span class="help-block">
                            <strong></strong>
                        </span>
                    </div>
                </div>

                <div class="form-group wrapper-inscripcion_observacion">
                    {!! Form::label('inscripcion_observacion', 'Observación de la inscripción', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::textarea('inscripcion_observacion', null, ['class' => 'form-control', 'placeholder' => 'Ej. Alumno con descuento especial ...', 'rows' => 5]) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="form-group wrapper-monto">
                    {!! Form::label('monto', 'Monto a pagar', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::number('monto', null, ['class' => 'form-control', 'min' => 0, 'step' => 0.5]) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="form-group wrapper-pago_observacion">
                    {!! Form::label('pago_observacion', 'Observación del pago', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::textarea('pago_observacion', null, ['class' => 'form-control', 'placeholder' => 'Ej. Cancelará el total en los próximos 2 días ...', 'rows' => 5]) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="form-group wrapper-numero_factura">
                    {!! Form::label('numero_factura', 'Número de la factura', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::number('numero_factura', null, ['class' => 'form-control', 'min' => 1, 'step' => 1]) !!}
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
                <button id="btn-agregar" type="button" class="btn btn-default">
                    <i class="fa fa-btn fa-save"></i>Inscribir
                </button>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script>
    // Reset Form
    function resetForm(obj){
        obj.find('form')[0].reset();
        $('.help-block>strong').html('');
        $('.has-error').removeClass('has-error');
    }
    // Reset Form
    $('.modal#inscribir').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#inscribir').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });
    // Crear
    var formInscribir = $('#form-inscribir');
    $(document).on('click', '#btn-agregar', function(){
        var url = formInscribir.attr('action');
        var data = formInscribir.serialize();
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data: data
        }).done (function (response){
            location.reload();
        }).fail (function (response){
            //validation(response);
        });
    });
</script>
@endsection

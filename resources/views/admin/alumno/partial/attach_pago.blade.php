<div class="modal fade" id="attach_pago" role="dialog" aria-labelledby="Registrar Pago">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Registrar Pago">
                    <i class="fa fa-btn fa-money"></i>Registrar Pago
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-attach-pago">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => ['admin.alumno.postattachpago', 'IDINSCRIPCION'], 'method' => 'PUT', 'id' => 'form-postattachpago', 'class' => 'form-horizontal']) !!}

                <div class="form-group wrapper-monto">
                    {!! Form::label('monto', 'Monto', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::number('monto', null, ['class' => 'form-control', 'placeholder' => 'Ej. 200', 'min' => '1', 'step' => '10']) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="form-group wrapper-concepto_id">
                    {!! Form::label('concepto_id', 'Concepto', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::select('concepto_id', [], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un concepto', 'style' => 'width:100%;']) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="form-group wrapper-numero_factura">
                    {!! Form::label('numero_factura', 'Número de Factura', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::number('numero_factura', null, ['class' => 'form-control', 'placeholder' => 'Ej. 123', 'min' => '1', 'step' => '1']) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="form-group wrapper-observaciones">
                    {!! Form::label('observaciones', 'Observaciones', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'placeholder' => 'Dejar en blanco si es necesario ...', 'rows' => 5]) !!}
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
                <button id="btn-attachpago" type="button" class="btn btn-default">
                    <i class="fa fa-btn fa-save"></i>Finalizar
                </button>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script>
    // Reset Form
    $('.modal#attach_pago').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#attach_pago').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });

    // Crear
    var formPago = $('#form-postattachpago');
    $(document).on('click', '#btn-attachpago', function(){
        var url = formPago.attr('action').split('/');
        url[url.length-2] = formPago.attr('data-id');
        url = url.join("/");
        var data = formPago.serialize();
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

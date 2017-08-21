<div class="modal fade" id="update_capitulo" tabindex="-1" role="dialog" aria-labelledby="Modificar Capítulo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Modificar Capítulo">
                    <i class="fa fa-btn fa-list"></i>Modificar Capítulo
                </h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['route' => ['admin.curso.update_capitulo', $curso->codigo], 'method' => 'PUT', 'id' => 'form-update_capitulo', 'class' => 'form-horizontal']) !!}

                {!! Form::hidden('curso_codigo', $curso->codigo, []) !!}

                {!! Form::hidden('capitulo_id', null, []) !!}

                <div class="form-group wrapper-titulo">
                    {!! Form::label('titulo', 'Título', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::text('titulo', null, ['class' => 'form-control titulo_update', 'placeholder' => 'Ej. Introducción a Visual Basic .Net']) !!}
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
                <button id="btn-modificar_capitulo" type="button" class="btn btn-default">
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
    $('.modal#update_capitulo').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#update_capitulo').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });
    // Modificar Capítulo
    $(document).on('click', 'button[data-target="#update_capitulo"]', function() {
        capituloId = $(this).attr('data-id');
        url = '{{ route('admin.curso.getCapitulo', 'IDCAPITULO') }}';
        url = url.replace('IDCAPITULO', capituloId);
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'JSON'
        }).done (function (response){
            if(response['capitulo'] != null){
                $('input[name="capitulo_id"]').val(response['capitulo']['id']);
                $('.titulo_update').val(response['capitulo']['titulo']);
            }
        }).fail (function (response){
            validation(response);
        });
        url = url.replace(capituloId, 'IDCAPITULO');
    });
    var formUpdateCapitulo = $('#form-update_capitulo');
    // Modificar
    $(document).on('click', '#btn-modificar_capitulo', function(){
        var url = formUpdateCapitulo.attr('action');
        var data = formUpdateCapitulo.serialize();
        $.ajax({
            url: url,
            method: 'PUT',
            dataType: 'JSON',
            data: data
        }).done (function (response){
            window.location.href = "{{ route('admin.curso.show', $curso->codigo) }}";
        }).fail (function (response){
            validation(response);
        });
    });
</script>
@endsection

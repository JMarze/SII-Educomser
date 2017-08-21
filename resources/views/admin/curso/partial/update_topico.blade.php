<div class="modal fade" id="update_topico" tabindex="-1" role="dialog" aria-labelledby="Modificar Tópico">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Modificar Tópico">
                    <i class="fa fa-btn fa-list"></i>Modificar Tópico
                </h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['route' => ['admin.curso.update_topico', 'IDCAPITULO'], 'method' => 'PUT', 'id' => 'form-update_topico', 'class' => 'form-horizontal']) !!}

                {!! Form::hidden('capitulo_id', 'IDCAPITULO', []) !!}

                {!! Form::hidden('topico_id', null, []) !!}

                <div class="form-group wrapper-subtitulo">
                    {!! Form::label('subtitulo', 'Subtítulo', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::text('subtitulo', null, ['class' => 'form-control subtitulo_update', 'placeholder' => 'Ej. Versiones anteriores a VB .Net']) !!}
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
                <button id="btn-modificar_topico" type="button" class="btn btn-default">
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
    $('.modal#update_topico').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#update_topico').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });
    var formUpdateTopico = $('#form-update_topico');
    // Modificar Tópico
    $(document).on('click', 'button[data-target="#update_topico"]', function() {
        topicoId = $(this).attr('data-id');
        capituloId = $(this).attr('data-capitulo');
        formUpdateTopico.attr('action', formUpdateTopico.attr('action').replace('IDCAPITULO', capituloId));
        url = '{{ route('admin.curso.getTopico', 'IDTOPICO') }}';
        url = url.replace('IDTOPICO', topicoId);
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'JSON'
        }).done (function (response){
            if(response['topico'] != null){
                $('input[name="topico_id"]').val(response['topico']['id']);
                $('.subtitulo_update').val(response['topico']['subtitulo']);
            }
        }).fail (function (response){
            validation(response);
        });
        url = url.replace(topicoId, 'IDTOPICO');
    });
    // Modificar
    $(document).on('click', '#btn-modificar_topico', function(){
        var url = formUpdateTopico.attr('action');
        var data = formUpdateTopico.serialize();
        $.ajax({
            url: url,
            method: 'POST',
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

<div class="modal fade" id="destroy_topico" tabindex="-1" role="dialog" aria-labelledby="Eliminar Tópico">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Eliminar Tópico">
                    <i class="fa fa-btn fa-list"></i>Eliminar Tópico
                </h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['route' => ['admin.curso.destroy_topico', 'IDCAPITULO'], 'method' => 'PUT', 'id' => 'form-destroy_topico', 'class' => 'form-horizontal']) !!}

                {!! Form::hidden('capitulo_id', 'IDCAPITULO', []) !!}

                {!! Form::hidden('topico_id', null, []) !!}

                <h3>¿Está seguro de eliminar el tópico: <i class="subtitulo_destroy"></i>?</h3>

                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-btn fa-close"></i>Cancelar
                </button>
                <button id="btn-eliminar_topico" type="button" class="btn btn-default">
                    <i class="fa fa-btn fa-save"></i>Eliminar
                </button>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script>
    // Reset Form
    $('.modal#destroy_topico').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#destroy_topico').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });
    var formDestroyTopico = $('#form-destroy_topico');
    // Eliminar Tópico
    $(document).on('click', 'button[data-target="#destroy_topico"]', function() {
        topicoId = $(this).attr('data-id');
        capituloId = $(this).attr('data-capitulo');
        formDestroyTopico.attr('action', formDestroyTopico.attr('action').replace('IDCAPITULO', capituloId));
        url = '{{ route('admin.curso.getTopico', 'IDTOPICO') }}';
        url = url.replace('IDTOPICO', topicoId);
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'JSON'
        }).done (function (response){
            if(response['topico'] != null){
                $('input[name="topico_id"]').val(response['topico']['id']);
                $('.subtitulo_destroy').html(response['topico']['subtitulo']);
            }
        }).fail (function (response){
            validation(response);
        });
        url = url.replace(topicoId, 'IDTOPICO');
    });
    // Modificar
    $(document).on('click', '#btn-eliminar_topico', function(){
        var url = formDestroyTopico.attr('action');
        var data = formDestroyTopico.serialize();
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

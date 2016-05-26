<div class="modal fade" id="create_topico" tabindex="-1" role="dialog" aria-labelledby="Agregar Tópico">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Agregar Tópico">
                    <i class="fa fa-btn fa-list"></i>Agregar Tópico
                </h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['route' => ['admin.curso.create_topico', 'IDCAPITULO'], 'method' => 'POST', 'id' => 'form-create_topico', 'class' => 'form-horizontal']) !!}

                {!! Form::hidden('capitulo_id', 'IDCAPITULO', []) !!}

                <div class="form-group wrapper-subtitulo">
                    {!! Form::label('subtitulo', 'Subtítulo', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::text('subtitulo', null, ['class' => 'form-control', 'placeholder' => 'Ej. Versiones anteriores a VB .Net']) !!}
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
                <button id="btn-agregar_topico" type="button" class="btn btn-default">
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
    $('.modal#create_topico').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#create_topico').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });
    // Crear
    var formCreateTopico = $('#form-create_topico');
    $(document).on('click', '#btn-agregar_topico', function(){
        var url = formCreateTopico.attr('action').split('/');
        url[url.length-2] = formCreateTopico.attr('data-id');
        url = url.join("/");
        var data = formCreateTopico.serialize();
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

<div class="modal fade" id="create_capitulo" tabindex="-1" role="dialog" aria-labelledby="Agregar Capítulo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Agregar Capítulo">
                    <i class="fa fa-btn fa-list"></i>Agregar Capítulo
                </h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['route' => ['admin.curso.create_capitulo', $curso->codigo], 'method' => 'POST', 'id' => 'form-create_capitulo', 'class' => 'form-horizontal']) !!}

                {!! Form::hidden('curso_codigo', $curso->codigo, []) !!}

                <div class="form-group wrapper-titulo">
                    {!! Form::label('titulo', 'Título', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::text('titulo', null, ['class' => 'form-control', 'placeholder' => 'Ej. Introducción a Visual Basic .Net']) !!}
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
                <button id="btn-agregar_capitulo" type="button" class="btn btn-default">
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
    $('.modal#create_capitulo').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#create_capitulo').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });
    // Crear
    var formCreateCapitulo = $('#form-create_capitulo');
    $(document).on('click', '#btn-agregar_capitulo', function(){
        var url = formCreateCapitulo.attr('action');
        var data = formCreateCapitulo.serialize();
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

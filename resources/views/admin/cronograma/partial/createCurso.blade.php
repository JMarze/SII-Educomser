<div class="modal fade" id="createCurso" role="dialog" aria-labelledby="Agregar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Agregar">
                    <i class="fa fa-btn fa-calendar"></i>Agregar Curso a Cronograma
                </h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['route' => 'admin.cronograma.storeCurso', 'method' => 'POST', 'id' => 'form-createCurso', 'class' => 'form-horizontal']) !!}

                @include('admin.cronograma.partial.formCurso')

                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-btn fa-close"></i>Cancelar
                </button>
                <button id="btn-agregar" type="button" class="btn btn-default">
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
    $('.modal#createCurso').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#createCurso').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });
    // Crear
    var formCreate = $('#form-createCurso');
    $(document).on('click', '#btn-agregar', function(){
        var url = formCreate.attr('action');
        var data = formCreate.serialize();
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data: data
        }).done (function (response){
            window.location.href = "{{ route('admin.cronograma.index') }}";
        }).fail (function (response){
            validation(response);
        });
    });
</script>
@endsection

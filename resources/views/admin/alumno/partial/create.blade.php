<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="Agregar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Agregar">
                    <i class="fa fa-btn fa-user"></i>Agregar Alumno
                </h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert" id="msg-create">
                    <i class="fa fa-btn fa-spin fa-refresh"></i>
                    <strong>Cargando!!!</strong> Un momento por favor...
                </div>

                {!! Form::open(['route' => 'admin.alumno.store', 'method' => 'POST', 'id' => 'form-create', 'class' => 'form-horizontal']) !!}

                @include('admin.alumno.partial.form')

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
    $('.modal#create').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#create').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });
    // Crear
    var formCreate = $('#form-create');
    $(document).on('click', '#btn-agregar', function(){
        var url = formCreate.attr('action');
        var data = formCreate.serialize();
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data: data
        }).done (function (response){
            window.location.href = "{{ route('admin.alumno.index') }}";
        }).fail (function (response){
            validation(response);
        });
    });

    // Generar Código
    $('input#codigo').focus(function() {
        var d1 = ($('input#primer_apellido').val().trim() != '')?$('input#primer_apellido').val().trim().charAt(0):'-';
        var d2 = ($('input#segundo_apellido').val().trim() != '')?$('input#segundo_apellido').val().trim().charAt(0):'-';
        var d3 = ($('input#nombres').val().trim() != '')?$('input#nombres').val().trim().charAt(0):'-';
        var fecha = $('input#fecha_nacimiento').val().toString().split('-');
        fecha = new Date(fecha[0], fecha[1]-1, fecha[2]);
        var dia = (fecha.getDate() <= 9)?'0'+fecha.getDate():fecha.getDate();
        var mes = (fecha.getMonth()+1 <= 9)?'0'+(fecha.getMonth()+1):fecha.getMonth()+1;
        var año = fecha.getFullYear().toString().substr(2,2);
        $(this).val(d1+d2+d3+'-'+dia+mes+año);
    });
</script>
@endsection

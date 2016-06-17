@if($profesiones->total() > 0)
<table class="table table-hover">
    <tr>
        <th>Grado académico</th>
        <th>Título</th>
        <th></th>
    </tr>
    @foreach($profesiones as $profesion)
    <tr>
        <td>{{ $profesion->grado->descripcion }}</td>
        <td>{{ $profesion->titulo }}</td>
        <td>
            <div class="btn-group" role="group" aria-label="Center Align">
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#update" data-id="{{ $profesion->id }}" title="Editar">
                    <i class="fa fa-edit"></i>
                    <span class="sr-only">Editar</span>
                </button>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#destroy" data-id="{{ $profesion->id }}" title="Eliminar">
                    <i class="fa fa-trash"></i>
                    <span class="sr-only">Eliminar</span>
                </button>
            </div>
        </td>
    </tr>
    @endforeach
</table>
@else
<div class="panel-body">
    <div class="alert alert-warning" role="alert">
        <i class="fa fa-btn fa-database"></i>
        <strong>Oops!!!</strong> No se encontraron profesiones en la base de datos. Intenta <strong>agregar una nueva profesión</strong>
    </div>
</div>
@endif

<div class="panel-footer">
    <div class="text-center">{{ $profesiones->render() }}</div>
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
    // Validation
    function validation(response){
        if(response.responseJSON['titulo']){
            $('.wrapper-titulo').addClass('has-error');
            $('.wrapper-titulo .help-block>strong').html(response.responseJSON['titulo']);
        }else{
            $('.wrapper-titulo').removeClass('has-error');
            $('.wrapper-titulo .help-block>strong').html('');
        }
        if(response.responseJSON['grado_id']){
            $('.wrapper-grado_id').addClass('has-error');
            $('.wrapper-grado_id .help-block>strong').html(response.responseJSON['grado_id']);
        }else{
            $('.wrapper-grado_id').removeClass('has-error');
            $('.wrapper-grado_id .help-block>strong').html('');
        }
    }
    // Paginación
    $(document).on('click', '.pagination a', function (e){
        e.preventDefault();
        var href = $(this).attr('href').split('?');
        var url = href[0];
        var data = href[1];
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'JSON',
            data: data,
            beforeSend: function(e){
                $('#msg-index').css('display', 'block');
            }
        }).done(function (response){
            $('.content-ajax').html(response);
            $('#msg-index').css('display', 'none');
        });
    });

    // Llenar Form -> Editar
    $(document).on('click', 'button[data-target="#update"]', function(e){
        var idProfesion = $(this).attr('data-id');
        var url = '/admin/profesion/' + idProfesion + '/edit';
        var data = 'profesion=' + idProfesion;
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            data: data,
            beforeSend: function(e){
                $('#msg-update').css('display', 'block');
                $('#form-update').css('display', 'none');
            }
        }).done(function (response){
            var selectGrado = $('select#grado_id').empty().append("<option value=''>Seleccione grado académico</option>");
            $.each(response['grados'], function(key, value){
                selectGrado.append("<option value='"+key+"'>"+value+"</option>");
            });
            $.each(response['profesion'], function(key, value){
                if(key == 'grado_id'){
                    $('select[name="'+key+'"]').val(value);
                }else{
                    $('input[name="'+key+'"]').val(value);
                }
            });
            $('#msg-update').css('display', 'none');
            $('#form-update').css('display', 'block');
            $('#form-update').attr('data-id', idProfesion);
        });
    });

    // Llenar Form -> Eliminar
    $(document).on('click', 'button[data-target="#destroy"]', function(e){
        var idProfesion = $(this).attr('data-id');
        var url = '/admin/profesion/' + idProfesion + '/edit';
        var data = 'profesion=' + idProfesion;
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            data: data,
            beforeSend: function(e){
                $('#msg-destroy').css('display', 'block');
                $('#form-destroy').css('display', 'none');
            }
        }).done(function (response){
            if(response['personas'] == 0){
                $('#question-destroy').html("¿Está seguro de eliminar la profesión: <i>"+ response['profesion']['titulo'] +"</i>?");
                $('#btn-eliminar').css('display', 'inline-block');
            }else{
                $('#question-destroy').html("La profesión: <i>"+ response['profesion']['titulo'] +"</i> tiene personas que dependen de la misma, por lo tanto no es posible eliminarla.<br/><h6>* Si es necesario eliminar dicha profesión, elimine primero las personas dependientes.</h6>");
                $('#btn-eliminar').css('display', 'none');
            }
            $('#msg-destroy').css('display', 'none');
            $('#form-destroy').css('display', 'block');
            $('#form-destroy').attr('data-id', idProfesion);
        });
    });
</script>
@endsection

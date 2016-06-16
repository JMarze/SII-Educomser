@if($grados->total() > 0)
<table class="table table-hover">
    <tr>
        <th>Descripción</th>
        <th>Abreviatura</th>
        <th></th>
    </tr>
    @foreach($grados as $grado)
    <tr>
        <td>{{ $grado->descripcion }}</td>
        <td>{{ $grado->abreviatura }}</td>
        <td>
            <div class="btn-group" role="group" aria-label="Center Align">
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#update" data-id="{{ $grado->id }}" title="Editar">
                    <i class="fa fa-edit"></i>
                    <span class="sr-only">Editar</span>
                </button>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#destroy" data-id="{{ $grado->id }}" title="Eliminar">
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
        <strong>Oops!!!</strong> No se encontraron grados académicos en la base de datos. Intenta <strong>agregar un nuevo grado académico</strong>
    </div>
</div>
@endif

<div class="panel-footer">
    <div class="text-center">{{ $grados->render() }}</div>
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
        if(response.responseJSON['descripcion']){
            $('.wrapper-descripcion').addClass('has-error');
            $('.wrapper-descripcion .help-block>strong').html(response.responseJSON['descripcion']);
        }else{
            $('.wrapper-descripcion').removeClass('has-error');
            $('.wrapper-descripcion .help-block>strong').html('');
        }
        if(response.responseJSON['abreviatura']){
            $('.wrapper-abreviatura').addClass('has-error');
            $('.wrapper-abreviatura .help-block>strong').html(response.responseJSON['abreviatura']);
        }else{
            $('.wrapper-abreviatura').removeClass('has-error');
            $('.wrapper-abreviatura .help-block>strong').html('');
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
        var idGrado = $(this).attr('data-id');
        var url = '/admin/grado/' + idGrado + '/edit';
        var data = 'grado=' + idGrado;
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
            $.each(response['grado'], function(key, value){
                $('input[name="'+key+'"]').val(value);
            });
            $('#msg-update').css('display', 'none');
            $('#form-update').css('display', 'block');
            $('#form-update').attr('data-id', idGrado);
        });
    });

    // Llenar Form -> Eliminar
    $(document).on('click', 'button[data-target="#destroy"]', function(e){
        var idGrado = $(this).attr('data-id');
        var url = '/admin/grado/' + idGrado + '/edit';
        var data = 'grado=' + idGrado;
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
            if(response['profesiones'] == 0){
                $('#question-destroy').html("¿Está seguro de eliminar el grado: <i>"+ response['grado']['descripcion'] +"</i>?");
                $('#btn-eliminar').css('display', 'inline-block');
            }else{
                $('#question-destroy').html("El grado: <i>"+ response['grado']['descripcion'] +"</i> tiene profesiones que dependen del mismo, por lo tanto no es posible eliminarlo.<br/><h6>* Si es necesario eliminar dicho grado, elimine primero las profesiones dependientes.</h6>");
                $('#btn-eliminar').css('display', 'none');
            }
            $('#msg-destroy').css('display', 'none');
            $('#form-destroy').css('display', 'block');
            $('#form-destroy').attr('data-id', idGrado);
        });
    });
</script>
@endsection

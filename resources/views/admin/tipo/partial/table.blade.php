@if($tipos->total() > 0)
<table class="table table-hover">
    <tr>
        <th>Nombre</th>
        <th>Horas Reales</th>
        <th></th>
    </tr>
    @foreach($tipos as $tipo)
    <tr>
        <td>{{ $tipo->nombre }}</td>
        <td>{{ $tipo->horas_reales }}</td>
        <td>
            <div class="btn-group" role="group" aria-label="Center Align">
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#update" data-id="{{ $tipo->id }}" title="Editar">
                    <i class="fa fa-edit"></i>
                    <span class="sr-only">Editar</span>
                </button>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#destroy" data-id="{{ $tipo->id }}" title="Eliminar">
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
        <strong>Oops!!!</strong> No se encontraron tipos de cronogramas en la base de datos. Intenta <strong>agregar un nuevo tipo de cronograma</strong>
    </div>
</div>
@endif

<div class="panel-footer">
    <div class="text-center">{{ $tipos->render() }}</div>
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
        if(response.responseJSON['nombre']){
            $('.wrapper-nombre').addClass('has-error');
            $('.wrapper-nombre .help-block>strong').html(response.responseJSON['nombre']);
        }else{
            $('.wrapper-nombre').removeClass('has-error');
            $('.wrapper-nombre .help-block>strong').html('');
        }
        if(response.responseJSON['horas_reales']){
            $('.wrapper-horas_reales').addClass('has-error');
            $('.wrapper-horas_reales .help-block>strong').html(response.responseJSON['horas_reales']);
        }else{
            $('.wrapper-horas_reales').removeClass('has-error');
            $('.wrapper-horas_reales .help-block>strong').html('');
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
        var idTipo = $(this).attr('data-id');
        var url = '/admin/tipo/' + idTipo + '/edit';
        var data = 'tipo=' + idTipo;
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
            $.each(response['tipo'], function(key, value){
                $('input[name="'+key+'"]').val(value);
            });
            $('#msg-update').css('display', 'none');
            $('#form-update').css('display', 'block');
            $('#form-update').attr('data-id', idTipo);
        });
    });

    // Llenar Form -> Eliminar
    $(document).on('click', 'button[data-target="#destroy"]', function(e){
        var idTipo = $(this).attr('data-id');
        var url = '/admin/tipo/' + idTipo + '/edit';
        var data = 'tipo=' + idTipo;
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
            if(response['cronogramas'] == 0){
                $('#question-destroy').html("¿Está seguro de eliminar el tipo: <i>"+ response['tipo']['nombre'] +"</i>?");
                $('#btn-eliminar').css('display', 'inline-block');
            }else{
                $('#question-destroy').html("El tipo: <i>"+ response['tipo']['nombre'] +"</i> tiene cronogramas que dependen del mismo, por lo tanto no es posible eliminarlo.<br/><h6>* Si es necesario eliminar dicho tipo, elimine primero los cronogramas dependientes.</h6>");
                $('#btn-eliminar').css('display', 'none');
            }
            $('#msg-destroy').css('display', 'none');
            $('#form-destroy').css('display', 'block');
            $('#form-destroy').attr('data-id', idTipo);
        });
    });
</script>
@endsection

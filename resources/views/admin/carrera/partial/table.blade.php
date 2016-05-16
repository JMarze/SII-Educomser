@if($carreras->total() > 0)
<table class="table table-hover">
    <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Color</th>
        <th>Costo Mensual</th>
        <th>Creación</th>
        <th>Última modificación</th>
        <th></th>
    </tr>
    @foreach($carreras as $carrera)
    <tr>
        <td>{{ $carrera->codigo }}</td>
        <td>{{ $carrera->nombre }}</td>
        <td>
            <span class="label" style="background-color: {{ $carrera->color_hexa }};">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </td>
        <td>Bs {{ number_format($carrera->costo_mensual, 2, '.', ',') }}</td>
        <td>{{ $carrera->created_at->diffForHumans() }}</td>
        <td>{{ $carrera->updated_at->diffForHumans() }}</td>
        <td>
            <div class="btn-group" role="group" aria-label="Center Align">
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#update" data-codigo="{{ $carrera->codigo }}" title="Editar">
                    <i class="fa fa-edit"></i>
                    <span class="sr-only">Editar</span>
                </button>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#delete" data-codigo="{{ $carrera->codigo }}" title="Eliminar">
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
        <strong>Oops!!!</strong> No se encontraron carreras en la base de datos. Intenta <a href="{{ route('admin.carrera.create') }}" class="alert-link">agregar una nueva carrera</a>
    </div>
</div>
@endif

<div class="panel-footer">
    <div class="text-center">{{ $carreras->render() }}</div>
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
        if(response.responseJSON['codigo']){
            $('.wrapper-codigo').addClass('has-error');
            $('.wrapper-codigo .help-block>strong').html(response.responseJSON['codigo']);
        }else{
            $('.wrapper-codigo').removeClass('has-error');
            $('.wrapper-codigo .help-block>strong').html('');
        }
        if(response.responseJSON['nombre']){
            $('.wrapper-nombre').addClass('has-error');
            $('.wrapper-nombre .help-block>strong').html(response.responseJSON['nombre']);
        }else{
            $('.wrapper-nombre').removeClass('has-error');
            $('.wrapper-nombre .help-block>strong').html('');
        }
        if(response.responseJSON['color_hexa']){
            $('.wrapper-color_hexa').addClass('has-error');
            $('.wrapper-color_hexa .help-block>strong').html(response.responseJSON['color_hexa']);
        }else{
            $('.wrapper-color_hexa').removeClass('has-error');
            $('.wrapper-color_hexa .help-block>strong').html('');
        }
        if(response.responseJSON['costo_mensual']){
            $('.wrapper-costo_mensual').addClass('has-error');
            $('.wrapper-costo_mensual .help-block>strong').html(response.responseJSON['costo_mensual']);
        }else{
            $('.wrapper-costo_mensual').removeClass('has-error');
            $('.wrapper-costo_mensual .help-block>strong').html('');
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
            data: data
        }).done(function (response){
            $('.content-ajax').html(response);
        });
    });

    // Llenar Form -> Editar
    $(document).on('click', 'button[data-target="#update"]', function(e){
        var codigoCarrera = $(this).data('codigo');
        var url = '/admin/carrera/' + codigoCarrera + '/edit';
        var data = 'carrera=' + codigoCarrera;
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
            $.each(response['carrera'], function(key, value){
                $('input[name="'+key+'"]').val(value);
            });
            $('#msg-update').css('display', 'none');
            $('#form-update').css('display', 'block');
            $('#form-update').attr('data-id', codigoCarrera);
        });
    });
</script>
@endsection

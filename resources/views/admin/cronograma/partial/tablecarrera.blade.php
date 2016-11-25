@if($lanzamientosCarreras->total() > 0)
<table class="table table-hover">
    <tr>
        <th>Carrera</th>
        <th>Tipo</th>
        <th>Inicio</th>
        <th>Mensualidad</th>
        <th>Matrícula</th>
        <th>¿Slider?</th>
        <th>Inscritos</th>
        <th>Creación</th>
        <th>Modificación</th>
        <th></th>
    </tr>
    @foreach($lanzamientosCarreras as $lanzamientoCarrera)
    <tr>
        <td>({{ $lanzamientoCarrera->carrera->codigo }}) {{ $lanzamientoCarrera->carrera->nombre }}</td>
        <td>{{ $lanzamientoCarrera->cronograma->tipo->nombre }}</td>
        <td>
            {{ utf8_encode($lanzamientoCarrera->cronograma->inicio->formatLocalized('%A, %d de %B de %Y, %H:%M')) }}<br/>

            ({{ $lanzamientoCarrera->cronograma->inicio->diffForHumans() }})
        </td>
        <td>Bs {{ $lanzamientoCarrera->mensualidad }}</td>
        <td>Bs {{ $lanzamientoCarrera->matricula }}</td>
        <td class="text-center">
            @if($lanzamientoCarrera->cronograma->slider)
            Si
            @else
            No
            @endif
        </td>
        <td>

        </td>
        <td>{{ $lanzamientoCarrera->cronograma->created_at->diffForHumans() }}</td>
        <td>{{ $lanzamientoCarrera->cronograma->updated_at->diffForHumans() }}</td>
        <td>
            <div class="btn-group" role="group" aria-label="Center Align">
                <a href="#" type="button" class="btn btn-sm btn-default" title="Ver Lanzamiento">
                    <i class="fa fa-eye"></i>
                    <span class="sr-only">Ver Lanzamiento</span>
                </a>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#updateCarrera" data-id="{{ $lanzamientoCarrera->id }}" title="Editar">
                    <i class="fa fa-edit"></i>
                    <span class="sr-only">Editar</span>
                </button>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#destroyCarrera" data-id="{{ $lanzamientoCarrera->id }}" title="Eliminar">
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
        <strong>Oops!!!</strong> No se encontraron lanzamientos en la base de datos. Intenta <strong>lanzar una nueva carrera</strong>
    </div>
</div>
@endif

<div class="panel-footer">
    <div class="text-center">{{ $lanzamientosCarreras->render() }}</div>
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
        if(response.responseJSON['costo']){
            $('.wrapper-costo').addClass('has-error');
            $('.wrapper-costo .help-block>strong').html(response.responseJSON['costo']);
        }else{
            $('.wrapper-costo').removeClass('has-error');
            $('.wrapper-costo .help-block>strong').html('');
        }
        if(response.responseJSON['carrera_codigo']){
            $('.wrapper-carrera_codigo').addClass('has-error');
            $('.wrapper-carrera_codigo .help-block>strong').html(response.responseJSON['carrera_codigo']);
        }else{
            $('.wrapper-carrera_codigo').removeClass('has-error');
            $('.wrapper-carrera_codigo .help-block>strong').html('');
        }
        if(response.responseJSON['inicio']){
            $('.wrapper-inicio').addClass('has-error');
            $('.wrapper-inicio .help-block>strong').html(response.responseJSON['inicio']);
        }else{
            $('.wrapper-inicio').removeClass('has-error');
            $('.wrapper-inicio .help-block>strong').html('');
        }
        if(response.responseJSON['duracion_clase']){
            $('.wrapper-duracion_clase').addClass('has-error');
            $('.wrapper-duracion_clase .help-block>strong').html(response.responseJSON['duracion_clase']);
        }else{
            $('.wrapper-duracion_clase').removeClass('has-error');
            $('.wrapper-duracion_clase .help-block>strong').html('');
        }
        if(response.responseJSON['promocion']){
            $('.wrapper-promocion').addClass('has-error');
            $('.wrapper-promocion .help-block>strong').html(response.responseJSON['promocion']);
        }else{
            $('.wrapper-promocion').removeClass('has-error');
            $('.wrapper-promocion .help-block>strong').html('');
        }
        if(response.responseJSON['slider']){
            $('.wrapper-slider').addClass('has-error');
            $('.wrapper-slider .help-block>strong').html(response.responseJSON['slider']);
        }else{
            $('.wrapper-slider').removeClass('has-error');
            $('.wrapper-slider .help-block>strong').html('');
        }
        if(response.responseJSON['tipo_id']){
            $('.wrapper-tipo_id').addClass('has-error');
            $('.wrapper-tipo_id .help-block>strong').html(response.responseJSON['tipo_id']);
        }else{
            $('.wrapper-tipo_id').removeClass('has-error');
            $('.wrapper-tipo_id .help-block>strong').html('');
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
    $(document).on('click', 'button[data-target="#updateCarrera"]', function(e){
        var lanzamientoCarreraId = $(this).attr('data-id');
        var url = '/admin/cronograma/carrera/' + lanzamientoCarreraId + '/edit';
        var data = 'lanzamientoCarrera=' + lanzamientoCarreraId;
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            data: data,
            beforeSend: function(e){
                $('#msg-update').css('display', 'block');
                $('#form-updateCarrera').css('display', 'none');
            }
        }).done(function (response){
            var selectTipo = $('select#tipo_id').empty().append("<option value=''>Seleccione tipo</option>");
            var selectCarrera = $('select#carrera_codigo').empty().append("<option value=''>Seleccione curso</option>");
            $.each(response['tipos'], function(key, value){
                selectTipo.append("<option value='"+key+"'>"+value+"</option>");
            });
            $.each(response['carreras'], function(key, value){
                selectCarrera.append("<option value='"+key+"'>"+value+"</option>");
            });
            $.each(response['lanzamientoCarrera'], function(key, value){
                if(key == 'tipo_id' || key == 'carrera_codigo' || key == 'promocion' || key == 'slider'){
                    $('select[name="'+key+'"]').val(value);
                }else{
                    $('input[name="'+key+'"]').val(value);
                }
            });
            $('input[name="inicio"]').val(response['inicio']);
            $('#msg-update').css('display', 'none');
            $('#form-updateCarrera').css('display', 'block');
            $('#form-updateCarrera').attr('data-id', lanzamientoCarreraId);
        });
    });

    // Llenar Form -> Eliminar
    $(document).on('click', 'button[data-target="#destroyCarrera"]', function(e){
        var lanzamientoCarreraId = $(this).attr('data-id');
        var url = '/admin/cronograma/carrera/' + lanzamientoCarreraId + '/edit';
        var data = 'lanzamientoCarrera=' + lanzamientoCarreraId;
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            data: data,
            beforeSend: function(e){
                $('#msg-destroy').css('display', 'block');
                $('#form-destroyCarrera').css('display', 'none');
            }
        }).done(function (response){
            $('#question-destroy').html("¿Está seguro de eliminar la carrera: <i>"+ response['lanzamientoCarrera']['carrera_codigo'] +"</i> del cronograma?<br/><h6>* El lanzamiento de la carrera quedará archivado por seguridad.</h6>");
            $('#msg-destroy').css('display', 'none');
            $('#form-destroyCarrera').css('display', 'block');
            $('#form-destroyCarrera').attr('data-id', lanzamientoCarreraId);
        });
    });
</script>
@endsection

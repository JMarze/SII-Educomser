@if($cronogramas->total() > 0)
<table class="table table-hover">
    <tr>
        <th>Id</th>
        <th>Curso</th>
        <th>Tipo</th>
        <th>Inicio</th>
        <th>Costo</th>
        <th>¿Slider?</th>
        <th>Docente</th>
        <th>Creación</th>
        <th>Modificación</th>
        <th></th>
        <th></th>
    </tr>
    @foreach($cronogramas as $cronograma)
    <tr>
        <td>{{ $cronograma->id }}</td>
        <td>({{ $cronograma->curso->codigo }}) {{ $cronograma->curso->nombre }}</td>
        <td>{{ $cronograma->tipo->nombre }}</td>
        <td>{{ utf8_encode($cronograma->inicio->formatLocalized('%A, %d de %B de %Y')) }}<br/>({{ $cronograma->inicio->diffForHumans() }})</td>
        <td>Bs {{ $cronograma->costo }}</td>
        <td>
            @if($cronograma->slider)
            Si
            @else
            No
            @endif
        </td>
        <td>
            <div class="btn-group" role="group" aria-label="Center Align">
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#attach" data-id="{{ $cronograma->id }}" title="Docente">
                    <i class="fa fa-btn fa-user-plus"></i>Docente <span class="badge">{{ $cronograma->docentes()->count() }}</span>
                </button>
            </div>
        </td>
        <td>{{ $cronograma->created_at->diffForHumans() }}</td>
        <td>{{ $cronograma->updated_at->diffForHumans() }}</td>
        <td>

        </td>
        <td>
            <div class="btn-group" role="group" aria-label="Center Align">
                <a href="{{ route('admin.cronograma.show', $cronograma->id) }}" type="button" class="btn btn-sm btn-default" title="Ver Cronograma">
                    <i class="fa fa-eye"></i>
                    <span class="sr-only">Ver Cronograma</span>
                </a>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#update" data-id="{{ $cronograma->id }}" title="Editar">
                    <i class="fa fa-edit"></i>
                    <span class="sr-only">Editar</span>
                </button>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#destroy" data-id="{{ $cronograma->id }}" title="Eliminar">
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
        <strong>Oops!!!</strong> No se encontraron cronogramas en la base de datos. Intenta <strong>agregar un nuevo cronograma</strong>
    </div>
</div>
@endif

<div class="panel-footer">
    <div class="text-center">{{ $cronogramas->render() }}</div>
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
        if(response.responseJSON['tipo_id']){
            $('.wrapper-tipo_id').addClass('has-error');
            $('.wrapper-tipo_id .help-block>strong').html(response.responseJSON['tipo_id']);
        }else{
            $('.wrapper-tipo_id').removeClass('has-error');
            $('.wrapper-tipo_id .help-block>strong').html('');
        }
        if(response.responseJSON['curso_codigo']){
            $('.wrapper-curso_codigo').addClass('has-error');
            $('.wrapper-curso_codigo .help-block>strong').html(response.responseJSON['curso_codigo']);
        }else{
            $('.wrapper-curso_codigo').removeClass('has-error');
            $('.wrapper-curso_codigo .help-block>strong').html('');
        }
        if(response.responseJSON['inicio_carrera']){
            $('.wrapper-inicio_carrera').addClass('has-error');
            $('.wrapper-inicio_carrera .help-block>strong').html(response.responseJSON['inicio_carrera']);
        }else{
            $('.wrapper-inicio_carrera').removeClass('has-error');
            $('.wrapper-inicio_carrera .help-block>strong').html('');
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
        if(response.responseJSON['costo']){
            $('.wrapper-costo').addClass('has-error');
            $('.wrapper-costo .help-block>strong').html(response.responseJSON['costo']);
        }else{
            $('.wrapper-costo').removeClass('has-error');
            $('.wrapper-costo .help-block>strong').html('');
        }
        if(response.responseJSON['costo_mensual']){
            $('.wrapper-costo_mensual').addClass('has-error');
            $('.wrapper-costo_mensual .help-block>strong').html(response.responseJSON['costo_mensual']);
        }else{
            $('.wrapper-costo_mensual').removeClass('has-error');
            $('.wrapper-costo_mensual .help-block>strong').html('');
        }
        if(response.responseJSON['matricula']){
            $('.wrapper-matricula').addClass('has-error');
            $('.wrapper-matricula .help-block>strong').html(response.responseJSON['matricula']);
        }else{
            $('.wrapper-matricula').removeClass('has-error');
            $('.wrapper-matricula .help-block>strong').html('');
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
        var idCronograma = $(this).attr('data-id');
        var url = '/admin/cronograma/' + idCronograma + '/edit';
        var data = 'cronograma=' + idCronograma;
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
            var selectTipo = $('select#tipo_id').empty().append("<option value=''>Seleccione tipo</option>");
            var selectCurso = $('select#curso_codigo').empty().append("<option value=''>Seleccione curso</option>");
            $.each(response['tipos'], function(key, value){
                selectTipo.append("<option value='"+key+"'>"+value+"</option>");
            });
            $.each(response['cursos'], function(key, value){
                selectCurso.append("<option value='"+key+"'>"+value+"</option>");
            });
            $.each(response['cronograma'], function(key, value){
                if(key == 'tipo_id' || key == 'curso_codigo' || key == 'inicio_carrera' || key == 'promocion' || key == 'slider'){
                    $('select[name="'+key+'"]').val(value);
                }else{
                    $('input[name="'+key+'"]').val(value);
                }
            });
            $('input[name="inicio"]').val(response['inicio']);
            $('#msg-update').css('display', 'none');
            $('#form-update').css('display', 'block');
            $('#form-update').attr('data-id', idCronograma);
        });
    });
    // Llenar Form -> Eliminar
    $(document).on('click', 'button[data-target="#destroy"]', function(e){
        var idCronograma = $(this).attr('data-id');
        var url = '/admin/cronograma/' + idCronograma + '/edit';
        var data = 'cronograma=' + idCronograma;
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
            $('#question-destroy').html("¿Está seguro de eliminar el cronograma para el curso: <i>"+ response['cronograma']['nombre'] +"</i>?<br/><h6>* El cronograma quedará archivado por seguridad.</h6>");
            $('#msg-destroy').css('display', 'none');
            $('#form-destroy').css('display', 'block');
            $('#form-destroy').attr('data-id', idCronograma);
        });
    });
    // Llenar Form -> Attach
    $(document).on('click', 'button[data-target="#attach"]', function(e){
        var idCronograma = $(this).attr('data-id');
        var urlListar = '{{ route("admin.cronograma.listar") }}';
        $.ajax({
            url: urlListar,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            beforeSend: function(e){
                $('#msg-attach').css('display', 'block');
                $('#form-postattach').css('display', 'none');
            }
        }).done(function (response){
            if(response['docentes'] != null){
                var selectDocente = $('select[name="docente_id[]"]').empty();
                $.each(response['docentes'], function(key, value){
                    selectDocente.append("<option value='"+key+"'>"+value+"</option>");
                });
            }
            $('#msg-attach').css('display', 'none');
            $('#form-postattach').css('display', 'block');
            $('#form-postattach').attr('data-id', idCronograma);
        }).fail(function (response){
            console.log(response);
        });
    });

    $(document).on('click', 'button[data-target="#attach"]', function(e){
        var idCronograma = $(this).attr('data-id');
        var urlListar = '/admin/cronograma/'+ idCronograma +'/attach';
        $.ajax({
            url: urlListar,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            beforeSend: function(e){
                $('#msg-attach').css('display', 'block');
                $('#form-postattach').css('display', 'none');
            }
        }).done(function (response){
            if(response['docentes'] != null){
                var docentes = $('select[name="docente_id[]"]').find(":selected");
                var wrapperDocentes = $('#docentes_lista');
                $.each(response['docentes'], function(key, value){
                    wrapperDocentes.append('<div class="form-group">' +
                               '<input name="docentes_id[]" type="hidden" value="'+ value.id +'"/>' +
                               '<label class="col-md-8 control-label">'+ value.nombre_completo +'</label>' +
                               '<button type="button" class="col-md-1 close del-docente" aria-label="Close">' +
                               '<span aria-hidden="true">&times;</span>' +
                               '</button>' +
                               '</div>');
                });
            }
            $('#msg-attach').css('display', 'none');
            $('#form-postattach').css('display', 'block');
            $('#form-postattach').attr('data-id', idCronograma);
        }).fail(function (response){
            console.log(response);
        });
    });
</script>
@endsection

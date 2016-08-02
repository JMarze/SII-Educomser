@if($alumnos->total() > 0)
<table class="table table-hover">
    <tr>
        <th>Código</th>
        <th>Nombre Completo</th>
        <th>Correo Electrónico</th>
        <th>CI</th>
        <th>Teléfonos</th>
        <th>Profesiones</th>
        <th>Creación</th>
        <th>Modificación</th>
        <th></th>
    </tr>
    @foreach($alumnos as $alumno)
    <tr>
        <td>{{ $alumno->persona->codigo }}</td>
        <td>{{ $alumno->persona->primer_apellido }} {{ $alumno->persona->segundo_apellido }} {{ $alumno->persona->nombres }}</td>
        <td>
            <a href="mailto:{{ $alumno->persona->email }}">
                <i class="fa fa-btn fa-envelope"></i>{{ $alumno->persona->email }}
            </a>
        </td>
        <td>{{ $alumno->persona->numero_ci }} {{ $alumno->persona->expedicion->codigo }}</td>
        <td>
            @if($alumno->persona->telefono_1 != '' && $alumno->persona->telefono_1 != null)
            <i class="fa fa-btn fa-mobile-phone"></i>{{ $alumno->persona->telefono_1 }}
            @endif
            <br/>
            @if($alumno->persona->telefono_2 != '' && $alumno->persona->telefono_2 != null)
            <i class="fa fa-btn fa-phone"></i>{{ $alumno->persona->telefono_2 }}
            @endif
        </td>
        <td>
            <div class="btn-group" role="group" aria-label="Center Align">
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#attach" data-id="{{ $alumno->id }}" title="Profesiones">
                    <i class="fa fa-btn fa-graduation-cap"></i>Profesiones <span class="badge">{{ $alumno->persona->profesiones()->count() }}</span>
                </button>
            </div>
        </td>
        <td>{{ $alumno->created_at->diffForHumans() }}</td>
        <td>
            @if($alumno->updated_at > $alumno->persona->updated_at)
            {{ $alumno->updated_at->diffForHumans() }}
            @else
            {{ $alumno->persona->updated_at->diffForHumans() }}
            @endif
        </td>
        <td>
            <div class="btn-group" role="group" aria-label="Center Align">
                <a href="{{ route('admin.alumno.getshow', $alumno->id) }}" type="button" class="btn btn-sm btn-default" title="Ver Alumno">
                    <i class="fa fa-eye"></i>
                    <span class="sr-only">Ver Alumno</span>
                </a>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#update" data-id="{{ $alumno->id }}" title="Editar">
                    <i class="fa fa-edit"></i>
                    <span class="sr-only">Editar</span>
                </button>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#destroy" data-id="{{ $alumno->id }}" title="Eliminar">
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
        <strong>Oops!!!</strong> No se encontraron alumnos en la base de datos. Intenta <strong>agregar un nuevo alumno</strong>
    </div>
</div>
@endif

<div class="panel-footer">
    <div class="text-center">{{ $alumnos->render() }}</div>
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
        if(response.responseJSON['primer_apellido']){
            $('.wrapper-primer_apellido').addClass('has-error');
            $('.wrapper-primer_apellido .help-block>strong').html(response.responseJSON['primer_apellido']);
        }else{
            $('.wrapper-primer_apellido').removeClass('has-error');
            $('.wrapper-primer_apellido .help-block>strong').html('');
        }
        if(response.responseJSON['segundo_apellido']){
            $('.wrapper-segundo_apellido').addClass('has-error');
            $('.wrapper-segundo_apellido .help-block>strong').html(response.responseJSON['segundo_apellido']);
        }else{
            $('.wrapper-segundo_apellido').removeClass('has-error');
            $('.wrapper-segundo_apellido .help-block>strong').html('');
        }
        if(response.responseJSON['nombres']){
            $('.wrapper-nombres').addClass('has-error');
            $('.wrapper-nombres .help-block>strong').html(response.responseJSON['nombres']);
        }else{
            $('.wrapper-nombres').removeClass('has-error');
            $('.wrapper-nombres .help-block>strong').html('');
        }
        if(response.responseJSON['email']){
            $('.wrapper-email').addClass('has-error');
            $('.wrapper-email .help-block>strong').html(response.responseJSON['email']);
        }else{
            $('.wrapper-email').removeClass('has-error');
            $('.wrapper-email .help-block>strong').html('');
        }
        if(response.responseJSON['fecha_nacimiento']){
            $('.wrapper-fecha_nacimiento').addClass('has-error');
            $('.wrapper-fecha_nacimiento .help-block>strong').html(response.responseJSON['fecha_nacimiento']);
        }else{
            $('.wrapper-fecha_nacimiento').removeClass('has-error');
            $('.wrapper-fecha_nacimiento .help-block>strong').html('');
        }
        if(response.responseJSON['numero_ci']){
            $('.wrapper-numero_ci').addClass('has-error');
            $('.wrapper-numero_ci .help-block>strong').html(response.responseJSON['numero_ci']);
        }else{
            $('.wrapper-numero_ci').removeClass('has-error');
            $('.wrapper-numero_ci .help-block>strong').html('');
        }
        if(response.responseJSON['expedicion_codigo']){
            $('.wrapper-expedicion_codigo').addClass('has-error');
            $('.wrapper-expedicion_codigo .help-block>strong').html(response.responseJSON['expedicion_codigo']);
        }else{
            $('.wrapper-expedicion_codigo').removeClass('has-error');
            $('.wrapper-expedicion_codigo .help-block>strong').html('');
        }
        if(response.responseJSON['genero']){
            $('.wrapper-genero').addClass('has-error');
            $('.wrapper-genero .help-block>strong').html(response.responseJSON['genero']);
        }else{
            $('.wrapper-genero').removeClass('has-error');
            $('.wrapper-genero .help-block>strong').html('');
        }
        if(response.responseJSON['direccion']){
            $('.wrapper-direccion').addClass('has-error');
            $('.wrapper-direccion .help-block>strong').html(response.responseJSON['direccion']);
        }else{
            $('.wrapper-direccion').removeClass('has-error');
            $('.wrapper-direccion .help-block>strong').html('');
        }
        if(response.responseJSON['telefono_1']){
            $('.wrapper-telefono_1').addClass('has-error');
            $('.wrapper-telefono_1 .help-block>strong').html(response.responseJSON['telefono_1']);
        }else{
            $('.wrapper-telefono_1').removeClass('has-error');
            $('.wrapper-telefono_1 .help-block>strong').html('');
        }
        if(response.responseJSON['telefono_2']){
            $('.wrapper-telefono_2').addClass('has-error');
            $('.wrapper-telefono_2 .help-block>strong').html(response.responseJSON['telefono_2']);
        }else{
            $('.wrapper-telefono_2').removeClass('has-error');
            $('.wrapper-telefono_2 .help-block>strong').html('');
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
        var idAlumno = $(this).attr('data-id');
        var url = '/admin/alumno/' + idAlumno + '/edit';
        var data = 'alumno=' + idAlumno;
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
            var selectExpedicion = $('select#expedicion_codigo').empty().append("<option value=''>Seleccione expedición de CI</option>");
            $.each(response['expediciones'], function(key, value){
                selectExpedicion.append("<option value='"+key+"'>"+value+"</option>");
            });
            $.each(response['alumno'], function(key, value){
                if(key == 'expedicion_codigo' || key == 'genero'){
                    $('select[name="'+key+'"]').val(value);
                }else if(key == 'direccion'){
                    $('textarea[name="'+key+'"]').val(value);
                }else{
                    $('input[name="'+key+'"]').val(value);
                }
            });
            $('#msg-update').css('display', 'none');
            $('#form-update').css('display', 'block');
            $('#form-update').attr('data-id', idAlumno);
        });
    });

    // Llenar Form -> Eliminar
    $(document).on('click', 'button[data-target="#destroy"]', function(e){
        var idAlumno = $(this).attr('data-id');
        var url = '/admin/alumno/' + idAlumno + '/edit';
        var data = 'alumno=' + idAlumno;
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
            $('#question-destroy').html("¿Está seguro de eliminar al alumno: <i>"+ response['alumno']['nombres'] +"</i>?<br/><h6>* El alumno quedará archivado por seguridad.");
            $('#msg-destroy').css('display', 'none');
            $('#form-destroy').css('display', 'block');
            $('#form-destroy').attr('data-id', idAlumno);
        });
    });

    // Llenar Form -> Attach
    $(document).on('click', 'button[data-target="#attach"]', function(e){
        var idProfesion = $(this).attr('data-id');
        var urlListar = '{{ route("admin.alumno.listar") }}';
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
            if(response['profesiones'] != null){
                var selectProfesion = $('select[name="profesion_id[]"]').empty();
                $.each(response['profesiones'], function(key, value){
                    selectProfesion.append("<option value='"+key+"'>"+value+"</option>");
                });
            }
            $('#msg-attach').css('display', 'none');
            $('#form-postattach').css('display', 'block');
            $('#form-postattach').attr('data-id', idProfesion);
        }).fail(function (response){
            console.log(response);
        });
    });

    $(document).on('click', 'button[data-target="#attach"]', function(e){
        var idAlumno = $(this).attr('data-id');
        var urlListar = '/admin/alumno/'+ idAlumno +'/attach';
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
            if(response['profesiones'] != null){
                var profesiones = $('select[name="profesion_id[]"]').find(":selected");
                var wrapperProfesiones = $('#profesiones_lista');
                $.each(response['profesiones'], function(key, value){
                    wrapperProfesiones.append('<div class="form-group">' +
                               '<input name="profesiones_id[]" type="hidden" value="'+ value.id +'"/>' +
                               '<label class="col-md-8 control-label">'+ value.abreviatura + ' ' + value.titulo +'</label>' +
                               '<button type="button" class="col-md-1 close del-profesion" aria-label="Close">' +
                               '<span aria-hidden="true">&times;</span>' +
                               '</button>' +
                               '</div>');
                });
            }
            $('#msg-attach').css('display', 'none');
            $('#form-postattach').css('display', 'block');
            $('#form-postattach').attr('data-id', idAlumno);
        }).fail(function (response){
            console.log(response);
        });
    });
</script>
@endsection

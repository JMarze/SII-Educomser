@if($docentes->total() > 0)
<table class="table table-hover">
    <tr>
        <th>Código</th>
        <th>Nombre Completo</th>
        <th>Correos Electrónicos</th>
        <th>CI</th>
        <th>Teléfonos</th>
        <th>Creación</th>
        <th>Modificación</th>
        <th></th>
    </tr>
    @foreach($docentes as $docente)
    <tr>
        <td>{{ $docente->persona->codigo }}</td>
        <td>{{ $docente->persona->primer_apellido }} {{ $docente->persona->segundo_apellido }} {{ $docente->persona->nombres }}</td>
        <td>
            <a href="mailto:{{ $docente->persona->email }}">
                <i class="fa fa-btn fa-envelope"></i>{{ $docente->persona->email }}
            </a>
            <br/>
            <a href="mailto:{{ $docente->email_institucional }}">
                <i class="fa fa-btn fa-envelope-o"></i>{{ $docente->email_institucional }}
            </a>
        </td>
        <td>{{ $docente->persona->numero_ci }} {{ $docente->persona->expedicion->codigo }}</td>
        <td>
            @if($docente->persona->telefono_1 != '' && $docente->persona->telefono_1 != null)
            <i class="fa fa-btn fa-mobile-phone"></i>{{ $docente->persona->telefono_1 }}
            @endif
            <br/>
            @if($docente->persona->telefono_2 != '' && $docente->persona->telefono_2 != null)
            <i class="fa fa-btn fa-phone"></i>{{ $docente->persona->telefono_2 }}
            @endif
        </td>
        <td>{{ $docente->created_at->diffForHumans() }}</td>
        <td>{{ $docente->updated_at->diffForHumans() }}</td>
        <td>
            <div class="btn-group" role="group" aria-label="Center Align">
                <a href="{{ route('admin.docente.getshow', $docente->id) }}" type="button" class="btn btn-sm btn-default" title="Ver Docente">
                    <i class="fa fa-eye"></i>
                    <span class="sr-only">Ver Docente</span>
                </a>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#update" data-id="{{ $docente->id }}" title="Editar">
                    <i class="fa fa-edit"></i>
                    <span class="sr-only">Editar</span>
                </button>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#destroy" data-id="{{ $docente->id }}" title="Eliminar">
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
        <strong>Oops!!!</strong> No se encontraron docentes en la base de datos. Intenta <strong>agregar un nuevo docente</strong>
    </div>
</div>
@endif

<div class="panel-footer">
    <div class="text-center">{{ $docentes->render() }}</div>
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
        if(response.responseJSON['biografia']){
            $('.wrapper-biografia').addClass('has-error');
            $('.wrapper-biografia .help-block>strong').html(response.responseJSON['biografia']);
        }else{
            $('.wrapper-biografia').removeClass('has-error');
            $('.wrapper-biografia .help-block>strong').html('');
        }
        if(response.responseJSON['email_institucional']){
            $('.wrapper-email_institucional').addClass('has-error');
            $('.wrapper-email_institucional .help-block>strong').html(response.responseJSON['email_institucional']);
        }else{
            $('.wrapper-email_institucional').removeClass('has-error');
            $('.wrapper-email_institucional .help-block>strong').html('');
        }
        if(response.responseJSON['social_facebook']){
            $('.wrapper-social_facebook').addClass('has-error');
            $('.wrapper-social_facebook .help-block>strong').html(response.responseJSON['social_facebook']);
        }else{
            $('.wrapper-social_facebook').removeClass('has-error');
            $('.wrapper-social_facebook .help-block>strong').html('');
        }
        if(response.responseJSON['social_twitter']){
            $('.wrapper-social_twitter').addClass('has-error');
            $('.wrapper-social_twitter .help-block>strong').html(response.responseJSON['social_twitter']);
        }else{
            $('.wrapper-social_twitter').removeClass('has-error');
            $('.wrapper-social_twitter .help-block>strong').html('');
        }
        if(response.responseJSON['social_googleplus']){
            $('.wrapper-social_googleplus').addClass('has-error');
            $('.wrapper-social_googleplus .help-block>strong').html(response.responseJSON['social_googleplus']);
        }else{
            $('.wrapper-social_googleplus').removeClass('has-error');
            $('.wrapper-social_googleplus .help-block>strong').html('');
        }
        if(response.responseJSON['social_youtube']){
            $('.wrapper-social_youtube').addClass('has-error');
            $('.wrapper-social_youtube .help-block>strong').html(response.responseJSON['social_youtube']);
        }else{
            $('.wrapper-social_youtube').removeClass('has-error');
            $('.wrapper-social_youtube .help-block>strong').html('');
        }
        if(response.responseJSON['social_linkedin']){
            $('.wrapper-social_linkedin').addClass('has-error');
            $('.wrapper-social_linkedin .help-block>strong').html(response.responseJSON['social_linkedin']);
        }else{
            $('.wrapper-social_linkedin').removeClass('has-error');
            $('.wrapper-social_linkedin .help-block>strong').html('');
        }
        if(response.responseJSON['social_website']){
            $('.wrapper-social_website').addClass('has-error');
            $('.wrapper-social_website .help-block>strong').html(response.responseJSON['social_website']);
        }else{
            $('.wrapper-social_website').removeClass('has-error');
            $('.wrapper-social_website .help-block>strong').html('');
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
        var idDocente = $(this).attr('data-id');
        var url = '/admin/docente/' + idDocente + '/edit';
        var data = 'docente=' + idDocente;
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
            $.each(response['docente'], function(key, value){
                if(key == 'expedicion_codigo' || key == 'genero'){
                    $('select[name="'+key+'"]').val(value);
                }else if(key == 'direccion' || key == 'biografia'){
                    $('textarea[name="'+key+'"]').val(value);
                }else{
                    $('input[name="'+key+'"]').val(value);
                }
            });
            $('#msg-update').css('display', 'none');
            $('#form-update').css('display', 'block');
            $('#form-update').attr('data-id', idDocente);
        });
    });

    // Llenar Form -> Eliminar
    $(document).on('click', 'button[data-target="#destroy"]', function(e){
        var idDocente = $(this).attr('data-id');
        var url = '/admin/docente/' + idDocente + '/edit';
        var data = 'docente=' + idDocente;
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
            $('#question-destroy').html("¿Está seguro de eliminar al docente: <i>"+ response['docente']['nombres'] +"</i>?<br/><h6>* El docente quedará archivado por seguridad.");
            $('#msg-destroy').css('display', 'none');
            $('#form-destroy').css('display', 'block');
            $('#form-destroy').attr('data-id', idDocente);
        });
    });
</script>
@endsection

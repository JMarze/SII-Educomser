@if($carreras->total() > 0)
<table class="table table-hover">
    <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Color</th>
        <th>Costo Mensual</th>
        <th>Creación</th>
        <th>Última modificación</th>
        <th>Logo</th>
        <th>Cursos</th>
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
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#upload" data-codigo="{{ $carrera->codigo }}" title="Subir Logo">
                    @if($carrera->logo == null || $carrera->logo == '')
                    <i class="fa fa-btn fa-upload"></i>Subir Logo
                    @else
                    <i class="fa fa-btn fa-upload"></i>Editar Logo
                    @endif
                </button>
            </div>
        </td>
        <td>
            <div class="btn-group" role="group" aria-label="Center Align">
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#attach" data-codigo="{{ $carrera->codigo }}" title="Cursos">
                    <i class="fa fa-btn fa-upload"></i>Cursos <span class="badge">{{ $carrera->cursos()->count() }}</span>
                </button>
            </div>
        </td>
        <td>
            <div class="btn-group" role="group" aria-label="Center Align">
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#update" data-codigo="{{ $carrera->codigo }}" title="Editar">
                    <i class="fa fa-edit"></i>
                    <span class="sr-only">Editar</span>
                </button>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#destroy" data-codigo="{{ $carrera->codigo }}" title="Eliminar">
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
        <strong>Oops!!!</strong> No se encontraron carreras en la base de datos. Intenta <strong>agregar una nueva carrera</strong>
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
        var codigoCarrera = $(this).attr('data-codigo');
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
                if(key != 'logo'){
                    $('input[name="'+key+'"]').val(value);
                }
            });
            $('#msg-update').css('display', 'none');
            $('#form-update').css('display', 'block');
            $('#form-update').attr('data-id', codigoCarrera);
        });
    });

    // Llenar Form -> Eliminar
    $(document).on('click', 'button[data-target="#destroy"]', function(e){
        var codigoCarrera = $(this).attr('data-codigo');
        var url = '/admin/carrera/' + codigoCarrera + '/edit';
        var data = 'carrera=' + codigoCarrera;
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
            $('#question-destroy').html("¿Está seguro de eliminar la carrera: <i>"+ response['carrera']['nombre'] +"</i>?<br/><h6>* La carrera quedará archivada por seguridad, esto implica que no podrá utilizar este código de carrera: <i>"+ response['carrera']['codigo'] +"</i> para asignarselo a otra.</h6>");
            $('#msg-destroy').css('display', 'none');
            $('#form-destroy').css('display', 'block');
            $('#form-destroy').attr('data-id', codigoCarrera);
        });
    });

    // Llenar Form -> Upload
    $(document).on('click', 'button[data-target="#upload"]', function(e){
        var codigoCarrera = $(this).attr('data-codigo');
        var url = '/admin/carrera/' + codigoCarrera + '/edit';
        var data = 'carrera=' + codigoCarrera;
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            data: data,
            beforeSend: function(e){
                $('#msg-upload').css('display', 'block');
                $('#form-upload').css('display', 'none');
            }
        }).done(function (response){
            $('#msg-upload').css('display', 'none');
            $('#form-upload').css('display', 'block');
            $('#form-upload').attr('data-id', codigoCarrera);
            if(response['carrera']['logo'] != null && response['carrera']['logo'] != ''){
                $('#logo-nombre').html(response['carrera']['logo']);
                $('#logo-success').html('Nombre del Archivo');
            }else{
                $('#logo-nombre').html('');
                $('#logo-success').html('');
            }
        });
    });

    // Llenar Form -> Attach
    $(document).on('click', 'button[data-target="#attach"]', function(e){
        var codigoCarrera = $(this).attr('data-codigo');
        var urlListar = '{{ route("admin.carrera.listar") }}';
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
            if(response['cursos'] != null){
                var selectCurso = $('select[name="curso_id[]"]').empty();
                $.each(response['cursos'], function(key, value){
                    selectCurso.append("<option value='"+key+"'>"+value+"</option>");
                });
            }
            $('#msg-attach').css('display', 'none');
            $('#form-postattach').css('display', 'block');
            $('#form-postattach').attr('data-id', codigoCarrera);
        }).fail(function (response){
            console.log(response);
        });
    });

    $(document).on('click', 'button[data-target="#attach"]', function(e){
        var codigoCarrera = $(this).attr('data-codigo');
        var urlListar = '/admin/carrera/'+ codigoCarrera +'/attach';
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
            if(response['cursos'] != null){
                var cursos = $('select[name="curso_id[]"]').find(":selected");
                var wrapperCursos = $('#cursos_orden');
                $.each(response['cursos'], function(key, value){
                    wrapperCursos.append('<div class="form-group">' +
                               '<input name="curso_codigo[]" type="hidden" value="'+ value.codigo +'"/>' +
                               '<label class="col-md-8 control-label">'+ value.nombre +'</label>' +
                               '<div class="col-md-2">'+
                               '<input name="curso_orden[]" type="number" value="'+ value.pivot.orden +'" min="0" class="form-control"/>' +
                               '</div>' +
                               '<button type="button" class="col-md-1 close del-curso" aria-label="Close">' +
                               '<span aria-hidden="true">&times;</span>' +
                               '</button>' +
                               '</div>');
                });
            }
            $('#msg-attach').css('display', 'none');
            $('#form-postattach').css('display', 'block');
            $('#form-postattach').attr('data-id', codigoCarrera);
        }).fail(function (response){
            console.log(response);
        });
    });
</script>
@endsection

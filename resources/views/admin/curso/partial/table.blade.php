@if($cursos->total() > 0)
<table class="table table-hover">
    <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Color</th>
        <th>Área</th>
        <th>Dificultad</th>
        <th>¿Vigente?</th>
        <th>Creación</th>
        <th>Modificación</th>
        <th>Logo</th>
        <th>Contenido</th>
        <th></th>
    </tr>
    @foreach($cursos as $curso)
    <tr>
        <td>{{ $curso->codigo }}</td>
        <td>{{ $curso->nombre }}</td>
        <td>
            <span class="label" style="background-color: {{ $curso->color_hexa }};">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </td>
        <td>{{ $curso->area->nombre }}</td>
        <td>{{ $curso->dificultad->nombre }}</td>
        <td class="text-center">
            @if($curso->vigente)
            Si
            @else
            No
            @endif
        </td>
        <td>{{ $curso->created_at->diffForHumans() }}</td>
        <td>{{ $curso->updated_at->diffForHumans() }}</td>
        <td>
            <div class="btn-group" role="group" aria-label="Center Align">
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#upload" data-codigo="{{ $curso->codigo }}" title="Subir Logo">
                    @if($curso->logo == null || $curso->logo == '')
                    <i class="fa fa-btn fa-upload"></i>Subir Logo
                    @else
                    <i class="fa fa-btn fa-upload"></i>Editar Logo
                    @endif
                </button>
            </div>
        </td>
        <td>
            <div class="btn-group" role="group" aria-label="Center Align">
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#upload_contenido" data-codigo="{{ $curso->codigo }}" title="Subir Contenido">
                    @if($curso->contenido == null || $curso->contenido == '')
                    <i class="fa fa-btn fa-upload"></i>Subir Contenido
                    @else
                    <i class="fa fa-btn fa-upload"></i>Editar Contenido
                    @endif
                </button>
            </div>
        </td>
        <td>
            <div class="btn-group" role="group" aria-label="Center Align">
                <a href="{{ route('admin.curso.getshow', $curso->codigo) }}" type="button" class="btn btn-sm btn-default" title="Ver Curso">
                    <i class="fa fa-eye"></i>
                    <span class="sr-only">Ver Curso</span>
                </a>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#update" data-codigo="{{ $curso->codigo }}" title="Editar">
                    <i class="fa fa-edit"></i>
                    <span class="sr-only">Editar</span>
                </button>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#destroy" data-codigo="{{ $curso->codigo }}" title="Eliminar">
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
        <strong>Oops!!!</strong> No se encontraron cursos en la base de datos. Intenta <strong>agregar un nuevo curso</strong>
    </div>
</div>
@endif

<div class="panel-footer">
    <div class="text-center">{{ $cursos->render() }}</div>
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
        if(response.responseJSON['costo_personalizado']){
            $('.wrapper-costo_personalizado').addClass('has-error');
            $('.wrapper-costo_personalizado .help-block>strong').html(response.responseJSON['costo_personalizado']);
        }else{
            $('.wrapper-costo_personalizado').removeClass('has-error');
            $('.wrapper-costo_personalizado .help-block>strong').html('');
        }
        if(response.responseJSON['costo_referencial']){
            $('.wrapper-costo_referencial').addClass('has-error');
            $('.wrapper-costo_referencial .help-block>strong').html(response.responseJSON['costo_referencial']);
        }else{
            $('.wrapper-costo_referencial').removeClass('has-error');
            $('.wrapper-costo_referencial .help-block>strong').html('');
        }
        if(response.responseJSON['eslogan']){
            $('.wrapper-eslogan').addClass('has-error');
            $('.wrapper-eslogan .help-block>strong').html(response.responseJSON['eslogan']);
        }else{
            $('.wrapper-eslogan').removeClass('has-error');
            $('.wrapper-eslogan .help-block>strong').html('');
        }
        if(response.responseJSON['descripcion']){
            $('.wrapper-descripcion').addClass('has-error');
            $('.wrapper-descripcion .help-block>strong').html(response.responseJSON['descripcion']);
        }else{
            $('.wrapper-descripcion').removeClass('has-error');
            $('.wrapper-descripcion .help-block>strong').html('');
        }
        if(response.responseJSON['horas_academicas']){
            $('.wrapper-horas_academicas').addClass('has-error');
            $('.wrapper-horas_academicas .help-block>strong').html(response.responseJSON['horas_academicas']);
        }else{
            $('.wrapper-horas_academicas').removeClass('has-error');
            $('.wrapper-horas_academicas .help-block>strong').html('');
        }
        if(response.responseJSON['horas_reales']){
            $('.wrapper-horas_reales').addClass('has-error');
            $('.wrapper-horas_reales .help-block>strong').html(response.responseJSON['horas_reales']);
        }else{
            $('.wrapper-horas_reales').removeClass('has-error');
            $('.wrapper-horas_reales .help-block>strong').html('');
        }
        if(response.responseJSON['area_id']){
            $('.wrapper-area_id').addClass('has-error');
            $('.wrapper-area_id .help-block>strong').html(response.responseJSON['area_id']);
        }else{
            $('.wrapper-area_id').removeClass('has-error');
            $('.wrapper-area_id .help-block>strong').html('');
        }
        if(response.responseJSON['dificultad_id']){
            $('.wrapper-dificultad_id').addClass('has-error');
            $('.wrapper-dificultad_id .help-block>strong').html(response.responseJSON['dificultad_id']);
        }else{
            $('.wrapper-dificultad_id').removeClass('has-error');
            $('.wrapper-dificultad_id .help-block>strong').html('');
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
        var codigoCurso = $(this).attr('data-codigo');
        var url = '/admin/curso/' + codigoCurso + '/edit';
        var data = 'curso=' + codigoCurso;
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
            var selectArea = $('select#area_id').empty().append("<option value=''>Seleccione área</option>");
            var selectDificultad = $('select#dificultad_id').empty().append("<option value=''>Seleccione dificultad</option>");
            $.each(response['areas'], function(key, value){
                selectArea.append("<option value='"+key+"'>"+value+"</option>");
            });
            $.each(response['dificultades'], function(key, value){
                selectDificultad.append("<option value='"+key+"'>"+value+"</option>");
            });
            $.each(response['curso'], function(key, value){
                if(key == 'area_id' || key == 'dificultad_id' || key == 'vigente'){
                    $('select[name="'+key+'"]').val(value);
                }else if(key != 'logo' && key != 'descripcion'){
                    $('input[name="'+key+'"]').val(value);
                }else if(key == 'descripcion'){
                    $('textarea[name="'+key+'"]').val(value);
                }
            });
            $('#msg-update').css('display', 'none');
            $('#form-update').css('display', 'block');
            $('#form-update').attr('data-id', codigoCurso);
        });
    });

    // Llenar Form -> Eliminar
    $(document).on('click', 'button[data-target="#destroy"]', function(e){
        var codigoCurso = $(this).attr('data-codigo');
        var url = '/admin/curso/' + codigoCurso + '/edit';
        var data = 'curso=' + codigoCurso;
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
            $('#question-destroy').html("¿Está seguro de eliminar el curso: <i>"+ response['curso']['nombre'] +"</i>?<br/><h6>* El curso quedará archivada por seguridad, esto implica que no podrá utilizar este código de curso: <i>"+ response['curso']['codigo'] +"</i> para asignarselo a otro.</h6>");
            $('#msg-destroy').css('display', 'none');
            $('#form-destroy').css('display', 'block');
            $('#form-destroy').attr('data-id', codigoCurso);
        });
    });

    // Llenar Form -> Upload
    $(document).on('click', 'button[data-target="#upload"]', function(e){
        var codigoCurso = $(this).attr('data-codigo');
        var url = '/admin/curso/' + codigoCurso + '/edit';
        var data = 'curso=' + codigoCurso;
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
            $('#form-upload').attr('data-id', codigoCurso);
            if(response['curso']['logo'] != null && response['curso']['logo'] != ''){
                $('#logo-nombre').html(response['curso']['logo']);
                $('#logo-success').html('Nombre del Archivo');
            }else{
                $('#logo-nombre').html('');
                $('#logo-success').html('');
            }
        });
    });

    // Llenar Form -> Upload Contenido
    $(document).on('click', 'button[data-target="#upload_contenido"]', function(e){
        var codigoCurso = $(this).attr('data-codigo');
        var url = '/admin/curso/' + codigoCurso + '/edit';
        var data = 'curso=' + codigoCurso;
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            data: data,
            beforeSend: function(e){
                $('#msg-upload-contenido').css('display', 'block');
                $('#form-upload-contenido').css('display', 'none');
            }
        }).done(function (response){
            $('#msg-upload-contenido').css('display', 'none');
            $('#form-upload-contenido').css('display', 'block');
            $('#form-upload-contenido').attr('data-id', codigoCurso);
            if(response['curso']['contenido'] != null && response['curso']['contenido'] != ''){
                $('#contenido-nombre').html(response['curso']['contenido']);
                $('#contenido-success').html('Nombre del Archivo');
            }else{
                $('#contenido-nombre').html('');
                $('#contenido-success').html('');
            }
        });
    });
</script>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <nav class="navbar navbar-default">
               <div class="container">
                   <div class="navbar-header">
                       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-panel" aria-expanded="false">
                           <span class="sr-only">Toggle navigation</span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>
                       <a href="{{ route('admin.alumno.getshow', $alumno->id) }}" class="navbar-brand">
                           <i class="fa fa-btn fa-user"></i>({{ $alumno->persona->codigo }}) {{ $alumno->persona->primer_apellido }} {{ $alumno->persona->segundo_apellido }} {{ $alumno->persona->nombres }}
                       </a>
                   </div>

               </div>
            </nav>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-5">

                    </div>
                    <div class="col-md-7">
                        {{ $alumno->biografia }}
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-list-alt"></i>CI:</strong><br/>
                        {{ $alumno->persona->numero_ci }} {{ $alumno->persona->expedicion->codigo }}
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-envelope"></i>Correo Electrónico Personal:</strong><br/>
                        <a href="mailto:{{ $alumno->persona->email }}">{{ $alumno->persona->email }}</a>
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-graduation-cap"></i>Profesión(s):</strong><br/>
                        @foreach($alumno->persona->profesiones as $profesion)
                        {{ $profesion->grado->abreviatura }} {{ $profesion->titulo }}<br/>
                        @endforeach
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-birthday-cake"></i>Edad:</strong><br/>
                        {{ $alumno->persona->fecha_nacimiento->age }} años ({{ $alumno->persona->fecha_nacimiento->formatLocalized('%d-%B-%Y') }})
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-venus-mars"></i>Género:</strong><br/>
                        @if($alumno->persona->genero == 'femenino')
                        <i class="fa fa-btn fa-venus"></i>Femenino
                        @else
                        <i class="fa fa-btn fa-mars"></i>Masculino
                        @endif
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-mobile-phone"></i>Teléfono personal:</strong><br/>
                        {{ $alumno->persona->telefono_1 }}
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-phone"></i>Teléfono de referencia:</strong><br/>
                        {{ $alumno->persona->telefono_2 }}
                    </div>
                    <div class="col-md-3">
                        <strong>Dirección:</strong><br/>
                        {{ $alumno->persona->direccion }}
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-6">
                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de creación: </strong>{{ $alumno->created_at->formatLocalized('%d-%B-%Y') }} ({{ $alumno->created_at->diffForHumans() }})
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de modificación: </strong>
                        @if($alumno->updated_at > $alumno->persona->updated_at)
                        {{ $alumno->updated_at->formatLocalized('%d-%B-%Y') }} ({{ $alumno->updated_at->diffForHumans() }})
                        @else
                        {{ $alumno->persona->updated_at->formatLocalized('%d-%B-%Y') }} ({{ $alumno->persona->updated_at->diffForHumans() }})
                        @endif
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#attach_carrera" data-id="{{ $alumno->id }}" title="Inscribir a Carrera (Cronograma)">
                            <i class="fa fa-btn fa-calendar"></i>Inscribir a Carrera (Cronograma)
                        </button>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#attach_curso" data-id="{{ $alumno->id }}" title="Inscribir a Curso (Cronograma)">
                            <i class="fa fa-btn fa-calendar"></i>Inscribir a Curso (Cronograma)
                        </button>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#attach_curso_personalizado" data-id="{{ $alumno->id }}" title="Inscribir a Curso (Libre o Personalizado)">
                            <i class="fa fa-btn fa-cube"></i>Inscribir a Curso (Libre o Personalizado)
                        </button>
                    </div>
                </div>
                <hr/>

                <h3>
                    <i class="fa fa-btn fa-cube"></i>Cursos:
                </h3>
                @if($alumno->inscripciones->count() > 0)
                <div class="panel-group" id="cursos_cronograma" role="tablist" aria-multiselectable="true">
                    @foreach($alumno->inscripciones as $inscripcion)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading_curso_{{ $inscripcion->id }}">
                            <div class="row">
                                <h3 class="panel-title col-md-10" style="margin-top:5px;">
                                    <a role="button" data-toggle="collapse" data-parent="#cursos_cronograma" href="#collapse_curso_{{ $inscripcion->id }}" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="fa fa-btn fa-calendar"></i>({{ $inscripcion->lanzamientoCurso->curso->codigo }}) {{ $inscripcion->lanzamientoCurso->curso->nombre }}
                                    </a>
                                    <small>(Inscripción: {{ $inscripcion->updated_at->diffForHumans() }})</small>
                                </h3>
                                <div class="btn-group col-md-2" role="group" aria-label="Center Align">
                                    <a href="{{ route('admin.reporte.boletaInscripcion', $inscripcion->id) }}" target="_blank" type="button" class="btn btn-sm btn-default" title="Imprimir boleta de Inscripción">
                                        <i class="fa fa-print"></i>
                                        <span class="sr-only">Imprimir boleta de Inscripción</span>
                                    </a>
                                    @if($inscripcion->historial)
                                    <button type="button" class="btn btn-sm btn-default" title="Curso Finalizado">
                                        <i class="fa fa-btn fa-check"></i>Finalizado
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#destroy-inscripcion-curso" data-id="{{ $inscripcion->id }}" title="Eliminar capítulo">
                                        <i class="fa fa-trash"></i>
                                        <span class="sr-only">Eliminar inscripción</span>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="panel-collapse collapse" role="tabpanel" id="collapse_curso_{{ $inscripcion->id }}" aria-labelledby="heading_{{ $inscripcion->id }}">
                            <div class="panel-body">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <strong><i class="fa fa-btn fa-cube"></i>Tipo de Curso:</strong><br/>
                                        {{ $inscripcion->lanzamientoCurso->cronograma->tipo->nombre }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de Inicio:</strong><br/>
                                        {{ $inscripcion->lanzamientoCurso->cronograma->inicio->formatLocalized('%d-%B-%Y') }} ({{ $inscripcion->lanzamientoCurso->cronograma->inicio->diffForHumans() }})
                                    </div>
                                    <div class="col-md-4">
                                        <strong><i class="fa fa-btn fa-money"></i>Costo Total:</strong><br/>
                                        Bs {{ $inscripcion->lanzamientoCurso->costo }}
                                    </div>
                                </div>
                                <hr/>
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <strong><i class="fa fa-btn fa-user-plus"></i>Docente(s):</strong><br/>
                                        @if($inscripcion->lanzamientoCurso->docentes()->count() > 0)
                                        @foreach($inscripcion->lanzamientoCurso->docentes as $docente)
                                        {{ $docente->persona->primer_apellido }} {{ $docente->persona->segundo_apellido }} {{ $docente->persona->nombres }} <br/>
                                        @endforeach
                                        @else
                                        Sin Docente Asignado
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de Inscripción:</strong><br/>
                                        {{ $inscripcion->created_at->formatLocalized('%d-%B-%Y') }} ({{ $inscripcion->created_at->diffForHumans() }})
                                    </div>
                                    <div class="col-md-4">
                                        <strong><i class="fa fa-btn fa-file-text-o"></i>Observaciones de la inscripción:</strong><br/>
                                        @if($inscripcion->observaciones == null)
                                        Sin observaciones
                                        @else
                                        {{ $inscripcion->observaciones }}
                                        @endif
                                    </div>
                                </div>
                                <hr/>
                                <div class="row text-center">
                                    @if($inscripcion->historial)
                                    <div class="col-md-3">
                                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de Finalización:</strong><br/>
                                        {{ $inscripcion->historial->fecha_finalizacion->formatLocalized('%d-%B-%Y') }} ({{ $inscripcion->historial->fecha_finalizacion->diffForHumans() }})
                                    </div>
                                    <div class="col-md-3">
                                        <strong><i class="fa fa-btn fa-mortar-board"></i>Nota:</strong><br/>
                                        {{ $inscripcion->historial->nota }}%
                                        @if($inscripcion->historial->nota >= 71)
                                        (Aprobado)
                                        @else
                                        (Reprobado)
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <strong><i class="fa fa-btn fa-address-card-o"></i>¿Se extendió certificado?:</strong><br/>
                                        @if($inscripcion->historial->certificado)
                                        Si
                                        @else
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#attach_certificado" data-id="{{ $inscripcion->historial->id }}" title="Extender Certificado">
                                            <i class="fa fa-btn fa-address-card-o"></i>Extender Certificado
                                        </button>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <strong><i class="fa fa-btn fa-file-text-o"></i>Observaciones del historial:</strong><br/>
                                        @if($inscripcion->historial->observaciones == null)
                                        Sin observaciones
                                        @else
                                        {{ $inscripcion->historial->observaciones }}
                                        @endif
                                    </div>
                                    @else
                                    <div class="col md 12">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#attach_historial" data-id="{{ $inscripcion->id }}" title="Finalizar Curso">
                                            <i class="fa fa-btn fa-check"></i>Finalizar Curso
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                <hr/>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
                @else
                <div class="panel-body">
                    <div class="alert alert-warning" role="alert">
                        <i class="fa fa-btn fa-database"></i>
                        <strong>Mensaje!!!</strong> El alumno no se inscribió a ningún curso. Intenta <strong>inscribir al alumno a un curso</strong>
                    </div>
                </div>
                @endif

                <h3>
                    <i class="fa fa-btn fa-cubes"></i>Carreras:
                </h3>
                @if($alumno->inscripcionesCarrera->count() > 0)
                <div class="panel-group" id="carreras_cronograma" role="tablist" aria-multiselectable="true">
                    @foreach($alumno->inscripcionesCarrera as $inscripcion)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading_carrera_{{ $inscripcion->id }}">
                            <div class="row">
                                <h3 class="panel-title col-md-10" style="margin-top:5px;">
                                    <a role="button" data-toggle="collapse" data-parent="#carreras_cronograma" href="#collapse_carrera_{{ $inscripcion->id }}" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="fa fa-btn fa-calendar"></i>({{ $inscripcion->lanzamientoCarrera->carrera->codigo }}) {{ $inscripcion->lanzamientoCarrera->carrera->nombre }}
                                    </a>
                                    <small>(Inscripción: {{ $inscripcion->updated_at->diffForHumans() }})</small>
                                </h3>
                                <div class="btn-group col-md-2" role="group" aria-label="Center Align">
                                    <a href="{{ route('admin.reporte.boletaInscripcionCarrera', $inscripcion->id) }}" target="_blank" type="button" class="btn btn-sm btn-default" title="Imprimir boleta de Inscripción de Carrera">
                                        <i class="fa fa-print"></i>
                                        <span class="sr-only">Imprimir boleta de Inscripción de Carrera</span>
                                    </a>
                                    @if($inscripcion->modulos()->count() == 0)
                                    <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#destroy-inscripcion-carrera" data-id="{{ $inscripcion->id }}" title="Eliminar capítulo">
                                        <i class="fa fa-trash"></i>
                                        <span class="sr-only">Eliminar inscripción</span>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="panel-collapse collapse" role="tabpanel" id="collapse_carrera_{{ $inscripcion->id }}" aria-labelledby="heading_{{ $inscripcion->id }}">
                            <div class="panel-body">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <strong><i class="fa fa-btn fa-cube"></i>Tipo de Curso:</strong><br/>
                                        {{ $inscripcion->lanzamientoCarrera->cronograma->tipo->nombre }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de Inicio:</strong><br/>
                                        {{ $inscripcion->lanzamientoCarrera->cronograma->inicio->formatLocalized('%d-%B-%Y') }} ({{ $inscripcion->lanzamientoCarrera->cronograma->inicio->diffForHumans() }})
                                    </div>
                                    <div class="col-md-4">
                                        <strong><i class="fa fa-btn fa-money"></i>Matrícula:</strong><br/>
                                        Bs {{ $inscripcion->lanzamientoCarrera->matricula }}
                                    </div>
                                </div>
                                <hr/>
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <strong><i class="fa fa-btn fa-money"></i>Mensualidad:</strong><br/>
                                        Bs {{ $inscripcion->lanzamientoCarrera->mensualidad }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de Inscripción:</strong><br/>
                                        {{ $inscripcion->created_at->formatLocalized('%d-%B-%Y') }} ({{ $inscripcion->created_at->diffForHumans() }})
                                    </div>
                                    <div class="col-md-4">
                                        <strong><i class="fa fa-btn fa-file-text-o"></i>Observaciones de la inscripción:</strong><br/>
                                        @if($inscripcion->observaciones == null)
                                        Sin observaciones
                                        @else
                                        {{ $inscripcion->observaciones }}
                                        @endif
                                    </div>
                                </div>
                                <hr/>
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#attach_modulo" data-id="{{ $alumno->id }}" data-lanzamiento="{{ $inscripcion->id }}" title="Agregar módulo">
                                            <i class="fa fa-btn fa-cube"></i>Agregar módulo <span class="badge">{{ $inscripcion->modulos()->count() }}</span>
                                        </button>
                                    </div>
                                </div>
                                <hr/>
                                @foreach($inscripcion->modulos as $modulo)
                                <div class="row text-center">
                                    <div class="col-md-2">
                                        <strong><i class="fa fa-btn fa-cube"></i>Módulo
                                        </strong><br/>
                                        ({{ $modulo->lanzamientoCurso->curso->codigo }}) {{ $modulo->lanzamientoCurso->curso->nombre }}
                                    </div>
                                    <div class="col-md-2">
                                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de Inicio:</strong><br/>
                                        {{ $modulo->lanzamientoCurso->cronograma->inicio->formatLocalized('%d-%B-%Y') }} ({{ $modulo->lanzamientoCurso->cronograma->inicio->diffForHumans() }})
                                    </div>
                                    @if($modulo->historial)
                                    <div class="col-md-2">
                                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de Finalización:</strong><br/>
                                        {{ $modulo->historial->fecha_finalizacion->formatLocalized('%d-%B-%Y') }} ({{ $modulo->historial->fecha_finalizacion->diffForHumans() }})
                                    </div>
                                    <div class="col-md-2">
                                        <strong><i class="fa fa-btn fa-mortar-board"></i>Nota:</strong><br/>
                                        {{ $modulo->historial->nota }}%
                                        @if($modulo->historial->nota >= 71)
                                        (Aprobado)
                                        @else
                                        (Reprobado)
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <strong><i class="fa fa-btn fa-address-card-o"></i>¿Se extendió certificado?:</strong><br/>
                                        @if($modulo->historial->certificado)
                                        Si
                                        @else
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#attach_certificado" data-id="{{ $modulo->historial->id }}" title="Extender Certificado">
                                            <i class="fa fa-btn fa-address-card-o"></i>Extender Certificado
                                        </button>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <strong><i class="fa fa-btn fa-file-text-o"></i>Observaciones del historial:</strong><br/>
                                        @if($modulo->historial->observaciones == null)
                                        Sin observaciones
                                        @else
                                        {{ $modulo->historial->observaciones }}
                                        @endif
                                    </div>
                                    @else
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#attach_historial" data-id="{{ $modulo->id }}" title="Finalizar Módulo">
                                            <i class="fa fa-btn fa-check"></i>Finalizar Módulo
                                        </button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#destroy-inscripcion-modulo" data-id="{{ $modulo->id }}" data-id-carrera="{{ $inscripcion->id }}" title="Eliminar Módulo">
                                            <i class="fa fa-btn fa-trash"></i>Eliminar Módulo
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                <hr/>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
                @else
                <div class="panel-body">
                    <div class="alert alert-warning" role="alert">
                        <i class="fa fa-btn fa-database"></i>
                        <strong>Mensaje!!!</strong> El alumno no se inscribió a ningúna carrera. Intenta <strong>inscribir al alumno a una carrera</strong>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

@include('admin.alumno.partial.attach_curso')
@include('admin.alumno.partial.attach_carrera')
@include('admin.alumno.partial.attach_modulo')
@include('admin.alumno.partial.attach_curso_personalizado')
@include('admin.alumno.partial.attach_historial')
@include('admin.alumno.partial.attach_certificado')

@include('admin.alumno.partial.destroy_inscripcion_curso')
@include('admin.alumno.partial.destroy_inscripcion_carrera')
@include('admin.alumno.partial.destroy_inscripcion_modulo')

@endsection

@section('script')
@parent
<script>
    // Reset Form
    function resetForm(obj){
        obj.find('form')[0].reset();
        $('.help-block>strong').html('');
        $('.has-error').removeClass('has-error');
    }

    // Llenar Form -> Attach Curso
    $(document).on('click', 'button[data-target="#attach_curso"]', function(e){
        var idAlumno = $(this).attr('data-id');
        var url = '{{ route('admin.cronograma.cursosdisponibles') }}';
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            beforeSend: function(e){
                $('#msg-attach-curso').css('display', 'block');
                $('#form-postattachcurso').css('display', 'none');
            }
        }).done(function (response){
            var selectCursos = $('select#lanzamiento_curso_id').empty().append("<option value=''>Seleccione un Curso</option>");
            $.each(response['cursos'], function(key, value){
                selectCursos.append("<option value='"+key+"'>"+value+"</option>");
            });
            var selectPublicidades = $('select#publicidad_id').empty().append("<option value=''>Seleccione una opción</option>");
            $.each(response['publicidades'], function(key, value){
                selectPublicidades.append("<option value='"+key+"'>"+value+"</option>");
            });
            $('#msg-attach-curso').css('display', 'none');
            $('#form-postattachcurso').css('display', 'block');
            $('#form-postattachcurso').attr('data-id', idAlumno);
        });
    });

    // Llenar Form -> Attach Carrera
    $(document).on('click', 'button[data-target="#attach_carrera"]', function(e){
        var idAlumno = $(this).attr('data-id');
        var url = '{{ route('admin.cronograma.carrerasdisponibles') }}';
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            beforeSend: function(e){
                $('#msg-attach-carrera').css('display', 'block');
                $('#form-postattachcarrera').css('display', 'none');
            }
        }).done(function (response){
            var selectCarreras = $('select#lanzamiento_carrera_id').empty().append("<option value=''>Seleccione una Carrera</option>");
            $.each(response['carreras'], function(key, value){
                selectCarreras.append("<option value='"+key+"'>"+value+"</option>");
            });
            $('#msg-attach-carrera').css('display', 'none');
            $('#form-postattachcarrera').css('display', 'block');
            $('#form-postattachcarrera').attr('data-id', idAlumno);
        });
    });

    // Llenar Form -> Attach Módulo
    $(document).on('click', 'button[data-target="#attach_modulo"]', function(e){
        var idAlumno = $(this).attr('data-id');
        var idLanzamiento = $(this).attr('data-lanzamiento');
        var url = '{{ route('admin.cronograma.cursosdisponibles') }}';
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            beforeSend: function(e){
                $('#msg-attach-modulo').css('display', 'block');
                $('#form-postattachmodulo').css('display', 'none');
            }
        }).done(function (response){
            var selectCursos = $('select#modulo_id').empty().append("<option value=''>Seleccione un Curso</option>");
            $.each(response['cursos'], function(key, value){
                selectCursos.append("<option value='"+key+"'>"+value+"</option>");
            });
            var selectPublicidades = $('select#publicidad_id').empty().append("<option value=''>Seleccione una opción</option>");
            $.each(response['publicidades'], function(key, value){
                selectPublicidades.append("<option value='"+key+"'>"+value+"</option>");
            });
            $('#msg-attach-modulo').css('display', 'none');
            $('#form-postattachmodulo').css('display', 'block');
            $('#form-postattachmodulo').attr('data-id', idAlumno);
            $('#form-postattachmodulo').attr('data-lanzamiento', idLanzamiento);
        });
    });

    // Llenar Form -> Attach Curso Personalizado
    $(document).on('click', 'button[data-target="#attach_curso_personalizado"]', function(e){
        var idAlumno = $(this).attr('data-id');
        var url = '{{ route('admin.cronograma.cursostodos') }}';
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            beforeSend: function(e){
                $('#msg-attach-personalizado').css('display', 'block');
                $('#form-postattachcurso').css('display', 'none');
            }
        }).done(function (response){
            var selectCursos = $('select#curso_codigo').empty().append("<option value=''>Seleccione un Curso</option>");
            $.each(response['cursos'], function(key, value){
                selectCursos.append("<option value='"+key+"'>"+value+"</option>");
            });
            var selectPublicidades = $('select#publicidad_id').empty().append("<option value=''>Seleccione una opción</option>");
            $.each(response['publicidades'], function(key, value){
                selectPublicidades.append("<option value='"+key+"'>"+value+"</option>");
            });
            var selectTipos = $('select#tipo_id').empty().append("<option value=''>Seleccione tipo</option>");
            $.each(response['tipos'], function(key, value){
                selectTipos.append("<option value='"+key+"'>"+value+"</option>");
            });
            $('#msg-attach-personalizado').css('display', 'none');
            $('#form-postattachcursopersonalizado').css('display', 'block');
            $('#form-postattachcursopersonalizado').attr('data-id', idAlumno);
        });
    });

    // Llenar Form -> Attach Historial
    $(document).on('click', 'button[data-target="#attach_historial"]', function(e){
        var idInscripcion = $(this).attr('data-id');
        $('#msg-attach-historial').css('display', 'block');
        $('#form-postattachhistorial').css('display', 'none');

        $('#msg-attach-historial').css('display', 'none');
        $('#form-postattachhistorial').css('display', 'block');
        $('#form-postattachhistorial').attr('data-id', idInscripcion);
    });

    // Llenar Form -> Attach Certificado
    $(document).on('click', 'button[data-target="#attach_certificado"]', function(e){
        var idHistorial = $(this).attr('data-id');
        $('#msg-attach-certificado').css('display', 'block');
        $('#form-postattachcertificado').css('display', 'none');

        $('#msg-attach-certificado').css('display', 'none');
        $('#form-postattachcertificado').css('display', 'block');
        $('#form-postattachcertificado').attr('data-id', idHistorial);
    });

    // Llenar Form -> Eliminar Inscripción Curso
    $(document).on('click', 'button[data-target="#destroy-inscripcion-curso"]', function(e){
        var idInscripcion = $(this).attr('data-id');
        var url = '/admin/inscripcion/' + idInscripcion + '/edit';
        var data = 'id=' + idInscripcion;
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            data: data,
            beforeSend: function(e){
                $('#msg-destroy-inscripcion-curso').css('display', 'block');
                $('#form-destroy-inscripcion-curso').css('display', 'none');
            }
        }).done(function (response){
            $('#question-destroy-inscripcion-curso').html("¿Está seguro de eliminar la inscripción al curso: <i>"+ response['curso']['nombre'] +"</i>?<br/><h6>* La inscripción quedará archivada por seguridad.</h6>");
            $('#msg-destroy-inscripcion-curso').css('display', 'none');
            $('#form-destroy-inscripcion-curso').css('display', 'block');
            $('#form-destroy-inscripcion-curso').attr('data-id', idInscripcion);
        });
    });

    // Llenar Form -> Eliminar Inscripción Carrera
    $(document).on('click', 'button[data-target="#destroy-inscripcion-carrera"]', function(e){
        var idInscripcion = $(this).attr('data-id');
        var url = '/admin/inscripcioncarrera/' + idInscripcion + '/edit';
        var data = 'id=' + idInscripcion;
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            data: data,
            beforeSend: function(e){
                $('#msg-destroy-inscripcion-carrera').css('display', 'block');
                $('#form-destroy-inscripcion-carrera').css('display', 'none');
            }
        }).done(function (response){
            $('#question-destroy-inscripcion-carrera').html("¿Está seguro de eliminar la inscripción a la carrera: <i>"+ response['carrera']['nombre'] +"</i>?<br/><h6>* La inscripción quedará archivada por seguridad.</h6>");
            $('#msg-destroy-inscripcion-carrera').css('display', 'none');
            $('#form-destroy-inscripcion-carrera').css('display', 'block');
            $('#form-destroy-inscripcion-carrera').attr('data-id', idInscripcion);
        });
    });

    // Llenar Form -> Eliminar Inscripción Módulo
    $(document).on('click', 'button[data-target="#destroy-inscripcion-modulo"]', function(e){
        var idInscripcion = $(this).attr('data-id');
        var idInscripcionCarrera = $(this).attr('data-id-carrera');
        var url = '/admin/inscripcion/' + idInscripcion + '/edit';
        var data = 'id=' + idInscripcion;
        $.ajax({
            url: url,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            data: data,
            beforeSend: function(e){
                $('#msg-destroy-inscripcion-modulo').css('display', 'block');
                $('#form-destroy-inscripcion-modulo').css('display', 'none');
            }
        }).done(function (response){
            $('#question-destroy-inscripcion-modulo').html("¿Está seguro de eliminar la inscripción al curso: <i>"+ response['curso']['nombre'] +"</i>?<br/><h6>* La inscripción quedará archivada por seguridad.</h6>");
            $('#msg-destroy-inscripcion-modulo').css('display', 'none');
            $('#form-destroy-inscripcion-modulo').css('display', 'block');
            $('#form-destroy-inscripcion-modulo').attr('data-id', idInscripcion);
            $('#form-destroy-inscripcion-modulo').attr('data-id-carrera', idInscripcionCarrera);
        });
    });

    // Validation
    function validation(response){
        if(response.responseJSON['lanzamiento_curso_id']){
            $('.wrapper-lanzamiento_curso_id').addClass('has-error');
            $('.wrapper-lanzamiento_curso_id .help-block>strong').html(response.responseJSON['lanzamiento_curso_id']);
        }else{
            $('.wrapper-lanzamiento_curso_id').removeClass('has-error');
            $('.wrapper-lanzamiento_curso_id .help-block>strong').html('');
        }
        if(response.responseJSON['lanzamiento_carrera_id']){
            $('.wrapper-lanzamiento_carrera_id').addClass('has-error');
            $('.wrapper-lanzamiento_carrera_id .help-block>strong').html(response.responseJSON['lanzamiento_carrera_id']);
        }else{
            $('.wrapper-lanzamiento_carrera_id').removeClass('has-error');
            $('.wrapper-lanzamiento_carrera_id .help-block>strong').html('');
        }
        if(response.responseJSON['curso_codigo']){
            $('.wrapper-curso_codigo').addClass('has-error');
            $('.wrapper-curso_codigo .help-block>strong').html(response.responseJSON['curso_codigo']);
        }else{
            $('.wrapper-curso_codigo').removeClass('has-error');
            $('.wrapper-curso_codigo .help-block>strong').html('');
        }
        if(response.responseJSON['tipo_id']){
            $('.wrapper-tipo_id').addClass('has-error');
            $('.wrapper-tipo_id .help-block>strong').html(response.responseJSON['tipo_id']);
        }else{
            $('.wrapper-tipo_id').removeClass('has-error');
            $('.wrapper-tipo_id .help-block>strong').html('');
        }
        if(response.responseJSON['inicio']){
            $('.wrapper-inicio').addClass('has-error');
            $('.wrapper-inicio .help-block>strong').html(response.responseJSON['inicio']);
        }else{
            $('.wrapper-inicio').removeClass('has-error');
            $('.wrapper-inicio .help-block>strong').html('');
        }
        if(response.responseJSON['publicidad_id']){
            $('.wrapper-publicidad_id').addClass('has-error');
            $('.wrapper-publicidad_id .help-block>strong').html(response.responseJSON['publicidad_id']);
        }else{
            $('.wrapper-publicidad_id').removeClass('has-error');
            $('.wrapper-publicidad_id .help-block>strong').html('');
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
        if(response.responseJSON['fecha_finalizacion']){
            $('.wrapper-fecha_finalizacion').addClass('has-error');
            $('.wrapper-fecha_finalizacion .help-block>strong').html(response.responseJSON['fecha_finalizacion']);
        }else{
            $('.wrapper-fecha_finalizacion').removeClass('has-error');
            $('.wrapper-fecha_finalizacion .help-block>strong').html('');
        }
        if(response.responseJSON['nota']){
            $('.wrapper-nota').addClass('has-error');
            $('.wrapper-nota .help-block>strong').html(response.responseJSON['nota']);
        }else{
            $('.wrapper-nota').removeClass('has-error');
            $('.wrapper-nota .help-block>strong').html('');
        }
        if(response.responseJSON['certificado']){
            $('.wrapper-certificado').addClass('has-error');
            $('.wrapper-certificado .help-block>strong').html(response.responseJSON['certificado']);
        }else{
            $('.wrapper-certificado').removeClass('has-error');
            $('.wrapper-certificado .help-block>strong').html('');
        }
        if(response.responseJSON['observaciones']){
            $('.wrapper-observaciones').addClass('has-error');
            $('.wrapper-observaciones .help-block>strong').html(response.responseJSON['observaciones']);
        }else{
            $('.wrapper-observaciones').removeClass('has-error');
            $('.wrapper-observaciones .help-block>strong').html('');
        }
    }
</script>
@endsection

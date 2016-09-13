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
                       <a href="{{ route('admin.cronograma.show', $cronograma->id) }}" class="navbar-brand">
                           <i class="fa fa-btn fa-calendar"></i>({{ $cronograma->curso->codigo }}) {{ $cronograma->curso->nombre }}
                           @if($cronograma->promocion)
                            PROMO
                           @endif
                       </a>
                   </div>
               </div>
            </nav>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-5">

                    </div>
                    <div class="col-md-7">
                        {{ $cronograma->curso->eslogan }}<br/><br/>
                        {{ $cronograma->curso->descripcion }}
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-4">
                        @if($cronograma->inicio_carrera)
                        <strong><i class="fa fa-btn fa-cubes"></i>Modo de inicio:</strong> Carrera
                        @else
                        <strong><i class="fa fa-btn fa-cube"></i>Modo de inicio:</strong> Curso
                        @endif
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa fa-btn fa-calendar-check-o"></i>Inicio:</strong> {{ utf8_encode($cronograma->inicio->formatLocalized('%A, %d de %B de %Y, %H:%M')) }} ({{ $cronograma->inicio->diffForHumans() }})
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa fa-btn fa-clock-o"></i>Duración:</strong> {{ $duracion }}
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-money"></i>Costo: </strong>Bs {{ $cronograma->costo or '-' }}
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-money"></i>Matrícula: </strong>
                        @if($cronograma->matricula)
                        Bs {{ $cronograma->matricula }}
                        @else
                        -
                        @endif
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-money"></i>Costo Mensual: </strong>
                        @if($cronograma->costo_mensual)
                        Bs {{ $cronograma->costo_mensual }}
                        @else
                        -
                        @endif
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-sliders"></i>¿Se muestra en slider?: </strong>
                        @if($cronograma->slider)
                        Si
                        @else
                        No
                        @endif
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-6">
                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de creación: </strong>{{ $cronograma->created_at->formatLocalized('%d-%B-%Y') }} ({{ $cronograma->created_at->diffForHumans() }})
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de modificación: </strong>{{ $cronograma->updated_at->formatLocalized('%d-%B-%Y') }} ({{ $cronograma->updated_at->diffForHumans() }})
                    </div>
                </div>
                <hr/>
                @if($cronograma->inscripciones()->count() > 0)
                <table class="table table-hover">
                    <tr>
                        <th>Código</th>
                        <th>Nombre Completo</th>
                        <th>Correo Elctrónico</th>
                        <th>CI</th>
                        <th>Fecha de Inscripción</th>
                        <th></th>
                    </tr>
                </table>
                @else
                <div class="alert alert-warning" role="alert">
                    <i class="fa fa-btn fa-database"></i>
                    <strong>Oops!!!</strong> No se encontraron alumnos incritos a este cronograma. Intenta <strong>inscribir a un alumno</strong>
                </div>
                @endif
                <hr/>
                <table class="table table-hover">
                    <tr class="active" rowspan="5">

                    </tr>
                    <tr class="info">
                        <th>Código</th>
                        <th>Nombre Completo</th>
                        <th>Correo Elctrónico</th>
                        <th>CI</th>
                        <th></th>
                    </tr>
                    @foreach($alumnos as $alumno)
                    <tr class="active">
                        <td>{{ $alumno->persona->codigo }}</td>
                        <td>{{ $alumno->persona->primer_apellido }} {{ $alumno->persona->segundo_apellido }} {{ $alumno->persona->nombres }}</td>
                        <td>
                            <a href="mailto:{{ $alumno->persona->email }}">
                                <i class="fa fa-btn fa-envelope"></i>{{ $alumno->persona->email }}
                            </a>
                        </td>
                        <td>{{ $alumno->persona->numero_ci }} {{ $alumno->persona->expedicion->codigo }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Center Align">
                                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#inscribir" data-id="{{ $alumno->id }}" title="Inscribir">
                                    <i class="fa fa-btn fa-user"></i>Inscribir
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" class="text-center">
                            {{ $alumnos->render() }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.cronograma.partial.inscripcion')
@endsection

@section('script')
@parent
<script>
    // Llenar Form -> Editar
    $(document).on('click', 'button[data-target="#inscribir"]', function(e){
        var url = '/admin/cronograma/{{ $cronograma->id }}/edit';
        var data = 'cronograma={{ $cronograma->id }}';
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
            $('#lblCronograma').html(response['cronograma']['codigo']);
        });
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

        });
    });
</script>
@endsection

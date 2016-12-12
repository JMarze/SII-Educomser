@extends('layouts.frontend')

@section('title', 'Educomser SRL - Cronograma Vigente')

@section('content')

<div class="container">
    <div class="row text-center">
        <div class="col-md-12">
            <h2>
                <i class="fa fa-btn fa-calendar"></i><strong>Cronograma Vigente</strong>
            </h2>
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-md-12">
            <h3><i class="fa fa-btn fa-cubes"></i>Carreras</h3>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <tr>
                <th class="text-center">Especialista en</th>
                <th class="text-center">Módulos</th>
                <th class="text-center">Duración</th>
                <th class="text-center">Inicio</th>
                <th class="text-center">Horario</th>
                <th class="text-center">Preinscripción</th>
            </tr>
            @foreach($lanzamientosCarrera as $lanzamientoCarrera)
            <tr>
                <td>{{ $lanzamientoCarrera->carrera->nombre }}</td>
                <td>
                    @foreach($lanzamientoCarrera->carrera->cursos as $curso)
                    <a href="{{ route('curso.ver', $curso->codigo) }}">{{ $curso->nombre }}</a><br/>
                    @endforeach
                </td>
                <td class="text-center">{{ $duraciones_carrera[$lanzamientoCarrera->carrera_codigo] }}</td>
                <td class="text-center">
                    {{ $lanzamientoCarrera->cronograma->inicio->formatLocalized('%d de %B') }}<br/>
                    ({{ $lanzamientoCarrera->cronograma->inicio->diffForHumans() }})
                </td>
                <td class="text-center">
                    Lun. a Vie. de {{ $lanzamientoCarrera->cronograma->inicio->formatLocalized('%H:%M') }} a {{ $lanzamientoCarrera->cronograma->inicio->addMinute($lanzamientoCarrera->cronograma->duracion_clase * 60)->formatLocalized('%H:%M') }}
                </td>
                <td class="text-center">
                    @if(!Auth::guest())
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#preinscripcion" data-id="{{ $lanzamientoCarrera->carrera->codigo }}" title="Realizar preinscripción">
                        <i class="fa fa-btn fa-check"></i>Realizar preinscripción
                    </button>
                    @else
                    Debes iniciar sesión o registrarte
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    <hr/>

    <div class="row">
        <div class="col-md-12">
            <h3><i class="fa fa-btn fa-cube"></i>Cursos</h3>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <tr>
                <th class="text-center">Curso de</th>
                <th class="text-center">Detalle</th>
                <th class="text-center">Duración</th>
                <th class="text-center">Inicio</th>
                <th class="text-center">Horario</th>
                <th class="text-center">Preinscripción</th>
            </tr>
            @foreach($lanzamientosCurso as $lanzamientoCurso)
            <tr>
                <td>
                    <a href="{{ route('curso.ver', $lanzamientoCurso->curso->codigo) }}">
                        {{ $lanzamientoCurso->curso->nombre }}
                    </a>
                </td>
                <td>
                    {{ $lanzamientoCurso->curso->eslogan }}
                </td>
                <td class="text-center">{{ $duraciones[$lanzamientoCurso->curso_codigo] }}</td>
                <td class="text-center">
                    {{ $lanzamientoCurso->cronograma->inicio->formatLocalized('%d de %B') }}<br/>
                    ({{ $lanzamientoCurso->cronograma->inicio->diffForHumans() }})
                </td>
                <td class="text-center">
                    @if($lanzamientoCurso->cronograma->tipo->nombre == 'Sábados')
                    Sábados de {{ $lanzamientoCurso->cronograma->inicio->formatLocalized('%H:%M') }} a {{ $lanzamientoCurso->cronograma->inicio->addMinute($lanzamientoCurso->cronograma->duracion_clase * 60)->formatLocalized('%H:%M') }}
                    @elseif($lanzamientoCurso->cronograma->tipo->nombre == 'Regular')
                    Lun. a Vie. de {{ $lanzamientoCurso->cronograma->inicio->formatLocalized('%H:%M') }} a {{ $lanzamientoCurso->cronograma->inicio->addMinute($lanzamientoCurso->cronograma->duracion_clase * 60)->formatLocalized('%H:%M') }}
                    @endif
                </td>
                <td class="text-center">
                    @if(!Auth::guest())
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#preinscripcion" data-id="{{ $lanzamientoCurso->curso->codigo }}" title="Realizar preinscripción">
                        <i class="fa fa-btn fa-check"></i>Realizar preinscripción
                    </button>
                    @else
                    Debes iniciar sesión o registrarte
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    <hr/>
</div>

@endsection


@section('script')
@parent
<script>
    $('li#cronograma').addClass('active');
</script>
@endsection

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
                       <a href="{{ route('admin.carrera.show', $carrera->codigo) }}" class="navbar-brand">
                           <i class="fa fa-btn fa-cubes"></i>({{ $carrera->codigo }}) {{ $carrera->nombre }}
                       </a>
                   </div>
               </div>
            </nav>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-5">

                    </div>
                    <div class="col-md-7">
                        <strong>Cursos disponibles:</strong><br/><br/>
                        @forelse($carrera->cursos as $curso)
                        <a href="{{ route('admin.curso.getshow', $curso->codigo) }}" class="btn btn-default">
                            <i class="fa fa-btn fa-cube"></i>({{ $curso->codigo }}) {{ $curso->nombre }}<br/>
                        </a>
                        @empty
                        <div class="alert alert-warning" role="alert">
                            <i class="fa fa-btn fa-warning"></i>
                            <strong>Oops!!!</strong> No se encontraron cursos vinculados a la carrera. Intenta <strong>agregar algunos cursos</strong>
                        </div>
                        @endforelse
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-4">
                        <strong><i class="fa fa-btn fa-paint-brush"></i>Color:</strong> <span class="label" style="background-color: {{ $carrera->color_hexa }};">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa fa-btn fa-money"></i>Costo Mensual:</strong> Bs {{ $carrera->costo_mensual }}
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa fa-btn fa-calendar"></i>Duración:</strong> {{ $carrera->cursos()->sum('horas_reales') }} hrs. ({{ $duracion }})
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-6">
                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de creación: </strong>{{ $carrera->created_at->formatLocalized('%d-%B-%Y') }} ({{ $carrera->created_at->diffForHumans() }})
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de modificación: </strong>{{ $carrera->updated_at->formatLocalized('%d-%B-%Y') }} ({{ $carrera->updated_at->diffForHumans() }})
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

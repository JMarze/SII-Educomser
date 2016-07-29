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
                        <strong><i class="fa fa-btn fa-calendar-check-o"></i>Inicio:</strong> {{ utf8_encode($cronograma->inicio->formatLocalized('%A, %d de %B de %Y')) }} ({{ $cronograma->inicio->diffForHumans() }})
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
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.frontend')

@section('title', 'Educomser SRL')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>
                <i class="fa fa-btn fa-cube"></i><strong>Curso de </strong>
                @if($curso->color_hexa != '')
                <span style="color:{{ $curso->color_hexa }}">
                @else
                <span>
                @endif
                    {{ $curso->nombre }}
                </span>
            </h2>
            <hr/>

            <h3 class="text-center">
                <i class="fa fa-quote-left"></i>
                &nbsp;&nbsp;&nbsp;{{ $curso->eslogan }}&nbsp;&nbsp;&nbsp;
                <i class="fa fa-quote-right"></i>
            </h3><br/>
            <h4 style="text-align:justify;">{{ $curso->descripcion }}</h4>
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-md-8">
            @if($curso->logo != null)
            <img src="{{ route('admin.curso.verlogo', ['nombreLogo' => $curso->logo]) }}" alt="" style="width:100%;"/>
            @else
            <img src="/img/sinlogo.png" alt="" style="width:100%;"/>
            @endif
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <h4><strong><i class="fa fa-btn fa-th-large"></i>Área</strong></h4>
                </div>
                <div class="col-md-5">
                    <h4>{{ $curso->area->nombre }}</h4>
                </div>
            </div>

            <hr/>

            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <h4><strong><i class="fa fa-btn fa-level-up"></i>Dificultad:</strong></h4>
                </div>
                <div class="col-md-5">
                    <h4>{{ $curso->dificultad->nombre }}</h4>
                </div>
            </div>

            <hr/>

            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <h4><strong><i class="fa fa-btn fa-clock-o"></i>Duración:</strong></h4>
                </div>
                <div class="col-md-5">
                    <h4>{{ $curso->horas_reales }} hrs.<br/>({{ $duracion }})</h4>
                </div>
            </div>

            <hr/>

            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <h4><strong><i class="fa fa-btn fa-check"></i>¿Vigente?</strong></h4>
                </div>
                <div class="col-md-5">
                    <h4>
                        @if($curso->vigente)
                        Si
                        @else
                        No
                        @endif
                    </h4>
                </div>
            </div>

        </div>
    </div>

    <hr/>

    <div class="row text-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="fb-like" data-href="{{ route('curso.ver', $curso->codigo) }}" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-md-6">
            <h3 class="text-center">
                <strong><i class="fa fa-btn fa-user-plus"></i>Docentes que dictaron el curso</strong>
            </h3>
            <br/>
            @if($curso->lanzamientosCurso->count() > 0)
            @foreach($curso->lanzamientosCurso as $lanzamientoCurso)
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row text-center">
                        @foreach($lanzamientoCurso->docentes as $docente)
                        <div class="col-md-4">
                            <div class="avatar" style="width:70px; height:70px; border-radius:50%; border:2px solid; margin:0 10px;">
                                <img src="" alt=""/>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4>{{ $docente->persona->primer_apellido }} {{ $docente->persona->segundo_apellido }} {{ $docente->persona->nombres }}</h4>
                            @foreach($docente->persona->profesiones as $profesion)
                            <h5><strong>{{ $profesion->grado->abreviatura }} {{ $profesion->titulo }}</strong></h5>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <div class="col-md-6">
            <h3 class="text-center">
                <strong><i class="fa fa-btn fa-graduation-cap"></i>Aprenderás</strong>
            </h3>
            <br/>
            @if($curso->capitulos->count() > 0)
            <ol>
                @foreach($curso->capitulos as $capitulo)
                <h4>
                    <strong><li>{{ $capitulo->titulo }}</li></strong>
                </h4>
                @if($capitulo->topicos->count() > 0)
                <ul>
                    @foreach($capitulo->topicos as $topico)
                    <li>{{ $topico->subtitulo }}</li>
                    @endforeach
                </ul>
                @endif
                @endforeach
            </ol>
            @else
            <h4>Estamos actualizando el contenido, pronte tendrás muchas novedades en esta sección...</h4>
            @endif
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="fb-comments" data-href="{{ route('curso.ver', $curso->codigo) }}" data-numposts="5" data-mobile="true" data-order-by="reverse_time" data-width="100%"></div>
        </div>
    </div>
</div>

@endsection

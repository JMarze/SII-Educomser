@extends('layouts.frontend')

@section('title', 'Educomser SRL')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>
                <i class="fa fa-btn fa-cube"></i><strong>Carrera de </strong>
                @if($carrera->color_hexa != '')
                <span style="color:{{ $carrera->color_hexa }}">
                @else
                <span>
                @endif
                    {{ $carrera->nombre }}
                </span>
            </h2>
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-md-8">
            @if($carrera->logo != null)
            <img src="{{ route('admin.carrera.verlogo', ['nombreLogo' => $carrera->logo]) }}" alt="" style="width:100%;"/>
            @else
            <img src="/img/sinlogo.png" alt="" style="width:100%;"/>
            @endif
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <h4><strong><i class="fa fa-btn fa-clock-o"></i>Duración:</strong></h4>
                </div>
                <div class="col-md-5">
                    <h4>{{ $carrera->cursos->sum('horas_reales') }} hrs.<br/>({{ $duracion }})</h4>
                </div>
            </div>

            <hr/>

            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <h4><strong><i class="fa fa-btn fa-check"></i>¿Vigente?</strong></h4>
                </div>
                <div class="col-md-5">
                    <h4>
                        @if($carrera->vigente)
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
            <div class="fb-like" data-href="{{ route('carrera.ver', $carrera->codigo) }}" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-md-6">
            <h3 class="text-center">
                <strong><i class="fa fa-btn fa-user-plus"></i>Docentes que dictaron la carrera</strong>
            </h3>
            <br/>
        </div>
        <div class="col-md-6">
            <h3 class="text-center">
                <strong><i class="fa fa-btn fa-graduation-cap"></i>Aprenderás</strong>
            </h3>
            <br/>
            @if($carrera->cursos->count() > 0)
            <ol>
                @foreach($carrera->cursos as $curso)
                <h4>
                    <strong><li>{{ $curso->nombre }}</li></strong>
                </h4>
                @endforeach
            </ol>
            @else

            @endif
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="fb-comments" data-href="{{ route('carrera.ver', $carrera->codigo) }}" data-numposts="5" data-mobile="true" data-order-by="reverse_time" data-width="100%"></div>
        </div>
    </div>
</div>

@endsection

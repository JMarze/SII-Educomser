@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div id="carousel-cronograma" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-cronograma" data-slide-to="0" class="active"></li>
                    <?php $slideId = 1; ?>
                    @foreach($lanzamientosCurso as $lanzamientoCurso)
                    <li data-target="#carousel-cronograma" data-slide-to="{{ $slideId }}"></li>
                    <?php $slideId++; ?>
                    @endforeach

                    @foreach($lanzamientosCarrera as $lanzamientoCarrera)
                    <li data-target="#carousel-cronograma" data-slide-to="{{ $slideId }}"></li>
                    <?php $slideId++; ?>
                    @endforeach

                </ol>

                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="img/background_carousel.jpg" alt=""/>
                        <div class="carousel-caption">
                            <h2>Educomser SRL</h2>
                            <h3>Educación en Computación y Servicios</h3>
                            <h4>17 años compartiendo el mundo de la informática</h4>
                        </div>
                    </div>

                    @foreach($lanzamientosCurso as $lanzamientoCurso)
                    <div class="item">
                        <img src="img/background_carousel.jpg" alt=""/>
                        <div class="carousel-caption">
                            <h3>Curso de {{ $lanzamientoCurso->curso->nombre }}</h3>
                            <h5>
                                <i class="fa fa-btn fa-clock-o"></i> {{ $duraciones[$lanzamientoCurso->curso_codigo] }} (
                                @if($lanzamientoCurso->cronograma->tipo->nombre == 'Sábados')
                                Sábados de {{ $lanzamientoCurso->cronograma->inicio->formatLocalized('%H:%M') }} a {{ $lanzamientoCurso->cronograma->inicio->addMinute($lanzamientoCurso->cronograma->duracion_clase * 60)->formatLocalized('%H:%M') }})
                                @elseif($lanzamientoCurso->cronograma->tipo->nombre == 'Regular')
                                Lun. a Vie. de {{ $lanzamientoCurso->cronograma->inicio->formatLocalized('%H:%M') }} a {{ $lanzamientoCurso->cronograma->inicio->addMinute($lanzamientoCurso->cronograma->duracion_clase * 60)->formatLocalized('%H:%M') }})
                                @endif
                            </h5>
                            <h5>
                                <i class="fa fa-btn fa-calendar-check-o"></i> {{ $lanzamientoCurso->cronograma->inicio->formatLocalized('%d de %B') }} ({{ $lanzamientoCurso->cronograma->inicio->diffForHumans() }})
                            </h5>
                            <p>{{ $lanzamientoCurso->curso->eslogan }}</p>
                        </div>
                    </div>
                    @endforeach

                    @foreach($lanzamientosCarrera as $lanzamientoCarrera)
                    <div class="item">
                        <img src="img/background_carousel.jpg" alt=""/>
                        <div class="carousel-caption">
                            <h3>Carrera de {{ $lanzamientoCarrera->carrera->nombre }}</h3>
                            <h5>
                                <i class="fa fa-btn fa-clock-o"></i> {{ $duraciones_carrera[$lanzamientoCarrera->carrera_codigo] }} (
                                @if($lanzamientoCarrera->cronograma->tipo->nombre == 'Sábados')
                                Sábados de {{ $lanzamientoCarrera->cronograma->inicio->formatLocalized('%H:%M') }} a {{ $lanzamientoCarrera->cronograma->inicio->addMinute($lanzamientoCarrera->cronograma->duracion_clase * 60)->formatLocalized('%H:%M') }})
                                @elseif($lanzamientoCarrera->cronograma->tipo->nombre == 'Regular')
                                Lun. a Vie. de {{ $lanzamientoCarrera->cronograma->inicio->formatLocalized('%H:%M') }} a {{ $lanzamientoCarrera->cronograma->inicio->addMinute($lanzamientoCarrera->cronograma->duracion_clase * 60)->formatLocalized('%H:%M') }})
                                @endif
                            </h5>
                            <h5>
                                <i class="fa fa-btn fa-calendar-check-o"></i> {{ $lanzamientoCarrera->cronograma->inicio->formatLocalized('%d de %B') }} ({{ $lanzamientoCarrera->cronograma->inicio->diffForHumans() }})
                            </h5>
                            <p></p>
                        </div>
                    </div>
                    @endforeach

                </div>

                <a href="#carousel-cronograma" class="left carousel-control" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a href="#carousel-cronograma" class="right carousel-control" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
        </div>
    </div>

    <hr/>

    <div class="row text-center">
        <h3>
            <i class="fa fa-btn fa-cube"></i>Nuestros Cursos
        </h3>
    </div>

    <hr/>

    <div class="row">
        @foreach($cursos as $curso)
        <div class="col-md-3 col-sm-6">
            <div class="thumbnail">
                <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTkyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDE5MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTU4N2ZiYjU3NWMgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNTg3ZmJiNTc1YyI+PHJlY3Qgd2lkdGg9IjE5MiIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI3MS41IiB5PSIxMDQuNSI+MTkyeDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" alt=""/>
                <div class="caption">
                    <h4 class="text-center">{{ $curso->nombre }}</h4>
                    <p style="text-align:justify;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex voluptate possimus doloribus dolor optio at quisquam assumenda rem hic ut!</p>
                    <p class="text-center">
                        <a href="#" class="btn btn-default" role="button">
                            <i class="fa fa-btn fa-plus"></i>Ver más...
                        </a>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row text-center">
        <div class="col-md-6 col-md-offset-3">
            <h4>¿Quieres saber más sobre nuestros cursos?</h4>
            <h4>Te invitamos a...</h4>
            <a href="#" class="btn btn-default btn-lg" role="button">
                <i class="fa fa-btn fa-cube"></i>Ver todos los cursos disponibles
            </a>
        </div>
    </div>

    <hr/>

    <div class="row text-center">
        <h3>
            <i class="fa fa-btn fa-cubes"></i>Nuestras Carreras
        </h3>
    </div>

    <hr/>

    <div class="row">
        @foreach($carreras as $carrera)
        <div class="col-md-3 col-sm-6">
            <div class="thumbnail">
                <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTkyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDE5MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTU4N2ZiYjU3NWMgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNTg3ZmJiNTc1YyI+PHJlY3Qgd2lkdGg9IjE5MiIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI3MS41IiB5PSIxMDQuNSI+MTkyeDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" alt=""/>
                <div class="caption">
                    <h4 class="text-center">{{ $carrera->nombre }}</h4>
                    <p style="text-align:justify;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex voluptate possimus doloribus dolor optio at quisquam assumenda rem hic ut!</p>
                    <p class="text-center">
                        <a href="#" class="btn btn-default" role="button">
                            <i class="fa fa-btn fa-plus"></i>Ver más...
                        </a>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row text-center">
        <div class="col-md-6 col-md-offset-3">
            <h4>¿Quieres saber más sobre nuestros carreras?</h4>
            <h4>Te invitamos a...</h4>
            <a href="#" class="btn btn-default btn-lg" role="button">
                <i class="fa fa-btn fa-cubes"></i>Ver todas las carreras disponibles
            </a>
        </div>
    </div>

    <hr/>
</div>
@endsection

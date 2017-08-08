@extends('layouts.frontend')

@section('title', 'Educomser SRL - Educación en Computación y Servicios')

@section('content')
<section id="main-slider" class="no-margin">
    <div class="carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#main-slider" data-slide-to="0" class="active"></li>
            <?php $slideId = 1; ?>
            @foreach($lanzamientosCurso as $lanzamientoCurso)
            <li data-target="#main-slider" data-slide-to="{{ $slideId }}"></li>
            <?php $slideId++; ?>
            @endforeach

            @foreach($lanzamientosCarrera as $lanzamientoCarrera)
            <li data-target="#main-slider" data-slide-to="{{ $slideId }}"></li>
            <?php $slideId++; ?>
            @endforeach
        </ol>
        <div class="carousel-inner">

            <div class="item active" style="background-image: url(images/slider/bg2.jpg)">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-sm-6">
                            <div class="carousel-content">
                                <h1 class="animation animated-item-1">Educomser SRL - Educación en Computación y Servicios</h1>
                                <h2 class="animation animated-item-2">{{ Carbon\Carbon::createFromDate(1998, 5, 1)->age }} años compartiendo el mundo de la Informática</h2>
                            </div>
                        </div>

                        <div class="col-sm-6 hidden-xs animation animated-item-4" style="margin-top: 80px;">
                            <div class="slider-img">
                                <img src="{!! asset('img/educomser_logo.png') !!}" class="img-responsive">
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--/.item-->

            @foreach($lanzamientosCurso as $lanzamientoCurso)
            <div class="item" style="background-image: url(images/slider/bg2.jpg)">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-sm-6">
                            <div class="carousel-content">
                                @if($lanzamientoCurso->curso->color_hexa == null)
                                <h1 class="animation animated-item-1">
                                @else
                                <h1 class="animation animated-item-1" style="color: {{ $lanzamientoCurso->curso->color_hexa }};">
                                @endif
                                    Curso de {{ $lanzamientoCurso->curso->nombre }} <br/>
                                    <small style="color:#FFF;"> "{{ $lanzamientoCurso->curso->eslogan }}"</small>
                                </h1>
                                <h2 class="animation animated-item-2 text-right">
                                    {{ $duraciones[$lanzamientoCurso->curso_codigo] }} (
                                    @if($lanzamientoCurso->cronograma->tipo->nombre == 'Sábados')
                                    Sábados de {{ $lanzamientoCurso->cronograma->inicio->formatLocalized('%H:%M') }} a {{ $lanzamientoCurso->cronograma->inicio->addMinute($lanzamientoCurso->cronograma->duracion_clase * 60)->formatLocalized('%H:%M') }})
                                    @elseif($lanzamientoCurso->cronograma->tipo->nombre == 'Regular')
                                    Lun. a Vie. de {{ $lanzamientoCurso->cronograma->inicio->formatLocalized('%H:%M') }} a {{ $lanzamientoCurso->cronograma->inicio->addMinute($lanzamientoCurso->cronograma->duracion_clase * 60)->formatLocalized('%H:%M') }})
                                    @endif
                                    <br/>
                                    {{ $lanzamientoCurso->cronograma->inicio->formatLocalized('%d de %B') }} ({{ $lanzamientoCurso->cronograma->inicio->diffForHumans() }})
                                </h2>
                                <a class="btn-slide animation animated-item-3" href="#">Ver Curso</a>
                            </div>
                        </div>

                        <div class="col-sm-6 hidden-xs animation animated-item-4">
                            <div class="slider-img">
                                @if($lanzamientoCurso->curso->logo != null)
                                <img src="{{ route('admin.curso.verlogo', ['nombreLogo' => $lanzamientoCurso->curso->logo]) }}" class="img-responsive"/>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--/.item-->
            @endforeach

            @foreach($lanzamientosCarrera as $lanzamientoCarrera)
            <div class="item" style="background-image: url(images/slider/bg3.jpg)">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-sm-6">
                            <div class="carousel-content">
                                <h1 class="animation animated-item-1">Carrera de {{ $lanzamientoCarrera->carrera->nombre }}</h1>
                                <h2 class="animation animated-item-2 text-right">
                                    {{ $duraciones_carrera[$lanzamientoCarrera->carrera_codigo] }} (
                                    @if($lanzamientoCarrera->cronograma->tipo->nombre == 'Sábados')
                                    Sábados de {{ $lanzamientoCarrera->cronograma->inicio->formatLocalized('%H:%M') }} a {{ $lanzamientoCarrera->cronograma->inicio->addMinute($lanzamientoCarrera->cronograma->duracion_clase * 60)->formatLocalized('%H:%M') }})
                                    @elseif($lanzamientoCarrera->cronograma->tipo->nombre == 'Regular')
                                    Lun. a Vie. de {{ $lanzamientoCarrera->cronograma->inicio->formatLocalized('%H:%M') }} a {{ $lanzamientoCarrera->cronograma->inicio->addMinute($lanzamientoCarrera->cronograma->duracion_clase * 60)->formatLocalized('%H:%M') }})
                                    @endif
                                    <br/>
                                    {{ $lanzamientoCarrera->cronograma->inicio->formatLocalized('%d de %B') }} ({{ $lanzamientoCarrera->cronograma->inicio->diffForHumans() }})
                                </h2>
                                <a class="btn-slide animation animated-item-3" href="#">Ver Carrera</a>
                            </div>
                        </div>
                        <div class="col-sm-6 hidden-xs animation animated-item-4">
                            <div class="slider-img">
                                @if($lanzamientoCarrera->carrera->logo != null)
                                <img src="{{ route('admin.carrera.verlogo', ['nombreLogo' => $lanzamientoCarrera->carrera->logo]) }}" class="img-responsive"/>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->
            @endforeach
        </div><!--/.carousel-inner-->
    </div><!--/.carousel-->
    <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
        <i class="fa fa-chevron-left"></i>
    </a>
    <a class="next hidden-xs" href="#main-slider" data-slide="next">
        <i class="fa fa-chevron-right"></i>
    </a>
</section><!--/#main-slider-->

<section id="feature" >
    <div class="container">
       <div class="center wow fadeInDown">
            <h2>Nosotros</h2>
            <p class="lead">
                Educomser SRL es una empresa boliviana, dedicada al rubro de la educación y servicios de consultoría en el área informática.
            </p>
        </div>

        <div class="row">
            <div class="features">
                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-cube"></i>
                        <h2>Cursos</h2>
                        <h3>Contamos con {{ $totalCursosVigentes }} cursos vigentes de {{ $totalCursos }} cursos impartidos.</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-cubes"></i>
                        <h2>Carreras</h2>
                        <h3>Contamos con {{ $totalCarrerasVigentes }} carreras vigentes de {{ $totalCarreras }} carreras impartidas.</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-user"></i>
                        <h2>Alumnos</h2>
                        <h3>Tenemos el privilegio de contar con {{ $totalAlumnos }} alumnos registrados.</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-calendar-check-o"></i>
                        <h2>Preinscripción</h2>
                        <h3>Ahora puedes realizar la preinscripción online.</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-qrcode"></i>
                        <h2>Asistencia</h2>
                        <h3>Registrarás tu asistencia con la ayuda de un QR Code.</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-share-alt"></i>
                        <h2>Conectados</h2>
                        <h3>Te brindandomos comodidad en la interacción con la empresa.</h3>
                    </div>
                </div><!--/.col-md-4-->
            </div><!--/.services-->
        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#feature-->

<section id="recent-works">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2>Cursos y Carreras actualizados</h2>
            <p class="lead">Te presentamos nuestras propuestas más actuales</p>
        </div>

        <div class="row">

            <?php $item = 1; ?>

            @foreach($cursos as $curso)
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    @if($curso->logo != null)
                    <img class="img-responsive" src="{{ route('admin.curso.verlogo', ['nombreLogo' => $curso->logo]) }}" alt="">
                    @else
                    <img class="img-responsive" src="images/portfolio/recent/item{{ $item }}.png" alt="">
                    @endif
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="#">Curso de {{ $curso->nombre }}</a> </h3>
                            <p>{{ $curso->eslogan }}</p>
                            @if($curso->logo == null)
                            <a class="preview" href="images/portfolio/full/item1.png" rel="prettyPhoto">
                            @else
                            <a class="preview" href="{{ route('admin.curso.verlogo', ['nombreLogo' => $curso->logo]) }}" rel="prettyPhoto">
                            @endif
                                <i class="fa fa-eye"></i> Ver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php $item++; ?>
            @endforeach

            @foreach($carreras as $carrera)
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    @if($carrera->logo != null)
                    <img class="img-responsive" src="{{ route('admin.carrera.verlogo', ['nombreLogo' => $carrera->logo]) }}" alt="">
                    @else
                    <img class="img-responsive" src="images/portfolio/recent/item{{ $item }}.png" alt="">
                    @endif
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="#">Carrera de {{ $carrera->nombre }}</a> </h3>
                            <p>{{ $carrera->eslogan }}</p>
                            @if($carrera->logo == null)
                            <a class="preview" href="images/portfolio/full/item1.png" rel="prettyPhoto">
                            @else
                            <a class="preview" href="{{ route('admin.carrera.verlogo', ['nombreLogo' => $carrera->logo]) }}" rel="prettyPhoto">
                            @endif
                                <i class="fa fa-eye"></i> Ver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php $item++; ?>
            @endforeach

        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#recent-works-->

<section id="partner">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2>Nuestros Clientes</h2>
            <p class="lead">Muchas instituciones ponen su confianza en nosotros. Agradecemos especialmente a:</p>
        </div>

        <div class="partners">
            <ul>
                <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" src="{{ asset('img/banco_fie.gif') }}"></a></li>
            </ul>
        </div>
    </div><!--/.container-->
</section><!--/#partner-->

<section id="conatcat-info">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="pull-left">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="media-body">
                        <h2>¿Tienes alguna pregunta o necesitas una cotización?</h2>
                        <p>Te invitamos a comunicarte con nosotros al teléfono (591) 2318134 o envíanos un correo electrónico a <a href="mailto:cursos@educomser.com">cursos@educomser.com</a> responderemos lo antes posible.</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.container-->
</section><!--/#conatcat-info-->

<section id="bottom">
    <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
        <div class="row">

            <div class="col-md-10 col-md-offset-1">
                <div class="widget">
                    <h3 class="text-center">
                        <i class="fa fa-quote-left"></i>&nbsp;&nbsp;&nbsp;Nuestro deseo es compartir el mundo de la informática&nbsp;&nbsp;&nbsp;<i class="fa fa-quote-right"></i>
                    </h3>
                    <h5 class="text-center">No dudes más... Te esperamos</h5>
                </div>
            </div><!--/.col-md-10-->

            <div class="col-md-2 col-md-offset-5">
                <div class="widget text-center">
                    <div class="fb-like" data-href="{{ url('/') }}" data-layout="box_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
                </div>
            </div>

        </div>
    </div>
</section><!--/#bottom-->
@endsection

@section('script')
@parent
<script>
    $('li#inicio').addClass('active');
</script>
@endsection

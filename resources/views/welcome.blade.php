@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div id="carousel-cronograma" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-cronograma" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-cronograma" data-slide-to="1"></li>
                </ol>

                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="img/background_carousel.jpg" alt=""/>
                        <div class="carousel-caption">
                            <h3>Curso de Laravel</h3>
                            <h4>
                                <i class="fa fa-btn fa-level-up"></i> Básico - Intermedio
                            </h4>
                            <h5>
                                <i class="fa fa-btn fa-clock-o"></i> 2 semanas (Lun. a Vie. de 19:30 a 21:00) <br/>
                            </h5>
                            <h5>
                                <i class="fa fa-btn fa-calendar-check-o"></i> 25 de abril
                            </h5>
                            <p>El framework para Artesanos Php</p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="img/background_carousel.jpg" alt=""/>
                        <div class="carousel-caption">
                            <h3>Carrera de .Net</h3>
                            <h4>
                                <i class="fa fa-btn fa-level-up"></i> Básico - Intermedio - Avanzado
                            </h4>
                            <h5>
                                <i class="fa fa-btn fa-clock-o"></i> 4 meses (Lun. a Vie. de 18:00 a 19:30) <br/>
                            </h5>
                            <h5>
                                <i class="fa fa-btn fa-calendar-check-o"></i> 25 de abril
                            </h5>
                            <p>Aprende VB, C#, ASP.net, WCF y más...</p>
                        </div>
                    </div>
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
</div>
@endsection

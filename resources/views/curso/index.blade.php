@extends('layouts.frontend')

@section('title', 'Educomser SRL - Educación en Computación y Servicios')

@section('content')
<section id="portfolio">
    <div class="container">
        <div class="center">
           <h2>Nuestros Cursos Vigentes</h2>
           <p class="lead">Navega entre las áreas para encontrar el curso que estás buscando.</p>
        </div>

        <ul class="portfolio-filter text-center">
            <li><a class="btn btn-default active" href="#" data-filter="*">Todos</a></li>
            @foreach($areas as $area)
            <li><a class="btn btn-default" href="#" data-filter=".{{ str_slug($area->nombre, '-') }}">{{ $area->nombre }}</a></li>
            @endforeach
        </ul><!--/#portfolio-filter-->

        <div class="row">
            <div class="portfolio-items">

                <?php $item = 1; ?>
                @foreach($cursos as $curso)
                <div class="portfolio-item {{ str_slug($curso->area->nombre, '-') }} col-xs-12 col-sm-4 col-md-3">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="images/portfolio/recent/item{{ $item }}.png" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a href="#">Curso de {{ $curso->nombre }}</a></h3>
                                <p>{{ $curso->eslogan }}</p>
                                <a class="preview" href="images/portfolio/full/item{{ $item }}.png" rel="prettyPhoto"><i class="fa fa-eye"></i> Ver</a>
                            </div>
                        </div>
                    </div>
                </div><!--/.portfolio-item-->
                <?php
                $item++;
                if($item > 12){
                    $item = 1;
                }
                ?>
                @endforeach

            </div>
        </div>
    </div>
</section><!--/#portfolio-item-->
@endsection

@section('script')
@parent
<script>
    $('li#cursos').addClass('active');
</script>
@endsection

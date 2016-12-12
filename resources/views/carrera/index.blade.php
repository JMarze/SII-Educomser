@extends('layouts.frontend')

@section('title', 'Educomser SRL - Carreras vigentes')

@section('content')
<section id="portfolio">
    <div class="container">
        <div class="center">
           <h2>Nuestras Carreras Vigentes</h2>
        </div>

        <div class="row">
            <div class="portfolio-items">

                <?php $item = 1; ?>
                @foreach($carreras as $carrera)
                <div class="portfolio-item col-xs-12 col-sm-4 col-md-3">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="images/portfolio/recent/item{{ $item }}.png" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a href="{{ route('carrera.ver', $carrera->codigo) }}">Carrera de {{ $carrera->nombre }}</a></h3>
                                <p>{{ $carrera->eslogan }}</p>
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
    $('li#carreras').addClass('active');
</script>
@endsection

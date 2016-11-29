@extends('layouts.frontend')

@section('title', 'Educomser SRL - Educación en Computación y Servicios')

@section('content')
<section id="contact-info">
    <div class="center">
        <h2>¿Cómo encontrarnos?</h2>
    </div>
    <div class="gmap-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 text-center">
                    <div class="gmap" style="height: 400px; width: 400px;">
                        <div id="map" style="height: 100%; width: 100%; border-radius:50%;"></div>
                    </div>
                </div>

                <div class="col-sm-6 col-sm-offset-1 map-content">
                    <ul class="row">
                        <li class="col-sm-12">
                            <address style="margin-top: 70px;">
                                <h3 style="font-size: 30px;">
                                    <i class="fa fa-map"></i>&nbsp;&nbsp;&nbsp;Casa Matriz
                                </h3>
                                <p style="font-size: 25px; margin-left: 10px;">
                                    Av. 16 de Julio (El Prado)<br/>
                                    Nro. 1566 Edificio 16 de Julio<br/>
                                    Piso 1 Of. 104 - 105
                                </p>
                                <p style="font-size: 20px;">
                                    Teléfono: (591) 2318134<br/>
                                    Fax: (591) 2318134<br/>
                                    Correo Electrónico: <a href="mailto:cursos@educomser.com">cursos@educomser.com</a>
                                </p>
                            </address>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>  <!--/gmap_area -->
@endsection

@section('script')
@parent
<script>
    $('li#contacto').addClass('active');
</script>

<script>
  function initMap() {
    var myLatLng = {lat: -16.501693, lng: -68.132784};

    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('map'), {
      center: myLatLng,
      scrollwheel: false,
      zoom: 18
    });

    // Create a marker and set its position.
    var marker = new google.maps.Marker({
      map: map,
      position: myLatLng,
      title: 'Educomser SRL (Educación en Computación y Servicios)'
    });
  }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8XBy2JosJVeP9DKNSv3MhdHIQLtw_8f4&callback=initMap"
    async defer></script>
@endsection

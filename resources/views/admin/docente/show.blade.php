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
                       <a href="{{ route('admin.docente.getshow', $docente->id) }}" class="navbar-brand">
                           <i class="fa fa-btn fa-user-plus"></i>({{ $docente->persona->codigo }}) {{ $docente->persona->primer_apellido }} {{ $docente->persona->segundo_apellido }} {{ $docente->persona->nombres }}
                       </a>
                   </div>

               </div>
            </nav>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-5">

                    </div>
                    <div class="col-md-7">
                        {{ $docente->biografia }}
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-4">
                        <strong>CI:</strong><br/>
                        {{ $docente->persona->numero_ci }} {{ $docente->persona->expedicion->codigo }}
                    </div>
                    <div class="col-md-4">
                        <strong>Correo Electrónico Personal:</strong><br/>
                        <a href="mailto:{{ $docente->persona->email }}">
                            <i class="fa fa-btn fa-envelope"></i>{{ $docente->persona->email }}
                        </a>
                    </div>
                    <div class="col-md-4">
                        <strong>Correo Electrónico Institucional:</strong><br/>
                        <a href="mailto:{{ $docente->email_institucional }}">
                            <i class="fa fa-btn fa-envelope-o"></i>{{ $docente->email_institucional }}
                        </a>
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-4">
                        <strong>Edad:</strong><br/>
                        {{ $docente->persona->fecha_nacimiento->age }} años ({{ $docente->persona->fecha_nacimiento->formatLocalized('%d-%B-%Y') }})
                    </div>
                    <div class="col-md-4">
                        <strong>C.I.:</strong><br/>
                        {{ $docente->persona->numero_ci }} {{ $docente->persona->expedicion->codigo }}
                    </div>
                    <div class="col-md-4">
                        <strong>Género:</strong><br/>
                        @if($docente->persona->genero == 'femenino')
                        <i class="fa fa-btn fa-venus"></i> Femenino
                        @else
                        <i class="fa fa-btn fa-mars"></i> Masculino
                        @endif
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-4">
                        <strong>Dirección:</strong><br/>
                        {{ $docente->persona->direccion }}
                    </div>
                    <div class="col-md-4">
                        <strong>Teléfono personal:</strong><br/>
                        <i class="fa fa-btn fa-mobile-phone"></i>{{ $docente->persona->telefono_1 }}
                    </div>
                    <div class="col-md-4">
                        <strong>Teléfono de referencia:</strong><br/>
                        <i class="fa fa-btn fa-phone"></i>{{ $docente->persona->telefono_2 }}
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-2">
                        <strong>Facebook:</strong><br/>
                        @if($docente->social_facebook != null)
                        <a href="{{ $docente->social_facebook }}" class="btn btn-default" style="color:#3B5998;" title="{{ $docente->social_facebook }}" target="_blank">
                            <i class="fa fa-facebook-official"></i>
                        </a>
                        @else
                        No registrado
                        @endif
                    </div>
                    <div class="col-md-2">
                        <strong>Twitter:</strong><br/>
                        @if($docente->social_twitter != null)
                        <a href="{{ $docente->social_twitter }}" class="btn btn-default" style="color:#55ACEE;" title="{{ $docente->social_twitter }}" target="_blank">
                            <i class="fa fa-twitter"></i>
                        </a>
                        @else
                        No registrado
                        @endif
                    </div>
                    <div class="col-md-2">
                        <strong>Google+:</strong><br/>
                        @if($docente->social_googleplus != null)
                        <a href="{{ $docente->social_googleplus }}" class="btn btn-default" style="color:#C03121;" title="{{ $docente->social_googleplus }}" target="_blank">
                            <i class="fa fa-google-plus-official"></i>
                        </a>
                        @else
                        No registrado
                        @endif
                    </div>
                    <div class="col-md-2">
                        <strong>YouTube:</strong><br/>
                        @if($docente->social_youtube != null)
                        <a href="{{ $docente->social_youtube }}" class="btn btn-default" style="color:#DF2926;" title="{{ $docente->social_youtube }}" target="_blank">
                            <i class="fa fa-youtube-play"></i>
                        </a>
                        @else
                        No registrado
                        @endif
                    </div>
                    <div class="col-md-2">
                        <strong>LindedIn:</strong><br/>
                        @if($docente->social_linkedin != null)
                        <a href="{{ $docente->social_linkedin }}" class="btn btn-default" style="color:#007BB6;" title="{{ $docente->social_linkedin }}" target="_blank">
                            <i class="fa fa-linkedin"></i>
                        </a>
                        @else
                        No registrado
                        @endif
                    </div>
                    <div class="col-md-2">
                        <strong>Sitio Web:</strong><br/>
                        @if($docente->social_website != null)
                        <a href="{{ $docente->social_website }}" class="btn btn-default" title="{{ $docente->social_website }}" target="_blank">
                            <i class="fa fa-cloud"></i>
                        </a>
                        @else
                        No registrado
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

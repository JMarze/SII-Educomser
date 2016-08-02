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
                       <a href="{{ route('admin.alumno.getshow', $alumno->id) }}" class="navbar-brand">
                           <i class="fa fa-btn fa-user"></i>({{ $alumno->persona->codigo }}) {{ $alumno->persona->primer_apellido }} {{ $alumno->persona->segundo_apellido }} {{ $alumno->persona->nombres }}
                       </a>
                   </div>

               </div>
            </nav>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-5">

                    </div>
                    <div class="col-md-7">
                        {{ $alumno->biografia }}
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-4">
                        <strong><i class="fa fa-btn fa-list-alt"></i>CI:</strong><br/>
                        {{ $alumno->persona->numero_ci }} {{ $alumno->persona->expedicion->codigo }}
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa fa-btn fa-envelope"></i>Correo Electrónico Personal:</strong><br/>
                        <a href="mailto:{{ $alumno->persona->email }}">{{ $alumno->persona->email }}</a>
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa fa-btn fa-birthday-cake"></i>Edad:</strong><br/>
                        {{ $alumno->persona->fecha_nacimiento->age }} años ({{ $alumno->persona->fecha_nacimiento->formatLocalized('%d-%B-%Y') }})
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-venus-mars"></i>Género:</strong><br/>
                        @if($alumno->persona->genero == 'femenino')
                        <i class="fa fa-btn fa-venus"></i>Femenino
                        @else
                        <i class="fa fa-btn fa-mars"></i>Masculino
                        @endif
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-mobile-phone"></i>Teléfono personal:</strong><br/>
                        {{ $alumno->persona->telefono_1 }}
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-phone"></i>Teléfono de referencia:</strong><br/>
                        {{ $alumno->persona->telefono_2 }}
                    </div>
                    <div class="col-md-3">
                        <strong>Dirección:</strong><br/>
                        {{ $alumno->persona->direccion }}
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-6">
                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de creación: </strong>{{ $alumno->created_at->formatLocalized('%d-%B-%Y') }} ({{ $alumno->created_at->diffForHumans() }})
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de modificación: </strong>
                        @if($alumno->updated_at > $alumno->persona->updated_at)
                        {{ $alumno->updated_at->formatLocalized('%d-%B-%Y') }} ({{ $alumno->updated_at->diffForHumans() }})
                        @else
                        {{ $alumno->persona->updated_at->formatLocalized('%d-%B-%Y') }} ({{ $alumno->persona->updated_at->diffForHumans() }})
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
                       <a href="{{ route('admin.cronograma.showCurso', $lanzamientoCurso->id) }}" class="navbar-brand">
                           <i class="fa fa-btn fa-cube"></i>({{ $lanzamientoCurso->curso->codigo }}) {{ $lanzamientoCurso->curso->nombre }}
                       </a>
                   </div>
               </div>
            </nav>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-5">

                    </div>
                    <div class="col-md-7">
                        {{ $lanzamientoCurso->curso->eslogan }}<br/><br/>
                        {{ $lanzamientoCurso->curso->descripcion }}
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-6">
                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de creación: </strong>{{ $lanzamientoCurso->curso->created_at->formatLocalized('%d-%B-%Y') }} ({{ $lanzamientoCurso->curso->created_at->diffForHumans() }})
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de modificación: </strong>{{ $lanzamientoCurso->curso->updated_at->formatLocalized('%d-%B-%Y') }} ({{ $lanzamientoCurso->curso->updated_at->diffForHumans() }})
                    </div>
                </div>
                <hr/>

                <div class="row text-center">
                    <div class="col-md-12">
                        <h3><strong>Lista de Alumnos Inscritos</strong></h3>
                    </div>
                </div>

                <table class="table">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Asistencia</th>
                        <th>Fecha de Inscripción</th>
                        <th>Total de Pagos</th>
                        <th>Evaluar Curso</th>
                    </tr>
                    @foreach($lanzamientoCurso->inscritos as $inscrito)
                    <tr>
                        <td>{{ $inscrito->alumno->persona->codigo }}</td>
                        <td>
                            <a href="{{ route('admin.alumno.getshow', $inscrito->alumno->id) }}">
                            {{ $inscrito->alumno->persona->primer_apellido }} {{ $inscrito->alumno->persona->segundo_apellido }} {{ $inscrito->alumno->persona->nombres }}
                            </a>
                        </td>
                        <td>
                            @if($inscrito->tipo_asistencia == 'hoja')
                            Hoja
                            @else
                            Qr Code
                            @endif
                        </td>
                        <td>{{ $inscrito->created_at }}</td>
                        <td>Bs {{ $inscrito->pagos->sum('monto') }}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script>

</script>
@endsection

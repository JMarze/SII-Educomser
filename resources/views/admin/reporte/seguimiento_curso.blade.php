@extends('layouts.reporte')

@section('title', 'Seguimiento Académico')

@section('style')
<style>
    table{
        width: 700px;
        margin: auto;
    }
    h3{
        text-align: center;
    }
    table tr th, table tr td{
        padding: 3px 0;
        width: 100px;
        font-size: 12px;
        text-align: left;
    }
    table.tabla-borde tr th,
    table.tabla-borde tr td{
        border: 1px solid;
        @if($cantidadClases >= 1 && $cantidadClases <= 10)
        height: 30px;
        @elseif($cantidadClases >= 11 && $cantidadClases <= 20)
        height: 20px;
        @endif
    }
</style>
@endsection

@section('content')
<table>
    <tr>
        <th colspan="4" style="font-size: x-large; padding: 10px 0;">Seguimiento Académico</th>
        <th style="text-align: right;">Código:</th>
        <td>{{ $alumno->persona->codigo }}</td>
    </tr>

    <tr>
        <th>Nombre:</th>
        <td colspan="5" style="font-size: 15px;">{{ $alumno->persona->primer_apellido }} {{ $alumno->persona->segundo_apellido }} {{ $alumno->persona->nombres }}</td>
    </tr>

    <tr>
        <th>Docente(s):</th>
        <td colspan="5">
            @foreach($docentes as $docente)
            @if($docente->persona->profesiones->count() > 0)
            {{ $docente->persona->profesiones[0]->grado->abreviatura }}
            @endif
            {{ $docente->persona->primer_apellido }} {{ $docente->persona->segundo_apellido }} {{ $docente->persona->nombres }}
            <br/>
            @endforeach
        </td>
    </tr>

    <tr>
        <th>Curso:</th>
        <td colspan="5">{{ $curso->nombre }}</td>
    </tr>

    <tr>
        <th>Horario:</th>
        <td colspan="2">
            {{ $inscripcion->lanzamientoCurso->cronograma->inicio->formatLocalized('%H:%M') }} a {{ $inscripcion->lanzamientoCurso->cronograma->inicio->addMinute($inscripcion->lanzamientoCurso->cronograma->duracion_clase * 60)->formatLocalized('%H:%M') }}
        </td>
        <th>Correo:</th>
        <td colspan="2">{{ $alumno->persona->email }}</td>
    </tr>

    <tr>
        <th>Inicio:</th>
        <td colspan="2">
            {{ $inscripcion->lanzamientoCurso->cronograma->inicio->formatLocalized('%A, %d de %B de %Y') }}
        </td>
        <th>Teléfono:</th>
        <td colspan="2">{{ $alumno->persona->telefono_1 }} / {{ $alumno->persona->telefono_2 }}</td>
    </tr>
</table>

<table class="tabla-borde">
    <tr>
        <th style="text-align: center; width: 5%;">Clase</th>
        <th style="text-align: center; width: 20%;">Fecha</th>
        <th style="text-align: center; width: 20%;">Firma</th>
        <th style="text-align: center; width: 55%;">Tema Avanzado</th>
    </tr>

    @for($i = 1; $i <= $cantidadClases; $i++)
    <tr>
        <td style="text-align: center;">{{ $i }}</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    @endfor

    <tr>
        <th colspan="2">Nota Final</th>
        <td colspan="2"></td>
    </tr>
</table>

<table>
    <tr>
        <td>Educomser SRL</td>
        <td style="text-align: right;">{{ Carbon\Carbon::now()->formatLocalized('%d de %B de %Y') }}</td>
    </tr>
</table>
@endsection

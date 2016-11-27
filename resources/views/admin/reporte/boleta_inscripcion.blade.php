@extends('layouts.reporte')

@section('title', 'Boleta de Inscripción')

@section('style')
<style>
    table{
        width: 100%;
    }
    h3{
        text-align: center;
    }
    table tr th, table tr td{
        width: 16.666%;
    }
</style>
@endsection

@section('content')
<table style="width: 100%;">
    <tr>
        <th colspan="6">
            <h3>Boleta de Inscripción</h3>
        </th>
    </tr>

    <tr>
        <th colspan="6" style="text-align: right;">
            Nro. {{ $inscripcion->id }}
        </th>
    </tr>

    <tr>
        <th>Nombre Completo:</th>
        <td colspan="5">
            {{ $alumno->persona->primer_apellido }} {{ $alumno->persona->segundo_apellido }} {{ $alumno->persona->nombres }}
        </td>
    </tr>

    <tr>
        <th>Edad:</th>
        <td colspan="2">
            {{ $alumno->persona->fecha_nacimiento->age }} años
        </td>
        <th>Profesión:</th>
        <td colspan="2">
            @foreach($alumno->persona->profesiones as $profesion)
            {{ $profesion->grado->abreviatura }} {{ $profesion->titulo }}<br/>
            @endforeach
        </td>
    </tr>

    <tr>
        <th>Dirección:</th>
        <td>
            {{ $alumno->persona->direccion }}
        </td>
        <th>Teléfonos:</th>
        <td>
            {{ $alumno->persona->telefono_1 }} / {{ $alumno->persona->telefono_2 }}
        </td>
        <th>CI:</th>
        <td>
            {{ $alumno->persona->numero_ci }} {{ $alumno->persona->expedicion->ciudad }}
        </td>
    </tr>

    <tr>
        <th>Curso:</th>
        <td colspan="6">
            ({{ $curso->codigo }}) {{ $curso->nombre }}
        </td>
    </tr>

    <tr>
        <th>Fecha de inicio:</th>
        <td colspan="2">
            {{ $inscripcion->lanzamientoCurso->cronograma->inicio->formatLocalized('%A, %d de %B de %Y') }}
        </td>
        <th>Horario:</th>
        <td colspan="2">
            {{ $inscripcion->lanzamientoCurso->cronograma->inicio->formatLocalized('%H:%M') }} a {{ $inscripcion->lanzamientoCurso->cronograma->inicio->addMinute($inscripcion->lanzamientoCurso->cronograma->duracion_clase * 60)->formatLocalized('%H:%M') }}
        </td>
    </tr>

    <tr>
        <th>Monto Total:</th>
        <td>
            Bs {{ $inscripcion->lanzamientoCurso->costo }}
        </td>
        <th>A cuenta:</th>
        <td>
            Bs 0
        </td>
        <th>Saldo:</th>
        <td>
            Bs {{ $inscripcion->lanzamientoCurso->costo - 0 }}
        </td>
    </tr>

    <tr>
        <th>Fecha:</th>
        <td colspan="5">La Paz, {{ Carbon\Carbon::now()->formatLocalized('%d de %B de %Y') }}</td>
    </tr>

    <tr>
        <th colspan="2">
            <br/><br/><br/><br/><br/>
            ALUMNO
        </th>
        <td colspan="2"></td>
        <th colspan="2">
            <br/><br/><br/><br/><br/>
            RECIBIDO POR
        </th>
    </tr>

    <tr>
        <th>Observaciones:</th>
        <td colspan="5">
            @if($inscripcion->observaciones != null)
            {{ $inscripcion->observaciones }}
            @else
            Sin observaciones
            @endif
        </td>
    </tr>
</table>
@endsection

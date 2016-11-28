@if($carreras->total() > 0)
<table class="table table-hover">
    <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Costo Mensual</th>
        <th>Módulos</th>
        <th>Duración</th>
    </tr>
    @foreach($carreras as $carrera)
    <tr>
        <td>{{ $carrera->codigo }}</td>
        <td>{{ $carrera->nombre }}</td>
        <td>Bs {{ $carrera->costo_mensual }}</td>
        <td>
            @foreach($carrera->cursos as $modulo)
            {{ $modulo->nombre }}<br/>
            @endforeach
        </td>
        <td>
            <?php
            $totalHoras = $carrera->cursos->sum('horas_reales');
            $meses = floor($totalHoras/30);
            $semanas = floor(($totalHoras-(30*$meses))/7.5);
            $dias = ceil(($totalHoras-(30*$meses)-(7.5*$semanas))/1.5);
            $duracion = Carbon\CarbonInterval::create(0, $meses, $semanas, $dias, 0, 0, 0);
            ?>
            {{ $duracion }}
        </td>
    </tr>
    @endforeach
</table>
@else
<div class="panel-body">
    <div class="alert alert-warning" role="alert">
        <i class="fa fa-btn fa-database"></i>
        <strong>Oops!!!</strong> No se encontraron carreras en la base de datos. Intenta más tarde o comunícate con la Administración
    </div>
</div>
@endif

<div class="panel-footer">
    <div class="text-center">{{ $carreras->render() }}</div>
</div>

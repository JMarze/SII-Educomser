@if($cursos->total() > 0)
<table class="table table-hover">
    <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Área</th>
        <th>Dificultad</th>
        <th>Costo Personalizado</th>
        <th>Costo Referencial</th>
        <th>Horas Académicas</th>
        <th>Horas Reales</th>
    </tr>
    @foreach($cursos as $curso)
    <tr>
        <td>{{ $curso->codigo }}</td>
        <td>{{ $curso->nombre }}</td>
        <td>{{ $curso->area->nombre }}</td>
        <td>{{ $curso->dificultad->nombre }}</td>
        <td>Bs {{ $curso->costo_personalizado }}</td>
        <td>Bs {{ $curso->costo_referencial }}</td>
        <td>{{ $curso->horas_academicas }} hrs.</td>
        <td>{{ $curso->horas_reales }} hrs.</td>
    </tr>
    @endforeach
</table>
@else
<div class="panel-body">
    <div class="alert alert-warning" role="alert">
        <i class="fa fa-btn fa-database"></i>
        <strong>Oops!!!</strong> No se encontraron cursos en la base de datos. Intenta más tarde o comunícate con la Administración
    </div>
</div>
@endif

<div class="panel-footer">
    <div class="text-center">{{ $cursos->render() }}</div>
</div>

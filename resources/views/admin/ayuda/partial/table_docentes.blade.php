@if($docentes->total() > 0)
<table class="table table-hover">
    <tr>
        <th>Código</th>
        <th>Nombre Completo</th>
        <th>Correos Electrónicos</th>
        <th>CI</th>
        <th>Teléfonos</th>
        <th>Profesiones</th>
    </tr>
    @foreach($docentes as $docente)
    <tr>
        <td>{{ $docente->persona->codigo }}</td>
        <td>{{ $docente->persona->primer_apellido }} {{ $docente->persona->segundo_apellido }} {{ $docente->persona->nombres }}</td>
        <td>
            <a href="mailto:{{ $docente->persona->email }}">
                <i class="fa fa-btn fa-envelope"></i>{{ $docente->persona->email }}
            </a>
            <br/>
            <a href="mailto:{{ $docente->email_institucional }}">
                <i class="fa fa-btn fa-envelope-o"></i>{{ $docente->email_institucional }}
            </a>
        </td>
        <td>{{ $docente->persona->numero_ci }} {{ $docente->persona->expedicion->codigo }}</td>
        <td>
            @if($docente->persona->telefono_1 != '' && $docente->persona->telefono_1 != null)
            <i class="fa fa-btn fa-mobile-phone"></i>{{ $docente->persona->telefono_1 }}
            @endif
            <br/>
            @if($docente->persona->telefono_2 != '' && $docente->persona->telefono_2 != null)
            <i class="fa fa-btn fa-phone"></i>{{ $docente->persona->telefono_2 }}
            @endif
        </td>
        <td>
            @foreach($docente->persona->profesiones as $profesion)
            {{ $profesion->grado->abreviatura }} {{ $profesion->titulo }}<br/>
            @endforeach
        </td>
    </tr>
    @endforeach
</table>
@else
<div class="panel-body">
    <div class="alert alert-warning" role="alert">
        <i class="fa fa-btn fa-database"></i>
        <strong>Oops!!!</strong> No se encontraron docentes en la base de datos. Intenta más tarde o comunícate con la Administración
    </div>
</div>
@endif

<div class="panel-footer">
    <div class="text-center">{{ $docentes->render() }}</div>
</div>

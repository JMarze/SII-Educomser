@if($carreras->total() > 0)
<table class="table table-hover">
    <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Color</th>
        <th>Costo Mensual</th>
        <th>Creación</th>
        <th>Última modificación</th>
        <th></th>
    </tr>
    @foreach($carreras as $carrera)
    <tr>
        <td>{{ $carrera->codigo }}</td>
        <td>{{ $carrera->nombre }}</td>
        <td>
            <span class="label" style="background-color: {{ $carrera->color_hexa }};">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </td>
        <td>Bs {{ number_format($carrera->costo_mensual, 2, '.', ',') }}</td>
        <td>{{ $carrera->created_at->diffForHumans() }}</td>
        <td>{{ $carrera->updated_at->diffForHumans() }}</td>
        <td></td>
    </tr>
    @endforeach
</table>
@else
<div class="panel-body">
    <div class="alert alert-warning" role="alert">
        <i class="fa fa-btn fa-database"></i>
        <strong>Oops!!!</strong> No se encontraron carreras en la base de datos. Intenta <a href="{{ route('admin.carrera.create') }}" class="alert-link">agregar una nueva carrera</a>
    </div>
</div>
@endif

<div class="panel-footer">
    <div class="text-center">{{ $carreras->render() }}</div>
</div>

@section('script')
@parent
<script>
    // Paginación
    $(document).on('click', '.pagination a', function (e){
        e.preventDefault();
        var href = $(this).attr('href').split('?');
        var url = href[0];
        var data = href[1];
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'JSON',
            data: data
        }).done(function (response){
            $('.content-ajax').html(response);
        });
    });
</script>
@endsection

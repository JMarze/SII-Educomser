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
                       <a href="{{ route('admin.carrera.index') }}" class="navbar-brand">
                           <i class="fa fa-btn fa-cubes"></i>Carreras
                       </a>
                   </div>

                   <div class="collapse navbar-collapse" id="menu-panel">
                       <ul class="nav navbar-nav">
                           <li>
                               <button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#create">
                                   <i class="fa fa-btn fa-plus"></i>Agregar
                               </button>
                           </li>
                           <li>
                               <a href="{{ route('admin.carrera.index') }}">
                                   <i class="fa fa-btn fa-th"></i>Ver Todos
                               </a>
                           </li>
                       </ul>

                       {!! Form::open(['route' => 'admin.carrera.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                       <div class="input-group">
                           {!! Form::text('buscar_carrera', null, ['placeholder' => 'Buscar carrera...', 'class' => 'form-control']) !!}
                           <span class="input-group-addon">
                               <i class="fa fa-btn fa-search"></i>
                           </span>
                       </div>
                       {!! Form::close() !!}
                   </div>
               </div>
            </nav>

            <div class="content-ajax">
                @include('admin.carrera.partial.table')
            </div>

        </div>

    </div>
</div>
@include('admin.carrera.partial.create')
@endsection

@section('script')
<script>
    // Paginación
    $(document).on('click', '.pagination a', function (e){
        e.preventDefault();
        var href = $(this).attr('href').split('?');
        var url = href[0];
        var data = href[1];
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'JSON',
            data: data,
            success: function(response){
                $('.content-ajax').html(response);
            }
        });
    });
    // Crear
    $(document).on('click', '#btn-agregar', function (){
        var form = $('#form');
        var data = form.serialize();
        var ruta = '/admin/carrera';
        $.ajax({
            url: ruta,
            type: 'POST',
            dataType: 'JSON',
            data: data,
            success: function(){
                window.location.href = "/admin/carrera";
            }
        });
    });
</script>
@endsection

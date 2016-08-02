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
                       <a href="{{ route('admin.docente.index') }}" class="navbar-brand">
                           <i class="fa fa-btn fa-user-plus"></i>Docentes
                       </a>
                   </div>

                   <div class="collapse navbar-collapse" id="menu-panel">
                       <ul class="nav navbar-nav">
                           <li>
                               <button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#create">
                                   <i class="fa fa-btn fa-plus"></i>Agregar
                               </button>
                           </li>
                           <li class="dropdown">
                               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                   Dependencias <span class="caret"></span>
                               </a>
                               <ul class="dropdown-menu" role="menu">
                                   <li>
                                       <a href="{{ route('admin.profesion.index') }}">
                                           <i class="fa fa-btn fa-graduation-cap"></i>Profesiones
                                       </a>
                                   </li>
                               </ul>
                           </li>
                           <li>
                               <a href="{{ route('admin.docente.index') }}">
                                   <i class="fa fa-btn fa-th"></i>Ver Todos
                               </a>
                           </li>
                       </ul>

                       {!! Form::open(['route' => 'admin.docente.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                       <div class="input-group">
                           {!! Form::text('buscar_persona', null, ['placeholder' => 'Buscar docente...', 'class' => 'form-control']) !!}
                           <span class="input-group-addon">
                               <i class="fa fa-btn fa-search"></i>
                           </span>
                       </div>
                       {!! Form::close() !!}
                   </div>
               </div>
            </nav>

            <div class="alert alert-warning" role="alert" id="msg-index" style="display: none;">
                <i class="fa fa-btn fa-spin fa-refresh"></i>
                <strong>Cargando!!!</strong> Un momento por favor...
            </div>

            <div class="content-ajax">
                @include('admin.docente.partial.table')
            </div>

        </div>

    </div>
</div>
@include('admin.docente.partial.create')
@include('admin.docente.partial.update')
@include('admin.docente.partial.destroy')
@include('admin.docente.partial.attach')
@endsection

@section('script')
@parent
<script>
    // Llenar Form -> Agregar
    $(document).on('click', 'button[data-target="#create"]', function(e){
        var urlArea = '{{ route("admin.docente.listar") }}';
        $.ajax({
            url: urlArea,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            method: 'GET',
            dataType: 'JSON',
            beforeSend: function(e){
                $('#msg-create').css('display', 'block');
                $('#form-create').css('display', 'none');
            }
        }).done(function (response){
            if(response['expediciones'] != null){
                var selectExpedicion = $('select#expedicion_codigo').empty().append("<option selected='selected' value=''>Seleccione expedición</option>");
                $.each(response['expediciones'], function(key, value){
                    selectExpedicion.append("<option value='"+key+"'>"+value+"</option>");
                });
            }
            $('#msg-create').css('display', 'none');
            $('#form-create').css('display', 'block');
        }).fail(function (response){
            console.log(response);
        });
    });
</script>
@endsection

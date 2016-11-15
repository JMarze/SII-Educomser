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
                       <a href="{{ route('admin.cronograma_carrera.index') }}" class="navbar-brand">
                           <i class="fa fa-btn fa-calendar"></i>Cronogramas de Carreras
                       </a>
                   </div>

                   <div class="collapse navbar-collapse" id="menu-panel">
                       <ul class="nav navbar-nav">
                           <li>
                               <button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#createCarrera">
                                   <i class="fa fa-btn fa-plus"></i>Agregar
                               </button>
                           </li>
                           <li class="dropdown">
                               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                   Dependencias <span class="caret"></span>
                               </a>
                               <ul class="dropdown-menu" role="menu">
                                   <li>
                                       <a href="{{ route('admin.tipo.index') }}">
                                           <i class="fa fa-btn fa-indent"></i>Tipos
                                       </a>
                                   </li>
                               </ul>
                           </li>
                           <li>
                               <a href="{{ route('admin.cronograma_carrera.index') }}">
                                   <i class="fa fa-btn fa-th"></i>Ver Todos
                               </a>
                           </li>
                       </ul>

                       {!! Form::open(['route' => 'admin.cronograma_carrera.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                       <div class="input-group">
                           {!! Form::text('buscar_cronograma', null, ['placeholder' => 'Buscar cronograma...', 'class' => 'form-control']) !!}
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
                @include('admin.cronograma.partial.tablecarrera')
            </div>

        </div>

    </div>
</div>
@include('admin.cronograma.partial.createCarrera')
@include('admin.cronograma.partial.updateCarrera')
@include('admin.cronograma.partial.destroyCarrera')
@endsection

@section('script')
@parent
<script>
    $(document).ready(function() {
        // Select2
        $('select[name="carrera_codigo"]').select2({
            placeholder: "Seleccione carrera",
            language: {
                 noResults: function(term) {
                     return "Sin coincidencias...";
                }
            },
            allowClear: true
        });
    });
    // Llenar Form -> Agregar
    $(document).on('click', 'button[data-target="#createCarrera"]', function(e){
        var urlArea = '{{ route("admin.cronograma_carrera.listar") }}';
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
            if(response['tipos'] != null && response['carreras'] != null){
                var selectTipo = $('select#tipo_id').empty().append("<option selected='selected' value=''>Seleccione tipo</option>");
                var selectCarrera = $('select#carrera_codigo').empty().append("<option selected='selected' value=''>Seleccione carrera</option>");
                $.each(response['tipos'], function(key, value){
                    selectTipo.append("<option value='"+key+"'>"+value+"</option>");
                });
                $.each(response['carreras'], function(key, value){
                    selectCarrera.append("<option value='"+key+"'>"+value+"</option>");
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

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
                       <a href="{{ route('admin.cronograma.index') }}" class="navbar-brand">
                           <i class="fa fa-btn fa-calendar"></i>Cronogramas
                       </a>
                   </div>

                   <div class="collapse navbar-collapse" id="menu-panel">
                       <ul class="nav navbar-nav">
                           <li>
                               <button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#createCurso">
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
                               <a href="{{ route('admin.cronograma.index') }}">
                                   <i class="fa fa-btn fa-th"></i>Ver Todos
                               </a>
                           </li>
                       </ul>

                       {!! Form::open(['route' => 'admin.cronograma.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
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
                @include('admin.cronograma.partial.table')
            </div>

        </div>

    </div>
</div>
@include('admin.cronograma.partial.createCurso')
@include('admin.cronograma.partial.updateCurso')
@include('admin.cronograma.partial.destroyCurso')
@include('admin.cronograma.partial.attach')
@endsection

@section('script')
@parent
<script>
    $(document).ready(function() {
        // Select2
        $('select[name="curso_codigo"]').select2({
            placeholder: "Seleccione curso",
            language: {
                 noResults: function(term) {
                     return "Sin coincidencias...";
                }
            },
            allowClear: true
        });
    });
    // Llenar Form -> Agregar
    $(document).on('click', 'button[data-target="#createCurso"]', function(e){
        var urlArea = '{{ route("admin.cronograma.listar") }}';
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
            if(response['tipos'] != null && response['cursos'] != null){
                var selectTipo = $('select#tipo_id').empty().append("<option selected='selected' value=''>Seleccione tipo</option>");
                var selectCurso = $('select#curso_codigo').empty().append("<option selected='selected' value=''>Seleccione curso</option>");
                $.each(response['tipos'], function(key, value){
                    selectTipo.append("<option value='"+key+"'>"+value+"</option>");
                });
                $.each(response['cursos'], function(key, value){
                    selectCurso.append("<option value='"+key+"'>"+value+"</option>");
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

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
                       <a href="{{ route('admin.ayuda.cursos') }}" class="navbar-brand">
                           <i class="fa fa-btn fa-question"></i>Ayuda
                       </a>
                   </div>

                   <div class="collapse navbar-collapse" id="menu-panel">
                       @include('admin.ayuda.partial.menu')

                       {!! Form::open(['route' => 'admin.ayuda.cursos', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                       <div class="input-group">
                           {!! Form::text('buscar_curso', null, ['placeholder' => 'Buscar curso...', 'class' => 'form-control']) !!}
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
                @include('admin.ayuda.partial.table_cursos')
            </div>

        </div>

    </div>
</div>
@endsection

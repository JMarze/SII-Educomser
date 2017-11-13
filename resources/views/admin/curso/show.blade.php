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
                       <a href="{{ route('admin.curso.getshow', $curso->codigo) }}" class="navbar-brand">
                           <i class="fa fa-btn fa-cube"></i>({{ $curso->codigo }}) {{ $curso->nombre }}
                       </a>
                   </div>

                   <div class="collapse navbar-collapse" id="menu-panel">
                       <ul class="nav navbar-nav">
                           <li>
                               <button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#create_capitulo">
                                   <i class="fa fa-btn fa-plus"></i>Agregar Capítulo
                               </button>
                           </li>
                       </ul>
                   </div>
               </div>
            </nav>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-5">

                    </div>
                    <div class="col-md-7">
                        {{ $curso->eslogan }}<br/><br/>
                        {{ $curso->descripcion }}
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-4">
                        <strong><i class="fa fa-btn fa-paint-brush"></i>Color:</strong> <span class="label" style="background-color: {{ $curso->color_hexa }};">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa fa-btn fa-th-large"></i>Área:</strong> {{ $curso->area->nombre }}
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa fa-btn fa-level-up"></i>Dificultad:</strong> {{ $curso->dificultad->nombre }}
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-money"></i>Costo Personalizado: </strong>Bs {{ $curso->costo_personalizado }}
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-money"></i>Costo Referencial: </strong>Bs {{ $curso->costo_referencial }}
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-clock-o"></i>Horas Académicas: </strong>{{ $curso->horas_academicas }} hrs.
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-btn fa-clock-o"></i>Horas Reales: </strong>{{ $curso->horas_reales }} hrs. ({{ $duracion }})
                    </div>
                </div>
                <hr/>
                <div class="row text-center">
                    <div class="col-md-6">
                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de creación: </strong>{{ $curso->created_at->formatLocalized('%d-%B-%Y') }} ({{ $curso->created_at->diffForHumans() }})
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fa fa-btn fa-calendar"></i>Fecha de modificación: </strong>{{ $curso->updated_at->formatLocalized('%d-%B-%Y') }} ({{ $curso->updated_at->diffForHumans() }})
                    </div>
                </div>
                <hr/>
                <div class="panel-group" id="capitulos" role="tablist" aria-multiselectable="true">
                    @foreach($curso->capitulos as $capitulo)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading_{{ $capitulo->id }}">
                            <div class="row">
                                <h3 class="panel-title col-md-10" style="margin-top:5px;">
                                    <a role="button" data-toggle="collapse" data-parent="#capitulos" href="#collapse_{{ $capitulo->id }}" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="fa fa-btn fa-list"></i>{{ $capitulo->titulo }}
                                    </a>
                                    <small>(Modificado: {{ $capitulo->updated_at->diffForHumans() }})</small>
                                </h3>
                                <div class="btn-group col-md-2" role="group" aria-label="Center Align">
                                    <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#create_topico" data-id="{{ $capitulo->id }}" title="Agregar tópico">
                                        <i class="fa fa-plus"></i>
                                        <span class="sr-only">Agregar tópico</span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#update_capitulo" data-id="{{ $capitulo->id }}" title="Editar capítulo">
                                        <i class="fa fa-edit"></i>
                                        <span class="sr-only">Editar capítulo</span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#destroy_capitulo" data-id="{{ $capitulo->id }}" title="Eliminar capítulo">
                                        <i class="fa fa-trash"></i>
                                        <span class="sr-only">Eliminar capítulo</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @if($capitulo->topicos->count() > 0)
                        <div class="panel-collapse collapse" role="tabpanel" id="collapse_{{ $capitulo->id }}" aria-labelledby="heading_{{ $capitulo->id }}">
                            <div class="panel-body">
                                <ul class="list-group">
                                    @foreach($capitulo->topicos as $topico)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <h5>{{ $topico->subtitulo }}<small>&nbsp;&nbsp;&nbsp;(Modificado: {{ $topico->updated_at->diffForHumans() }})</small></h5>
                                            </div>
                                            <div class="btn-group col-md-2" role="group" aria-label="Center Align">
                                                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#update_topico" data-id="{{ $topico->id }}" data-capitulo="{{ $capitulo->id }}" title="Editar tópico">
                                                    <i class="fa fa-edit"></i>
                                                    <span class="sr-only">Editar tópico</span>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#destroy_topico" data-id="{{ $topico->id }}" title="Eliminar tópico">
                                                    <i class="fa fa-trash"></i>
                                                    <span class="sr-only">Eliminar tópico</span>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.curso.partial.create_capitulo')
@include('admin.curso.partial.update_capitulo')
@include('admin.curso.partial.create_topico')
@include('admin.curso.partial.update_topico')
@include('admin.curso.partial.destroy_topico')
@endsection

@section('script')
@parent
<script>
    // Reset Form
    function resetForm(obj){
        obj.find('form')[0].reset();
        $('.help-block>strong').html('');
        $('.has-error').removeClass('has-error');
    }
    // Validation
    function validation(response){
        if(response.responseJSON['titulo']){
            $('.wrapper-titulo').addClass('has-error');
            $('.wrapper-titulo .help-block>strong').html(response.responseJSON['titulo']);
        }else{
            $('.wrapper-titulo').removeClass('has-error');
            $('.wrapper-titulo .help-block>strong').html('');
        }
        if(response.responseJSON['subtitulo']){
            $('.wrapper-subtitulo').addClass('has-error');
            $('.wrapper-subtitulo .help-block>strong').html(response.responseJSON['subtitulo']);
        }else{
            $('.wrapper-subtitulo').removeClass('has-error');
            $('.wrapper-subtitulo .help-block>strong').html('');
        }
    }
    // Agregar
    $(document).on('click', 'button[data-target="#create_topico"]', function(e){
        var idCapitulo = $(this).attr('data-id');
        $('#form-create_topico').attr('data-id', idCapitulo);
        $('[name="capitulo_id"]').val(idCapitulo);
    });
</script>
@endsection

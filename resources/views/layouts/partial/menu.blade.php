<li id="inicio"><a href="{{ url('/') }}">Inicio</a></li>
<li id="cursos"><a href="{{ route('curso.index') }}">Cursos</a></li>
<li id="carreras"><a href="{{ route('carrera.index') }}">Carreras</a></li>
<li id="cronograma"><a href="{{ route('cronograma.ver') }}">Cronograma</a></li>
<li id="servicios"><a href="#">Servicios</a></li>
<li id="contacto"><a href="{{ route('contacto') }}">Contacto</a></li>
@if (Auth::guest())
@else
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        {{ Auth::user()->name }} <span class="caret"></span>
    </a>

    <ul class="dropdown-menu" role="menu">
        @if(Auth::user()->tipo == 'admin')
        <li>
            <a href="{{ route('admin.curso.index') }}"><i class="fa fa-btn fa-unlock-alt"></i>&nbsp;&nbsp;&nbsp;Administrar</a>
        </li>
        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>&nbsp;&nbsp;&nbsp;Cerrar Sesión</a></li>
        @endif
    </ul>
</li>
@endif

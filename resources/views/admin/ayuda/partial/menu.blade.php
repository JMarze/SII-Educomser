<ul class="nav navbar-nav">
    <li class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
           Opciones <span class="caret"></span>
       </a>
       <ul class="dropdown-menu" role="menu">
           <li>
               <a href="{{ route('admin.ayuda.cursos') }}">
                   <i class="fa fa-btn fa-cube"></i>Cursos
               </a>
           </li>
           <li>
               <a href="{{ route('admin.ayuda.carreras') }}">
                   <i class="fa fa-btn fa-cubes"></i>Carreras
               </a>
           </li>
           <li>
               <a href="{{ route('admin.ayuda.docentes') }}">
                   <i class="fa fa-btn fa-user-plus"></i>Docentes
               </a>
           </li>
       </ul>
    </li>
</ul>

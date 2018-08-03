@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>
            
            @can('users_manage')
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title">@lang('global.archivos.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'personal' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.personal.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.personal.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'centros' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.centros.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.centros.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'profesionales' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.profesionales.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.profesionales.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'laboratorios' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.laboratorios.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.laboratorio.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'analisis' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.analisis.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.analisis.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'servicios' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.servicios.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.servicios.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'paquetes' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.paquetes.index') }}">
                            <i class="fa fa-male"></i>
                            <span class="title">
                                @lang('global.paquetes.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'pacientes' ? 'active active-sub' : '' }}">
                        <a href="{{asset('/pacientes/index')}}">
                            <i class="fa fa-male"></i>
                            <span class="title">
                                @lang('global.pacientes.title')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-retweet"></i>
                    <span class="title">@lang('global.movimientos.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'productos' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.productos.create') }}">
                            <i class="fa fa-plus-square"></i>
                            <span class="title">
                                @lang('global.productos.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'existencias' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.productos.index') }}">
                            <i class="fa fa-edit"></i>
                            <span class="title">
                                @lang('global.existencias.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'ingresos' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.ingresos.index') }}">
                            <i class="fa fa-bars"></i>
                            <span class="title">
                                @lang('global.ingresos.title')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

             <li class="treeview">
                <a href="#">
                    <i class="fa fa-check-square-o"></i>
                    <span class="title">@lang('global.existenciass.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'atencion' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.atencion.index') }}">
                            <i class="fa fa-h-square"></i>
                            <span class="title">
                                @lang('global.atencion.title')
                            </span>
                        </a>
                    </li>
                </ul>
                    <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'gastos' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.gastos.index') }}">
                            <i class="fa fa-share"></i>
                            <span class="title">
                                @lang('global.gastos.title')
                            </span>
                        </a>
                    </li>
                </ul>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'labporpagar' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.labporpagar.index') }}">
                            <i class="fa fa-money"></i>
                            <span class="title">
                                @lang('global.labporpagar.title')
                            </span>
                        </a>
                    </li>
                </ul>
                 <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'otrosingresos' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.otrosingresos.index') }}">
                            <i class="fa fa-reply "></i>
                            <span class="title">
                                @lang('global.otrosingresos.title')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

               <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-pdf-o"></i>
                    <span class="title">@lang('global.reportes.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'atenciondiaria' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.atenciondiaria.index') }}">
                            <i class="fa fa-file"></i>
                            <span class="title">
                                @lang('global.atenciondiaria.title')
                            </span>
                        </a>
                    </li>
                </ul>
                    
             
                 
            </li>

            
            @endcan

            @can('users_managefull')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'abilities' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.abilities.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.abilities.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.roles.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.users.title')
                            </span>
                        </a>
                    </li>
                     <li class="{{ $request->segment(2) == 'sedesafilia' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.sedesafilia.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.sedesafilia.title')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            @endcan

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Modificar Contraseña</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('global.logout')</button>
{!! Form::close() !!}

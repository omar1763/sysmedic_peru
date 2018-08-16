<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/admin/home') }}" class="logo"
       style="font-size: 16px;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
           @lang('global.global_title')</span>

        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
           @lang('global.global_title')</span>
          
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
           
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

                         
        <p style="color: white;margin-left: 950px;margin-top: -1px;">BIENVENIDO: {{Auth::user()->name}}</p>
        <p style="color: white;margin-top: -15px;">EMPRESA: {{Auth::user()->empresa}}</p>
        <p style="color: white;margin-top: -15px;margin-bottom: -1px;">SUCURSAL: {{Auth::user()->sucursal}}</p>



        

    </nav>
  
</header>



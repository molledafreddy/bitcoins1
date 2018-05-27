
<!-- Main Sidebar -->
<div id="sidebar">
    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Brand -->
            <a href="{{ route('admin.index') }}" class="sidebar-brand">
                <img src="{{asset('images/fav.png')}}" height="40"><span class="sidebar-nav-mini-hide"><strong> Bitcoin</strong>Bogota</span>
            </a>
            <!-- END Brand -->

            <!-- User Info -->
            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                <div class="sidebar-user-avatar">
                        <img @if(!empty($logo_user->value))  src="{{$logo_user->value}}" @else src="{{asset('images/fav.png')}}" @endif alt="avatar">
                </div>
                <div class="sidebar-user-name">{{Auth::user()->username}}</div>
                <div class="sidebar-user-links">
                    <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.html in PHP version) -->
                    <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="configuración" onclick="$('#modal-user-settings').modal('show');"><i class="gi gi-cogwheel"></i></a>
                    <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="bottom" title="Salir"><i class="gi gi-exit"></i></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                    </form>
                </div>
            </div>
            <!-- END User Info -->


            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li>

                    <a href="{{ route('admin.index') }}" class=" active"><i class="fa fa-window-maximize sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Inicio</span></a>
                </li>
                <li class="sidebar-header">
                    <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Administración"><i class="fa fa-bar-chart"></i></a><a href="javascript:void(0)" data-toggle="tooltip" title="Create the most amazing pages with the widget kit!"></a></span>
                    <span class="sidebar-header-title">Administración</span>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}"><i class="fa fa-users sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Usuarios</span></a>
                </li>
                <li>
                    <a href="{{ route('transaction-verification.index') }}"><i class="gi gi-share_alt sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Transacciones</span></a>
                </li>
                <li class="sidebar-header">
                    <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Mensajeria"><i class="fa fa-envelope"></i></a></span>
                    <span class="sidebar-header-title">Mensajeria</span>
                </li>
                <li>
                    <a href="{{ route('admin.comment.index') }}" ><i class="fa fa-envelope-open sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Mensajes</span></a>
                </li>
                <li class="sidebar-header">
                    <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Contenido"><i class="fa fa-image"></i></a></span>
                    <span class="sidebar-header-title">Contenido</span>
                </li>
                <li>
                    <a href="{{ route('load-contents.index') }}" ><i class="fa fa-cloud-upload sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Carga de contenido</span></a>
                </li>
                <li>
                    <a href="{{ route('parameters.index') }}" ><i class="fa fa-wrench sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Parametros</span></a>
                </li>
                <li class="sidebar-header">
                        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Quick Settings"><i class="gi gi-wallet"></i></a></span>
                        <span class="sidebar-header-title">Cuentas</span>
                    </li>
                    <li>
                        <a href="{{ route('payment-data.index') }}" ><i class="fa fa-list sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Tipos de Cuentas</span></a>
                    </li>
                    <li>
                        <a href="{{ route('accounts.index') }}" ><i class="gi gi-wallet sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Cuentas</span></a>
                    </li>
            </ul>
            <!-- END Sidebar Navigation -->

        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Main Sidebar -->
@extends('admin.template.main') @section('content')

<!-- Dashboard Header -->
<!-- For an image header add the class 'content-header-media' and an image as in the following example -->
<div class="content-header content-header-media">
    <div class="header-section">
        <div class="row">
            <!-- Main Title (hidden on small devices for the statistics to fit) -->
            <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                <h1>Bienvenido <strong>Administrador</strong></h1>
            </div>
            <!-- END Main Title -->


        </div>
    </div>
    <!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
    <img src="img/placeholders/headers/dashboard_header.jpg" alt="header image" class="animation-pulseSlow">
</div>
<!-- END Dashboard Header -->
<div class=" col-sm-12 m-b-30"></div>

<!-- Mini Top Stats Row -->
<div class="row">
    <div class="col-sm-6 col-lg-4">
        <!-- Widget -->
        <a href="{{ route('admin.users.index') }}" class="widget widget-hover-effect1">
            <div class="widget-simple">
                <div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
                    <i class="fa fa-users"></i>
                </div>
                <h3 class="widget-content text-right animation-pullDown">
                    0 <strong>Usuarios</strong><br>
                    <small>Usuarios Registrados</small>
                </h3>
            </div>
        </a>
        <!-- END Widget -->
    </div>
    <div class="col-sm-6 col-lg-4">
        <!-- Widget -->
        <a href="{{ route('transaction-verification.index') }}" class="widget widget-hover-effect1">
            <div class="widget-simple">
                <div class="widget-icon pull-left themed-background-spring animation-fadeIn">
                    <i class="gi gi-usd"></i>
                </div>
                <h3 class="widget-content text-right animation-pullDown">
                    0 <strong>Transacciones</strong><br>
                    <small>Transacciones Realizadas</small>
                </h3>
            </div>
        </a>
        <!-- END Widget -->
    </div>
    <div class="col-sm-6 col-lg-4">
        <!-- Widget -->
        <a href="{{ route('admin.comment.index') }}" class="widget widget-hover-effect1">
            <div class="widget-simple">
                <div class="widget-icon pull-left themed-background-fire animation-fadeIn">
                    <i class="gi gi-envelope"></i>
                </div>
                <h3 class="widget-content text-right animation-pullDown">
                    0 <strong>Mensajes</strong>
                    <small>Mensajes de Clientes</small>
                </h3>
            </div>
        </a>
        <!-- END Widget -->
    </div>
    <div class=" col-sm-12 m-b-50"></div>
    <div class="col-sm-6 ">
        <!-- Widget -->
        <a href="{{ route('load-contents.index') }}" class="widget widget-hover-effect1">
            <div class="widget-simple">
                <div class="widget-icon pull-left themed-background-amethyst animation-fadeIn">
                    <i class="fa fa-cloud-upload"></i>
                </div>
                <h3 class="widget-content animation-pullDown">
                    <strong>Carga de Contenido</strong>
                    <small>Terminos,condiciones,consejos.</small>
                </h3>
            </div>
        </a>
        <!-- END Widget -->
    </div>
    <div class="col-sm-6 ">
        <!-- Widget -->
        <a href="{{ route('parameters.index') }}" class="widget widget-hover-effect1">
            <div class="widget-simple">
                <div class="widget-icon pull-left themed-background-amethyst animation-fadeIn">
                    <i class="fa fa-wrench"></i>
                </div>
                <h3 class="widget-content  animation-pullDown">
                    <strong>Parametros</strong>
                    <small>Comisiones,Correo.</small>
                </h3>
            </div>
        </a>
        <!-- END Widget -->
    </div>
    <div class="col-sm-6">
        <!-- Widget -->
        <a href="{{ route('payment-data.index') }}" class="widget widget-hover-effect1">
            <div class="widget-simple">
                <div class="widget-icon pull-left themed-background animation-fadeIn">
                    <i class="fa fa-list"></i>
                </div>
                <div class="pull-right">
                    <!-- Jquery Sparkline (initialized in js/pages/index.js), for more examples you can check out http://omnipotent.net/jquery.sparkline/#s-about -->
                    <span id="mini-chart-sales"></span>
                </div>
                <h3 class="widget-content animation-pullDown ">
                     <strong>Tipos de Cuentas</strong>
                </h3>
            </div>
        </a>
        <!-- END Widget -->
    </div>
    <div class="col-sm-6">
        <!-- Widget -->
        <a href="{{ route('accounts.index') }}" class="widget widget-hover-effect1">
            <div class="widget-simple">
                <div class="widget-icon pull-left themed-background animation-fadeIn">
                    <i class="gi gi-wallet"></i>
                </div>
                <div class="pull-right">
                    <!-- Jquery Sparkline (initialized in js/pages/index.js), for more examples you can check out http://omnipotent.net/jquery.sparkline/#s-about -->
                    <span id="mini-chart-brand"></span>
                </div>
                <h3 class="widget-content animation-pullDown ">
                    <strong>Cuentas</strong>
                </h3>
            </div>
        </a>
        <!-- END Widget -->
    </div>
</div>
<!-- END Mini Top Stats Row -->


@endsection
       <div class="wheel-menu-wrap ">
            <div class="container-fluid wheel-bg1">
                <div class="row">
                    <div class="col-sm-3">
                    <a href="{{route('siteHome')}}">
                        <div class="wheel-logo">
                            <img src="{{asset('images/logo.png')}}" alt="">
                        </div>
                    </a>
                    </div>
                    <div class="col-sm-9 col-xs-12 padd-lr0">
                        <div class="wheel-top-menu clearfix">
                            <div class="wheel-top-menu-info">
                                <div class="top-menu-item"><a href="{{ route('contact') }}"><i class="fa fa-phone"></i><span>(+57) 35 0835 7856</span></a></div>
                                <div class="top-menu-item"><a href="{{ route('contact') }}"><i class="fa fa-envelope"></i><span>contacto@bitcoinbogota.co</span></a></div>
                            </div>
                            <div class="wheel-top-menu-log">
                                <div class="top-menu-item">
                                    <div class="dropdown wheel-user-ico">
                                        <button class="btn btn-default dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        @if(Auth::guest()) Tu Cuenta @else {{ Auth::user()->name }} @endif
                                        <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @if(Auth::guest())
                                                <li><a href="{{ route('login') }}">Entrar</a></li>
                                                <li><a href="{{ route('register') }}">Registrar</a></li>
                                                
                                            @else
                                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salida</a></li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                                    {{-- expr --}}
                                                @if (session()->has('key'))
                                                    <li><a href="{{ route('renew_reg') }}">Renovar Token de Google</a></li>
                                                @endif 
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 ">
                        <div class="wheel-navigation">
                            <nav id="dl-menu">
                                <!-- class="dl-menu" -->
                                <ul class="main-menu dl-menu">
                                    <li class="menu-item   current-menu-parent menu-item-has-children ">
                                    @if(Auth::guest())  
                                        <a href="{{route('siteHome')}}">Inicio</a> 
                                    @else 
                                        @if(Auth::user()->type == 'U')
                                            <a href="{{route('user.panel')}}">Panel</a>
                                        @elseif(Auth::user()->type == 'A')
                                            <a href="{{route('admin.index')}}">Panel</a>
                                        @endif
                                    @endif
                                    </li>
                                    <li class="menu-item current-menu-parent menu-item-has-children  ">
                                    <a @if(Auth::guest()) href="{{route('buy_offers')}}" @else href="{{route('user_buy_offers')}}" @endif> Comprar Bitcoins </a>
                                    </li>
                                    <li class="menu-item current-menu-parent menu-item-has-children  ">
                                        <a @if(Auth::guest()) href="{{route('sell_offers')}}" @else  href="{{route('user_sell_offers')}}" @endif> Vender Bitcoins </a>
                                    </li>
                                    <li class="menu-item menu-item-has-children  coming">
                                        <a href="#">Blog</a>
                                    </li>

                                </ul>
                                <div class="nav-menu-icon"><i></i></div>
                            </nav>
                            <a  @if(Auth::guest()) href="{{ route('login') }}" @else href="{{ route('offer.dashboard') }}" @endif class="wheel-cheader-but">Colocar Anuncio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('site.template.modals.comingsoon')

        <script>
        $( "body" ).on( "click", ".coming", function() {
 $('#modalcoming').modal('show'); 
});
        </script>
        @inject('home', 'App\Http\Controllers\HomeController')
        <!-- FOOTER -->
        <!-- ///////////////// -->
        <footer class="wheel-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3  col-sm-6  padd-lr0">
                        <div class="wheel-address">
                            <div class="wheel-footer-logo"><a href=""><img src="images/logo.png" alt="bitcoins"></a></div>
                            <ul>
                                <li><span><i class="fa fa-map-marker"></i>Carrera 70 #78-28 <br>
                                Barrio Bonanza Bogota Colombia  </span>
                                </li>
                                <li><a href=""><span><i class="fa fa-phone"></i> +57 35 0835 7856</span></a></li>
                                <li><a href=""><span><i class="fa fa-envelope"></i>contacto@bitcoinbogota.co</span></a></li>
                            </ul>
                            <div class="wheel-soc">
                                <a href="" class="fa fa-twitter"></a>
                                <a href="" class="fa fa-facebook"></a>
                                <a href="" class="fa fa-linkedin"></a>
                                <a href="" class="fa fa-instagram"></a>
                                <a href="" class="fa fa-share-alt"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6  padd-lr0">
                        <div class="wheel-footer-item">
                            <h3>Nuestros Sitio</h3>
                            <ul>
                                <li><a href="{{ route('about_us') }}" class="">Sobre Nosotros</a></li>
                                {{-- <li><a href="{{ route('services') }}" class="">Servicios al cliente</a></li> --}}
                                <li><a href="{{ route('contact') }}" class="">Contactanos</a></li>
                                <li><a href="{{ route('buy_offers') }}" class="">Comprar bitcoins</a></li>
                                <li><a href="{{ route('sell_offers') }}" class="">Vender bitcoins</a></li>
                                <li><a href="#" class="">Poner un anuncio</a></li>
                                <li><a href="{{ route('login') }}" class="">Ingresar</a></li>
                                <li><a href="{{ route('register') }}" class="">Registrarse</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6  padd-lr0">
                        <div class="wheel-footer-item ">
                            <h3>Políticas</h3>
                            <ul>
                                @foreach ($home->content() as $content)
                                    <li><a href="{{ route('load_home_content', $content->id) }}" class="">{{$content->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 padd-lr0">
                        <div class="wheel-footer-gallery">
                            <h3>Patrocinadores</h3>
                            <div class="  clearfix">
                                <a href="https://enarriendo.co" target="_blanck">
                                    <img width="160" src="{{asset('images/enarrendamientoNegativo.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </footer>

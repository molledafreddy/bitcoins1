@extends('site.template.main')

@section('content')
        <div class="wheel-register-block" style="background-size: cover;background-image:url({{ asset('images/bg6.jpg') }});">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-md-offset-3 padd-r0">
                        <div class="wheel-register-log marg-lg-t150 marg-lg-b150 marg-sm-t100 marg-sm-b100">
                            <div class="wheel-header">
                                <h5>Registro de <span> Autenticador de Google</span></h5>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xs-12 text-center">
                                    <p>Por favor escanee el siguiente código QR, alternativamente puede usar el siguiente codigo: <span class="help-block"><strong>{{$secret}}</strong></span></p>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-12 col-xs-12 text-center">
                                    <img src="{{$qr_image}}">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 col-xs-12 text-center">
                                    <p>Debe escanear obligatoriamente el código de lo contrario no podrá iniciar sesión en nuestro portal</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <a href="{{route('siteHome')}}"><button class="wheel-btn text-center">Completar Registro</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

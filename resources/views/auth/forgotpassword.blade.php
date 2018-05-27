@extends('site.template.main')

@section('content')
        <div class="wheel-register-block" style="background-size: cover;background-image:url({{ asset('images/bg6.jpg') }});">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-md-offset-3 padd-l0">
                        <div class="wheel-register-log marg-lg-t150 marg-lg-b150 marg-sm-t100 marg-sm-b100">
                            <div class="wheel-header">
                                <center>
                                    <h3 style="padding-bottom:10px" >¿Olvidaste tu Contraseña?</h3>
                                    <h4 style="padding-bottom:15px">Ingresa tu correo electronico y te ayudaremos a crear una nueva contraseña.</h4>
                                </center>
                            </div>
                        <form class="form-horizontal" role="form" method="POST" action="{{route('recuperar.password')}}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <label for="userName" class="fa fa-mail"><input type="email" placeholder="Correo Electrónico" name="email"  value="{{ old('login') }}" maxlength="191" required></label>
                                    </div>
                                </div>
                                <button class="wheel-btn">Siguiente</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
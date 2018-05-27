@extends('site.template.main')

@section('content')
        <div class="wheel-register-block" style="background-size: cover;background-image:url({{ asset('images/bg6.jpg') }});">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-md-offset-4 padd-l0">
                        <div class="wheel-register-log marg-lg-t150 marg-lg-b150 marg-sm-t100 marg-sm-b100">
                            <div class="wheel-header">
                                <h5 > Iniciar Sesión</h5>
                            </div>
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <center><text class="verde">Debe iniciar sesión para realizar cualquier proceso o transaccion en la pagina.</text></center><br>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <label for="userName" class="fa fa-user"><input type="text" placeholder="Usuario / Correo Electrónico" name="login"  value="{{ old('login') }}" maxlength="191" required></label>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <label for="userPass" class="fa fa-lock"><input type="password" placeholder='Contraseña' name="password" maxlength="191" required></label>
                                    </div>
                                </div>
                                <button class="wheel-btn">Entrar</button>
                                <label class="password-sing clearfix" for="input-val2">
                                <input type='checkbox' name="remember" {{ old( 'remember') ? 'checked' : '' }}><span>Recordarme</span>
                                <a href="{{route('auth.forgetpassword')}}">Olvidaste la Contraseña?</a>
                                </label>
                                <center><span class="wheel-register-log-crear">¿No estas Registrado? <a href="{{route('register')}}">Crea una Cuenta</a></span></center><br>

                            </form> 
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

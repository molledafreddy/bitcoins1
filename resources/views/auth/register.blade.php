@extends('site.template.main') @section('content')
<div class="wheel-register-block" style="background-size: cover;background-image:url({{ asset('images/bg6.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-md-offset-3 padd-r0">
                <div class="wheel-register-sign marg-lg-t150 marg-lg-b150 marg-sm-t100 marg-sm-b100">
                    <div class="wheel-header">
                        <h3> <span>Registrarme</span></h3>
                    </div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <input type="text" placeholder="Nombre" name="name" value="{{ old('name') }}" maxlength="191" style="width: 100%" required> @if ($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span> @endif
                            </div>

                            <div class="col-md-6 col-xs-12">
                                <input type="text" placeholder="Apellido" name="lastname" value="{{ old('lastname') }}" maxlength="191" style="width: 100%" required> @if ($errors->has('lastname'))
                                <span class="help-block"><strong>{{ $errors->first('lastname') }}</strong></span> @endif
                            </div>

                            <div class="col-md-6 col-xs-12">
                                <input type="email" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" maxlength="191" style="width: 100%" required> @if ($errors->has('email'))
                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span> @endif
                            </div>

                            <div class="col-md-6 col-xs-12">
                                <input type="text" placeholder="Usuario" name="username" value="{{ old('username') }}" maxlength="191" style="width: 100%" required> @if ($errors->has('username'))
                                <span class="help-block"><strong>{{ $errors->first('username') }}</strong></span> @endif
                            </div>

                            <div class="col-md-6 col-xs-12">
                                <div class="dropdown">

                                    <input class="password dropdown-toggle" id="dropdownMenu1" type="password" placeholder="Contraseña" name="password" value="" minlength="6" style="width: 100%" required>
                                    <a class="" href="#"></a>
                                    @if ($errors->has('password'))
                                    <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span> @endif

                                    <ul class="dropdown-menu show_info" id="reglas" role="menu" aria-labelledby="dropdownMenu1" style="    font-weight: bold;">
                                        <li role="presentation"> La contraseña debe contener:</li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation"> Almenos una letra. <i class="fa fa-times" id="1letra" style="color: red; cursor: pointer;" aria-hidden="true"></i><i class="fa fa-check" id="1letra2" style="color: green; cursor: pointer;display:none" aria-hidden="true"></i></li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation"> Almenos una en mayusculas <i class="fa fa-times" id="1mayuscula" style="color: red; cursor: pointer;" aria-hidden="true"></i><i class="fa fa-check" id="1mayuscula2" style="color: green; cursor: pointer;display:none" aria-hidden="true"></i></li>
                                        <li role="presentation" class="divider"> </li>
                                        <li role="presentation"> Almenos un número <i class="fa fa-times" id="1numero"  style="color: red; cursor: pointer;" aria-hidden="true"></i><i class="fa fa-check" id="1numero2" style="color: green; cursor: pointer;display:none" aria-hidden="true"></i></li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation"> Almenos un caracter especial <i class="fa fa-times" id="1especial"  style="color: red; cursor: pointer;" aria-hidden="true"></i><i class="fa fa-check" id="1especial2" style="color: green; cursor: pointer;display:none" aria-hidden="true"></i></li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation"> Minimo 8 caracteres <i class="fa fa-times" id="8caracteres"  style="color: red; cursor: pointer;" aria-hidden="true"></i><i class="fa fa-check" id="8caracteres2" style="color: green; cursor: pointer;display:none" aria-hidden="true"></i></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-xs-12">
                            <div class="dropdown">

                                <input class="password2 dropdown-toggle" type="password"  id="dropdownMenu2" placeholder="Confirmación de Contraseña" name="password_confirmation" value="" minlength="6" style="width: 100%" required> @if ($errors->has('password_confirmation'))
                                <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span> @endif

                                <ul class="dropdown-menu show_info" id="coincidir" role="menu" aria-labelledby="dropdownMenu2" style="    font-weight: bold;">
                                        <li role="presentation"> Las contraseñas son iguales. <i class="fa fa-times" id="iguales" style="color: red; cursor: pointer;" aria-hidden="true"></i><i class="fa fa-check" id="iguales2" style="color: green; cursor: pointer;display:none" aria-hidden="true"></i></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-8 col-md-offset-3 col-xs-9 col-xs-offset-3" style="margin-bottom:10px">
                                {!! Recaptcha::render() !!} @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block"><strong>{{ $errors->first('g-recaptcha-response') }}</strong></span> @endif
                            </div>
                            <center>
                                <label for="input-val1">
                                        <input type="checkbox" name="foo" class="terminos pull-left" style="padding-left:14px"id='input-val1'  oninvalid="this.setCustomValidity('Debe aceptar los Terminos y Condiciones antes de continuar.')" onchange="this.setCustomValidity('')" required>
                                        Acepto los Terminos y Condiciones
                                    </label>
                                    @include('site.template.modals.law_and-terms')

                            </center>
                            <button id="boton_registro" class="wheel-btn" >Registrarme</button>
                        </div>
                        <center><span class="wheel-register-log-crear ">¿Ya estas Registrado? <a href="{{route('login')}}">Inicia Sesión</a></span></center><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.js"></script>
<script>
    $(document).ready(function() {
        $(".password").focus(function(ev) {
            $("#reglas").css("display", "block");
        });

        $(".password").focusout(function() {
            $("#reglas").css("display", "none");
        });

        $(".password2").focus(function(ev) {
            $("#coincidir").css("display", "block");
        });

        $(".password2").focusout(function() {
            $("#coincidir").css("display", "none");
        });

    });




$("#dropdownMenu1").on("keyup", function() {
    var pswd = $(this).val();
    var pswd2 = $("#dropdownMenu2").val();
    var count = 0;

    if(pswd.length > 0) { $( "#1letra" ).hide();$( "#1letra2" ).show();  count++;  }else{ $( "#1letra" ).show();$( "#1letra2" ).hide();count--;}
    if(pswd.length > 7) { $( "#8caracteres" ).hide(); $( "#8caracteres2" ).show(); count++;  }else{ $( "#8caracteres" ).show();$( "#8caracteres2" ).hide();count--;}
    if( pswd.match(/[A-Z]/) ) {$( "#1mayuscula" ).hide(); $( "#1mayuscula2" ).show(); count++; } else { $( "#1mayuscula" ).show();$( "#1mayuscula2" ).hide();count--; }
    if( pswd.match(/\d/) ) {$( "#1numero" ).hide(); $( "#1numero2" ).show(); count++;} else { $( "#1numero" ).show();$( "#1numero2" ).hide(); count--;}
    if( pswd.match(/[,."!@#$%\^&*(){}[\]<>?/|\-]/) ) {$( "#1especial" ).hide(); $( "#1especial2" ).show(); count++;} else { $( "#1especial" ).show();$( "#1especial2" ).hide();count--; }
    if(pswd == pswd2 && count==5 ) { $( "#iguales" ).hide();$( "#iguales2" ).show();$('#boton_registro').attr("disabled", false);}else{ $( "#iguales" ).show();$( "#iguales2" ).hide();$('#boton_registro').attr("disabled", true);}

});

$("#dropdownMenu2").on("keyup", function() {
    var pswd = $(this).val();
    var pswd2 = $("#dropdownMenu1").val();
    var count = 0;

    if(pswd2.length > 0) { $( "#1letra" ).hide();$( "#1letra2" ).show(); count++;   }else{ $( "#1letra" ).show();$( "#1letra2" ).hide();count--;}
    if(pswd2.length > 7) { $( "#8caracteres" ).hide(); $( "#8caracteres2" ).show();count++;   }else{ $( "#8caracteres" ).show();$( "#8caracteres2" ).hide();count--;}
    if( pswd2.match(/[A-Z]/) ) {$( "#1mayuscula" ).hide(); $( "#1mayuscula2" ).show();count++;} else { $( "#1mayuscula" ).show();$( "#1mayuscula2" ).hide();count--; }
    if( pswd2.match(/\d/) ) {$( "#1numero" ).hide(); $( "#1numero2" ).show();count++;} else { $( "#1numero" ).show();$( "#1numero2" ).hide();count--; }
    if( pswd2.match(/[,."!@#$%\^&*(){}[\]<>?/|\-]/) ) {$( "#1especial" ).hide(); $( "#1especial2" ).show();count++;} else { $( "#1especial" ).show();$( "#1especial2" ).hide();count--; }
    if(pswd == pswd2) { $( "#iguales" ).hide();$( "#iguales2" ).show(); count++;}else{ $( "#iguales" ).show();$( "#iguales2" ).hide();count--;}

    if(count==6) {$('#boton_registro').attr("disabled", false);}else {$('#boton_registro').attr("disabled", true);}

});



$( "body" ).on( "click", ".terminos", function() {

   $("#leydeuso").modal({
            backdrop: 'static',
            keyboard: false
    });
if( $('input[name=foo]').is(':checked') == true){
    $('#leydeuso').modal('show'); }
});


</script>
@endsection

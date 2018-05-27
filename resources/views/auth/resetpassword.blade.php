@extends('site.template.main')

@section('content')
        <div class="wheel-register-block" style="background-size: cover;background-image:url({{ asset('images/bg6.jpg') }});">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-md-offset-3 padd-l0">
                        <div class="wheel-register-log marg-lg-t150 marg-lg-b150 marg-sm-t100 marg-sm-b100">
                            <div class="wheel-header">
                                <center>
                                    <h3 style="padding-bottom:10px" >Cambio de Contraseña</h3>
                                    <h4 style="padding-bottom:15px">Ingresa una nueva contraseña.</h4>
                                </center>
                            </div>
                        <form class="form-horizontal" role="form" method="POST" action="{{route('resetear.password')}}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <input type="password" placeholder="Contraseña" name="password" maxlength="191" >
                                        @if ($errors->has('password'))
                                            <div class="alert alert-danger ContError" role="alert">{{ $errors->first('password') }}</div>
                                        @endif
                                        <input type="password" placeholder="Repita la contraseña" name="confirm_password" maxlength="191" >
                                        @if ($errors->has('confirm_password'))
                                            <div class="alert alert-danger ContError" role="alert">{{ $errors->first('confirm_password') }}</div>
                                        @endif
                                        <label for="token" class="fa fa-mail"><input type="hidden" placeholder="Contraseña" name="token" value="{{$token}}" maxlength="191" ></label>
                                    </div>
                                </div>
                                <button class="wheel-btn">Aceptar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $("input").on("focus",function(event){
                    event.stopPropagation();
                    console.log("entro");
                    $(this).siblings(".ContError").hide();
                });
            });

        </script>
@endsection

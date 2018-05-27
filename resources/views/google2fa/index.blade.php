@extends('site.template.main')

@section('content')
        <div class="wheel-register-block" style="background-size: cover;background-image:url({{ asset('images/bg6.jpg') }});">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-md-offset-3 padd-r0">
                        <div class="wheel-register-sign marg-lg-t150 marg-lg-b150 marg-sm-t100 marg-sm-b100">
                            <div class="wheel-header">
                                <h3> <span>Ingresa tu Token de Google</span></h3>
                            </div>
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('2fa') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <input type="number" placeholder="Token Google" name="one_time_password" value="{{ old('one_time_password') }}" maxlength="191" style="width: 100%" required>
                                        @if ($errors->has('one_time_password'))
                                            <span class="help-block"><strong>{{ $errors->first('one_time_password') }}</strong></span>
                                        @endif
                                    </div>
                                    <button class="wheel-btn" type="submit">Completar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@extends('site.template.main') @section('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

<!--  Centro -->
@include('site.template.partials.wireframe')
<div class="contLoadingSearch oculto">
    <div class="loader"></div>
</div>
<div  id="search-content"></div>
<!-- ////////////////////////////////////////// -->


<!--  ofertas -->
@include('site.template.partials.OfferList')
{{-- contenedor del chat --}}
<div class="" id="contChat"></div>

<div class="wheel-start wheel-start2 col-md-12 col-xs-12" style="background-color: #eceff1;padding-bottom:60px">
    <div class="container">
        <div class="col-lg-12">
            <header class="wheel-header  wheel-testi-header text-center " style="padding-top:30px">
                <h3>Últimas <span>Noticias</span> </h3>
            </header>
        </div>
    </div>
</div>

<!--  Noticias -->
    @include('site.template.partials.CarrouselNews')
<!-- ////////////////////////////////////////// -->

<!--  testimonios -->
    @include('site.template.partials.Testimonials')
<!-- ////////////////////////////////////////// -->


<!-- ////////////////////////////////////////// -->
<div class="wheel-app-body">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="wheel-app-img marg-lg-t90 marg-md-t50"><img src="{{ asset('images/i19.png') }}"></div>
            </div>
            <div class="col-md-8">
                <div class="wheel-app-text  marg-lg-t140 marg-md-b50 marg-md-t50">
                    <header class="wheel-header text-center">
                        <h5>PROXIMAMENTE!</h5>
                        <h3>Será mas facil que <span>nunca!</span></h3>
                    </header>
                    <p>Comprar y vender bitcoins nunca será tan fácil.</p>
                    <div class="wheel-app  text-center">
                        <a href=""><img src="{{ asset('images/ico9.png') }}"></a>
                        <a href=""><img src="{{ asset('images/ico10.png') }}"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ////////////////////////////////////////// -->
<div class="wheel-subscribe wheel-bg2">
    <div class="container ">
        <div class="row">
            <div class="col-md-4 col-xs-4 padd-lr0 pull-left">
                <div class="wheel-header">
                    <div>
                        <h5>Nuestras Noticias</h5>
                    </div>
                    <h3 >Suscribete y recibe noticias sobre el mercado de criptomonedas y ofertas en nuestra pagina</h3>
                </div>
            </div>
            <div class="col-md-8 col-xs-8 padd-lr0 pull-rigth">
                <form id="form-subscription" action="#" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="alert alert-danger print-error-msg" style="display: none;">
                        <ul></ul>
                    </div>
                    <div class="pu">
                        <input type="text" name="email" placeholder="Tu Correo Electronico ">
                        <button type="submit" class="wheel-btn">Suscribirse</button>
                    </div>
                    <div class="col-lg-12">
                        <div class="message-sucess alert alert-success" style="display: none;"> La solicitud se ha enviado exitosamente!</div>
                        <div class="message-error alert alert-danger" style="display: none;"> Ha ocurrido un error al realizar el proceso!</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function(){

        $('#content-load-data-sell').load("{{ route('sell_offers') }}", function(){
        });

        $('#content-load-data-buy').load("{{ route('buy_offers') }}", function(){
        });

        $('body').on('submit', '#form-subscription', function(event){
            event.preventDefault();
            showLoading(1);

            $.ajax({
                type:"POST",
                url:"{{ route('subscriptions.store') }}",
                dataType:"json",
                data:$(this).serialize(),
                success:function(response){
                    if($.isEmptyObject(response.error)){
                        $('.message-sucess').show();
                        showLoading(2);
                        setTimeout(function() {
                            $('.message-sucess').hide();
                        }, 3000);
                    } else {
                        showLoading(2);
                        printErrorMsg(response.error);
                    }
                },
                error:function(response){
                    console.log(response);
                }
            });
        });

        function printErrorMsg (msg, type) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    });
</script>
@endpush
@endsection

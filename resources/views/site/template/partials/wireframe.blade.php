
@if ($type == '')
<div class=" padd-lr0">
    <div class="wheel-start-form wheel-start-form2  marg-md-t0 main-form" style="background-image:url({{ asset('images/bg5.jpg') }})">

        <div class="btcmain">
            <div>
                <div id="maindiv2"></div>
                <h5 class="form-title-h5 eslogan">Te ofrecemos el mas rápido, sencillo y confiable proceso de compra y venta de Criptomonedas,Sientete libre de usar medios de pago como <br> PSE, PayU, transferencias bancarias y mas. </h5>
            </div>
            <form action="#" id="search-form" >
                {{ csrf_field() }}
                <div style="background-color: rgba(0, 0, 0, 0.18) !important;margin: 15px;">
                    <h5 class="form-title-h5 eslogan text-center">Búsqueda Rápida</h5>
                    <div class="clearfix clearfix2 ">
                        <div class="col-lg-3 col-sm-6 col-md-3">
                            <div class="wheel-date col-lg-12  " for="input-val20">
                                <span class="fa fa-usd" aria-hidden="true"></span>
                                <span >Cantidad</span>
                                <input name="quantity"   id="quantity" placeholder="" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-md-3">
                            <div class="wheel-date col-lg-12">
                                <span class="fa fa-money fa-3x"></span>
                                <span> Moneda</span>
                                <select name="moneda" class="selectpicker">
                                    <option value="1">Pesos</option>
                                    <option value="2">Bitcoins</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-md-3">
                            <div class="wheel-date col-lg-12">
                                <span class="fa fa-bars" aria-hidden="true"></span>
                                <span>Operación</span>
                                <select name="type" id="type" class="selectpicker">
                                    <option value="buy">Comprar</option>
                                    <option value="seller">Vender</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-md-3">
                            <label for="input-val27" class="promo promo2 col-lg-12">
                                <button type="submit" class="wheel-btn" id='input-val27'>Buscar </button>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <form action="" id="vender-form" style="display:none">
            <div class="clearfix clearfix2">
                <h5 class="form-title-h5">Vender Cryptomoneda</h5>
                <div class="col-lg-4">
                    <label class="col-lg-12 " for="input-val20"><span>Cantidad</span>
                                <input type="text" id=input-val20 placeholder="" required>
                            </label>
                </div>
                <div class="col-lg-4">
                    <label class="col-lg-12" for="input-val21"><span>Lugar</span>
                        <input type="text" id=input-val21 placeholder="" required>
                    </label>
                </div>
                <div class="col-lg-4 ">
                    <label for="input-val27" class="promo promo2 col-lg-12">
                        <button class="wheel-btn" id='input-val27'>Buscar Comprador</button>
                    </label>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('body').on('click', '#hide', function(event){
            event.preventDefault();
            $('#search-content').addClass("oculto");
        });

        $('body').on('submit', '#search-form', function(event){
            event.preventDefault();
            $(".contLoadingSearch").removeClass("oculto");
            $('#search-content').addClass("oculto");
            $.ajax({
                type:"GET",
                url:"{{ route('search') }}",
                dataType: 'html',
                data:$(this).serialize(),
                success:function(response){
                    $('#search-content').empty();
                    $(".contLoadingSearch").addClass("oculto");
                    $('#search-content').removeClass("oculto");
                    $('#search-content').html(response);
                }
            });
        });
    });
</script>

@endif

@if ($type == 'search')
    <div  class="container" >
        <br>
        <div class="tab-content">
            <div class="wheel-start wheel-start2 col-md-12 col-xs-12" style="background-color: #ededee; padding-bottom:10px">
                <div class="container">
                    <div class="col-lg-12 col-md-12">
                        <div class="panel-heading wheel-header  wheel-testi-header" style="padding-top: 10px;">
                        <div class="pull-left">
                            <h4> Resultados de la busqueda </h4>
                        </div>
                        <div class="pull-right">
                             <a style="margin-right: 40px;" id="hide" class="pull-rigth btn btn-danger" href="#">
                                <i class="glyphicon glyphicon-remove" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="card-content col-lg-12 contSearch" >
                    <div class="card legend_offer">
                        <div class="card-content card_offer" style="height:50px;">
                            <table style="width:100%;">
                                <thead>
                                    <tr>
                                        <td class="td_offer user_offer" style=" vertical-align: middle;padding:6px;width:10%">Usuario </td>
                                        <td class="td_offer user_offer" style="width:40%">Total Bitcoins</td>
                                        <td class="td_offer user_offer" style="width:20%">Precio Pesos</td>
                                        <td></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    @if( count($offers) > 0)
                    @foreach ($offers as $offer)
                    <div class="card">
                        <div class="card-content card_offer" style="height:50px;">
                            <table  style="width:100%">

                                <tr>
                                    <td class="td_offer user_offer" style="width:10%">@ {{$offer->user->name}} </td>
                                    <td class="td_offer" style="width:40%">{{$offer->btc}} <i class="fa fa-btc" aria-hidden="true"></i> $</td>
                                    <td class="td_offer price_offer" style="width:20%">{{$offer->pesos}} $</td>
                                    <td>
                                        @if ($offer->type == "seller")
                                            <a href="{{ route('sell_offer', $offer->id) }}">
                                                <buttom href="" class="wheel-cheader-but boton_offer">vender</buttom>
                                            </a>
                                        @elseif($offer->type == "buy")
                                            <a href="{{ route('buy_offer', $offer->id) }}">
                                                <buttom href="" class="wheel-cheader-but boton_offer">Comprar</buttom>
                                            </a>
                                        @endif

                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="card">
                        <div class="card-content card_offer" style="height:50px;">
                            <table style="width:100%">

                                <tr>
                                    <td class="td_offer user_offer" style="width:30%">&nbsp; </td>
                                    <td class="td_offer " style="width:30%">No se ha publicado ningun oferta</td>
                                    <td class="td_offer " style="width:30%">&nbsp; </td>

                                </tr>

                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

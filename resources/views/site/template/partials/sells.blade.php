<div class="card-content col-lg-12 show-list" >
    <div class="card legend_offer">
        <div class="card-content card_offer" style="height:50px;">
            <table style="width:100%">
                <tr>
                    <td class="td_offer user_offer" style="width:10%"><span>Usuario</span> </td>
                    <td class="td_offer user_offer" style="width:40%">Total Bitcoins</td>
                    <td class="td_offer price_offer" style="width:20%">Precio Pesos</td>
                    <td class="td_offer limit_offer" style="width:20%">&nbsp; </td>
                    <td class="td_offer user_offer" style="width:20%">Acción</td>
                    <td>

                    </td>
                </tr>
            </table>
        </div>
    </div>
    @if( count($offers) > 0)
    @foreach ($offers as $offer)
    <div class="card">
        <div class="card-content card_offer" style="height:50px;">
            <table style="width:100%">

                <tr>
                    <td class="td_offer user_offer" style="width:10%">@<span>{{$offer->user->name}}</span> </td>
                    <td class="td_offer" style="width:40%">{{$offer->btc}} <i class="fa fa-btc" aria-hidden="true"></i></td>
                    <td class="td_offer price_offer" style="width:20%">{{$offer->pesos}} $</td>
                    <td class="td_offer limit_offer" style="width:20%">&nbsp;</td>
                    <td>
                        @if(Auth::check())
                            @if(Auth::user()->id==$offer->user_id)
                                <a disabled="disabled" class="disabled">
                                    <buttom href="" class="wheel-cheader-but boton_offer_disabled">vender</buttom>
                                </a>
                            @else
                                <a href="{{ route('sell_offer', $offer->id) }}">
                                    <buttom href="" class="wheel-cheader-but boton_offer">vender</buttom>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('sell_offer', $offer->id) }}">
                                <buttom href="" class="wheel-cheader-but boton_offer">vender</buttom>
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
                    <td class="td_offer " style="width:30%">No se ha publicado ningun anuncio de compra</td>
                    <td class="td_offer " style="width:30%">&nbsp; </td>

                </tr>

            </table>
        </div>
    </div>
    @endif
</div>

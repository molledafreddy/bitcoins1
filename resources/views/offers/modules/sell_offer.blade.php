@extends('site.template.main')

@section('content')

<div class="loader" style="display: none; z-index: 990"></div>
<div class="col-lg-12  padd-lr0">
	<div class="container">
		<div class="row profile">
			<div class="col-md-3">
					@include('site.template.partials.panel')
			</div>
			<div class="col-md-9 profile-content" id="create-form">
				<div class="col-md-12" style="padding-bottom:20px">
					<div class="card">
						<div class="card-action" style="border-bottom: 1px solid rgba(160, 160, 160, 0.2);">
							<a href="#" target="new_blank" >Vender Bitcoins</a>
						</div>
						<div class="panel-body" role="tabpanel" >
							<ul class="nav nav-tabs">
								<li class="active"><a href="#seller" data-toggle="tab">Datos de la Oferta</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade active in" id="seller">
									<br>
									<div class="wheel-register-log labele" style="background-color:white; padding: 0px">
										<div class="card-content">
											<form  class="form-process-sell" role="form" method="POST" action="{{ route('offers.async', 'sell_offer_pay') }}">
												<input type="hidden" name="offer_id" value="{{$offer->id}}">
												{{ csrf_field() }}
												{{ method_field('POST') }}
												<input type="hidden" value="2" name="type">
												<div class="row">
													<div class="col-md-12 col-xs-12">
														<div class="form-group">
															<label class="control-label">Codigo unico de la transacción:</label>
															<input id="total-seller" value="{{$codigo}}" readonly type="text" placeholder="codigo" name="codigo"  class="form-control">
															<div id="codigoError" class="alert alert-danger mjsError" role="alert"></div>
														</div>
														@if ($errors->has('codigo'))
															<span class="help-block"><strong>{{ $errors->first('codigo') }}</strong></span>
														@endif
													</div>
													<div class="col-md-12 col-xs-12">
														<b>Usuario: </b>
														<span class="profile-usertitle-job">
															{{$offer->user->name}} {{$offer->user->lastname}}
														</span>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-xs-12">
														<b>Total de BTC : </b>
														<span class="profile-usertitle-job">
															{{$offer->btc}}
														</span>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 col-xs-12">
														<b>Total de pesos ofertados: </b>
														<span class="profile-usertitle-job">
															{{$offer->pesos}}
														</span>
													</div>
												</div>
												<div class="row">

													<div class="col-md-12 text-center"><h2>Plataformas para hacer el pago</h2></div>
													<div class="col-md-12 m-t-20">
														<div class="alert alert-info" role="alert">
															<h4>Para realizar la venta de los Bitcoins, usted debe transferir los fondos a una de las billeteras listadas a continuación pertenecientes a BitcoinBogota, luego de esto debe ingresar el número de validación o de referencia en el campo descrito más abajo para tal fin, una vez hecho esto haga click en procesar y uno de nuestros operadores verificará su transacción y hará la transferencia de dinero a su cuenta bancaria</h4>

														</div>
													</div>
													<div class="col-md-12 col-xs-12 m-t-20 m-b-50">
														@if (count($paymentDatas)>0)
														@foreach ($paymentDatas->where("type",1) as $paymentData)
														<div class="d-flex aling-item-center m-t-20" >
															<div class="col-md-4">
																<img  src="{{ asset('images/logos/'.$paymentData->logo) }}" alt="">
															</div>
															<div class="col-md-4">
																<span >{{$paymentData->name}}</span>
															</div>
															<div class="col-md-4">
																<label class="switch">
																	<input class="checkPayment" id="{{$paymentData->id}}" name="payment[]" value="{{$paymentData->id}}" type="checkbox">
																	<span class="slider round"></span>
																</label>


															</div>
														</div>
														<div id="{{"contInfo".$paymentData->id}}" class="contInfo oculto">
															@if ($paymentData->paymentDataDetail != null)
															@foreach ($paymentData->paymentDataDetail as $paymentDataDetail)
															<div class="m-t-15">
																<b>{{$paymentDataDetail->name}}: </b>   @if($paymentDataDetail->is_link == 1) <a href="{{$paymentDataDetail->value}}" target="_blank">{{$paymentDataDetail->value}}</a> @else {{$paymentDataDetail->value}} @endif
															</div>
															@endforeach

															@endif
														</div>
														@endforeach
														@endif
														@if ($errors->has('payment'))
															<div class="alert alert-danger" role="alert">{{ $errors->first('payment') }}</div>
														@endif
													</div>
													<div class="col-md-6 col-xs-12">
														<input type="text" placeholder="Numero de Transacción" name="transaction_number"   class="form-control">
														<div id="transaction_numberError" class="alert alert-danger mjsError" role="alert"></div>
														@if ($errors->has('transaction_number'))
															<div class="alert alert-danger" role="alert">{{ $errors->first('transaction_number') }}</div>
														@endif
													</div>
													<input type="hidden" name="type" value="seller">
													<div class="col-md-6 col-xs-12">
														<button id="procesarVenta" type="submit" class="wheel-btn">Procesar</button>
													</div>
													<div class="col-lg-12">
														<div class="message-sucess alert alert-success" style="display: none;"> Los datos han sido guardados exitosamente!</div>
														<div class="message-error alert alert-danger" style="display: none;"> Ha ocurrido un error en el guardado de los datos!</div>
													</div>
												</div>
											</form>
										</div>
									</div>
									<div class="col-md-12">
										<div class="card-action" style="border-bottom: 1px solid rgba(160, 160, 160, 0.2);">
											<a href="#" target="new_blank" >Condiciones de Venta</a>
										</div>
										<div class="cart-content" style="height:188px;overflow-y:scroll;">
											<p style="font-size: 15px; color:#6c7179; padding: 15px; ">
												{!! $condicionesVenta !!}
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<center>
	<strong>  &nbsp; </strong>
</center>
<br>
<br>
<script>
	$(document).ready(function(){

		$(".checkPayment").on("click",function(){
			id = $(this).attr("id");
			 $("#paymentError").hide();

			$(".checkPayment").each(function() {
  				if(id != $(this).attr("id")){
  					$(this).prop('checked',false);
  					$("#contInfo"+$(this).attr("id")).hide(600);
  				}
			});
			if($(this).prop('checked')){
				$("#contInfo"+id).show(600);
			}else{
				$("#contInfo"+id).hide(600);
			}
		});
	});
</script>
@endsection

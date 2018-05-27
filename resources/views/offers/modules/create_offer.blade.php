@if($type == 'create_panel')
<div class="col-md-12" style="padding-bottom:20px">
	<div class="card">
	   <div class="card-action" style="border-bottom: 1px solid rgba(160, 160, 160, 0.2);">
	        <a href="#" target="new_blank" >Publicar Oferta</a>
    	</div>
    	<div class="panel-body" role="tabpanel" >
			<ul class="nav nav-tabs">
			   <li class="active"><a href="#seller" data-toggle="tab">Vender Bitcoins</a></li>
			   <li class=""><a href="#buy" data-toggle="tab">Comprar Bitcoins</a></li>
			</ul>
        	<div class="tab-content">
            <div class="tab-pane fade active in" id="seller">
            	<br>
            	<div class="wheel-register-log labele" style="background-color:white; padding: 0px">
						<div class="card-content">
							<form  class="form-add" role="form" method="POST" >
	                		{{ csrf_field() }}
	                		{{ method_field('POST') }}
	                		<input type="hidden" value="2" name="type">
                        <div class="row">
							<div class="col-md-12 col-xs-12">
                        		<div class="form-group">
                        			<label class="control-label">Codigo unico de la transacción:</label>
								   	<input id="codigo_unico" value="{{$codigo}}" readonly type="text" placeholder="codigo" name="codigo"  class="form-control">
				    				<div id="codigoError" class="alert alert-danger mjsError" role="alert"></div>
	                        	</div>
		                        @if ($errors->has('codigo'))
		                            <span class="help-block"><strong>{{ $errors->first('codigo') }}</strong></span>
		                        @endif
	                     	</div>
                        	<div class="col-md-12 col-xs-12">
                        		<div class="form-group">
										<center><text class="verde text-center">Los separación de decimales se identifica con ' , ' mientras que los miles con ' . ' </text></center>
                        			<label class="control-label">Total de BTC a vender:</label>
	                        		<div class="input-group">
											   <input id="total-seller" type="text" placeholder="Total a vender" name="total"  class="form-control">
										    	<span class="input-group-addon">BTC</span>
											  </div>
						    				<div id="totalError" class="alert alert-danger mjsError" role="alert"></div>
	                        	</div>
		                        @if ($errors->has('total'))
		                            <span class="help-block"><strong>{{ $errors->first('total') }}</strong></span>
		                        @endif
		                     </div>
									<div class="col-md-12 col-xs-12">
                        		<div class="form-group">
                        			<label class="control-label">Tu oferta por esos Bitcoin:</label>
	                        		<div class="input-group">
						   					<input id="value_offer_seller" type="text" placeholder="tu oferta" name="value_offer"  class="form-control">
							    				<span class="input-group-addon">Pesos</span>
						  					</div>
						    				<div id="value_offerError" class="alert alert-danger mjsError" role="alert"></div>
	                        	</div>
		                        @if ($errors->has('total'))
		                            <span class="help-block"><strong>{{ $errors->first('total') }}</strong></span>
		                        @endif
		                    	</div>
		                     <div class="col-md-12 col-xs-12 ">
		                    		<div class="col-md-12  alert alert-success">
			                    		<div class="acreditado"><b>Debes depositar en nuestra plataforma: </b> <span id="totalBTC">0.00</span> BTC</div>
			                    		<div class="comision"><b>Comisión: </b> <span id="contComision">{{$comisionBticoins}}</span> %</div>
											<div class="comisionBTC"><b>Comisión en BTC: </b> <span id="contComisionBTC">0.00</span> BTC</div>
											<div class="acreditado m-t-30">
												tu oferta:
											</div>
											<span id="ofertaBTC">0.00</span> BTC por <span id="ofertaPesos">0.00</span> pesos
	                    			</div>
	                        </div>

		                    	<div class="col-md-12 text-center"><h2>Plataformas para hacer el pago</h2></div>
									<div class="col-md-12 m-t-20">
										<div class="alert alert-info" role="alert">
											<h4>Luego de realizar la operación, debes agregar el codigo de validación o de referencia en el campo mas abajo y hacer click en el boton de procesar, una vez hecho esto, uno de nuestros operadores verificará la transacción y hara publica tu oferta de venta en nuestra pagina en los proximos minutos.</h4>
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
						                    		 		<b>{{$paymentDataDetail->name}}: </b> @if($paymentDataDetail->is_link == 1) <a href="{{$paymentDataDetail->value}}" target="_blank">{{$paymentDataDetail->value}}</a> @else {{$paymentDataDetail->value}} @endif
							                    		</div>
					                    			@endforeach

					                    		@endif
					                    	</div>
											@endforeach
			                    	@endif
										<div id="paymentError" class="alert alert-danger mjsError" role="alert"></div>
		                    	</div>
									<div class="col-md-6 col-xs-12">
										<input id="transaction_number_seller" type="text" placeholder="Numero de Transacción" name="transaction_number"  class="form-control">
										<div id="transaction_numberError" class="alert alert-danger mjsError" role="alert"></div>
									   @if ($errors->has('transaction_number'))
									       <span class="help-block"><strong>{{ $errors->first('transaction_number') }}</strong></span>
									   @endif
									</div>
		                    	<input type="hidden" name="type" value="seller">
									<div class="col-md-6 col-xs-12">
										<button id="procesarVenta" disabled="true" type="submit" class="wheel-btn">Procesar</button>
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
				    		@foreach($loadContents as $loadContent)
				    			@if ($loadContent->contentType->name =='Condiciones de venta')
				    			   <p style="font-size: 15px; color:#6c7179; padding: 15px; ">
				    			    	{!!$loadContent->template!!}
			    			    	</p>
		                	@endif
			            @endforeach
			      	</div>
					</div>
            </div>
	            <div class="tab-pane fade" id="buy">
	            	<br>
                	<div class="wheel-register-log labele" style="background-color:white; padding: 0px">
	                	<div class="card-content">
		                	<form  class="form-add-buy" role="form" method="POST" >
		                		{{ csrf_field() }}
		                		{{ method_field('POST') }}
		                		<input type="hidden" value="1" name="typeBuy">
		                        <div class="row">
									<div class="col-md-12 col-xs-12">
		                        		<div class="form-group">
		                        			<label class="control-label">Codigo unico de la transacción:</label>
										   	<input id="codigo_unico" value="{{$codigo}}" readonly type="text" placeholder="codigo" name="codigo"  class="form-control">
						    				<div id="codigoError" class="alert alert-danger mjsError" role="alert"></div>
			                        	</div>
				                        @if ($errors->has('codigo'))
				                            <span class="help-block"><strong>{{ $errors->first('codigo') }}</strong></span>
				                        @endif
			                     	</div>
		                        	<div class="col-md-12 col-xs-12">
		                        		<div class="form-group">
		                        			<center><text class="verde text-center">Los separación de decimales se identifica con ' , ' mientras que los miles con ' . ' </text></center>
		                        			<label class="control-label">Total de BTC a comprar:</label>
			                        		<div class="input-group">
													   <input id="total-buy" type="text" placeholder="Total a Comprar" name="totalBuy"  class="form-control">
													    <span class="input-group-addon">BTC</span>
										  			</div>
									    			<div id="totalBuyError" class="alert alert-danger mjsError" role="alert"></div>
			                        	</div>
				                        @if ($errors->has('total'))
			                            	<span class="help-block"><strong>{{ $errors->first('total') }}</strong></span>
				                        @endif
			                    	</div>
			                    	<div class="col-md-12 col-xs-12">
		                        		<div class="form-group">
		                        			<label class="control-label">Tu oferta por esos Bitcoin:</label>
			                        		<div class="input-group">
													   <input id="value_offer_buy" type="text" placeholder="tu oferta" name="value_offer_buy"  class="form-control">
												    	<span class="input-group-addon">Pesos</span>
										  			</div>
									    			<div id="value_offer_buyError" class="alert alert-danger mjsError" role="alert"></div>
			                        	</div>
			                    	</div>
			                    	<div class="col-md-12 col-xs-12 ">
			                    		<div class="col-md-12 alert alert-success">
				                    		<div class="acreditado"><b>Por ser depositado: </b> <span id="totalPesos">0.00</span> Pesos</div>
				                    		<div class="comision"><b>Comisión: </b> <span id="contComisionPesos">{{$comisionPesos}}</span> %</div>
												<div class="comisionBTC"><b>Comisión en Pesos: </b> <span id="comisionPesos">0.00</span> Pesos</div>
												<div class="acreditado m-t-30">
													tu oferta:
												</div>
												<span id="ofertaBTCBuy">0.00</span> BTC por <span id="ofertaPesosBuy">0.00</span> pesos
			                    		</div>
			                        </div>

			                    	<div class="col-md-12 text-center"><h2>Plataformas para hacer el pago</h2></div>
			                    	<div class="col-md-12 m-t-20">
				                    	<div class="alert alert-info" role="alert">
				                    		<h4>Luego de realizar la operación, debes agregar el codigo de validación o de referencia en el campo mas abajo y hacer click en el boton de procesar, una vez hecho esto, uno de nuestros operadores verificará la transacción y hara publica tu oferta de compra en nuestra pagina en los proximos minutos.</h4>
				                    	</div>
			                    	</div>
			                    	<div class="col-md-12 col-xs-12 m-t-20 m-b-50">
				                    	@if (count($paymentDatas)>0)
												@foreach ($paymentDatas->where("type",2) as $paymentData)
						                    	<div class="d-flex aling-item-center m-t-20" >
						                    		<div class="col-md-4">
						                    			<img  src="{{ asset('images/logos/'.$paymentData->logo) }}" alt="">
						                    		</div>
						                    		<div class="col-md-4">
					                    				<span >{{$paymentData->name}}</span>
						                    		</div>
						                    		<div class="col-md-4">
						                    			<label class="switch">
													  		<input class="checkPayment" id="{{$paymentData->id}}" name="paymentBuy[]" value="{{$paymentData->id}}" type="checkbox">
														  	<span class="slider round"></span>
														</label>
						                    		</div>
						                    	</div>
						                    	<div id="{{"contInfo".$paymentData->id}}" class="contInfo oculto">
						                    		@if ($paymentData->paymentDataDetail != null)
						                    			@foreach ($paymentData->paymentDataDetail as $paymentDataDetail)
								                    		<div class="m-t-15">
							                    		 		<b>{{$paymentDataDetail->name}}: </b>  @if($paymentDataDetail->is_link == 1) <a href="{{$paymentDataDetail->value}}" target="_blank">{{$paymentDataDetail->value}}</a> @else {{$paymentDataDetail->value}} @endif
								                    		</div>
						                    			@endforeach
						                    		@endif
						                    	</div>
												@endforeach
				                    	@endif
											<div id="paymentBuyError" class="alert alert-danger mjsError" role="alert"></div>
			                    	</div>
			                    	<div class="col-md-6 col-xs-12">
			                        	<input id="transaction_number_buy" type="text" placeholder="Numero de Transacción" name="transaction_number_buy"   class="form-control">
			                        	<div id="transaction_number_buyError" class="alert alert-danger mjsError" role="alert"></div>
			                    	</div>
			                    	<input type="hidden" name="type" value="seller">
			                    	<div class="col-md-6 col-xs-12">
		                    			<button id="procesarCompra" disabled="true"  type="submit"  class="wheel-btn">Procesar</button>

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
				            <a href="#" target="new_blank" >Condiciones de Compra</a>
				        	</div>
				      	<div class="cart-content" style="height:188px;overflow-y:scroll;">
				    			@foreach($loadContents as $loadContent)
				    				@if ($loadContent->contentType->name =='Condiciones de compra')
					    			   <p style="font-size: 15px; color:#6c7179; padding: 15px; ">
					    			    	{!!$loadContent->template!!}
				    			    	</p>
				                @endif
				            @endforeach
				      	</div>
						</div>
	            </div>
        		</div>
    	</div>
	</div>
</div>
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

		$("input").on("focus",function(event){
            event.stopPropagation();
            $(this).siblings(".mjsError").hide();
            $(this).parent().siblings(".mjsError").hide();
        });
	});
window.oncontextmenu = function() {
return true;
} </script>
@endif

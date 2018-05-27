@if(empty($type) || $type == 'main')
	<div class="col-md-12 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<h1 class="page-header">
					 Listado de transacciones a verfificar
			        <div class="clearfix"></div>
				</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<form action="#" id="search" >
                {{ csrf_field() }}
					<div class="col-lg-4 col-md-4 col-xs-6">
	            		<div class="form-group">
	            		 	{{-- <label class="control-label">Tipo de oferta:</label>       		 --}}
			            	<select id="type" name="type" class="form-control">
								<option value="">Tipo de oferta</option>
									<option value="seller">Venta</option>
									<option value="buy">Compra</option>
							</select>
						</div>
	    			</div>
	    			<div class="col-lg-4 col-md-4 col-xs-6">
	            		<div class="form-group">
	            		 	{{-- <label class="control-label">Tipo de moneda:</label>       		 --}}
			            	<select id="money" name="money" class="form-control">
								<option value="">Tipo de moneda</option>
								<option value="pesos">Pesos</option>
								<option value="btc">BTC</option>
							</select>
						</div>
	    			</div>
	    			<div class="col-lg-4 col-md-4 col-xs-6">
	            		<div class="form-group">
	            		 	{{-- <label class="control-label">Estatus:</label>       		 --}}
			            	<select id="status" name="status" class="form-control">
								<option value="">Estatus</option>
								<option value="0">Pendiente</option>
								<option value="1">Aprobada</option>
								<option value="2">Rechazada</option>
							</select>
						</div>
	    			</div>
	    			<div class="col-lg-4 col-md-5 col-xs-6">
						<div class="form-group">
							{{-- <label class="control-label">Nombre:</label> --}}
							<input id="name" name="name" placeholder="Nombre de usuario"  class="form-control" >
						</div>
					</div>
					<div class="col-lg-4 col-md-5 col-xs-8">
						<div class="form-group">
							{{-- <label class="control-label">Nro de transaccion:</label> --}}
							<input id="unique_code" name="unique_code" placeholder="codigo de transaccion"  class="form-control" >
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-xs-2">
						<div class="form-group">
							<button type="submit" id="ad" class="btn btn-primary" title="add">
					        	Buscar <i class="fa fa-search"></i>
					        </button>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-xs-2">
						<div class="form-group">
							<button  id="clean" type="button" class="btn btn-warning" title="add">
					        	Limpiar <i class="fa fa-refresh"></i>
					        </button>
						</div>
					</div>
				</form>
			</div>
		</div>
        <div class="panel panel-default">
            <div class="panel-body">
            	@if (count($transactions)>0)
			        <table  class="table table-striped">
			            <thead>
			                <tr>
								<th class="text-center">ID</th>
								<th class="text-center">código unico de transacción</th>
								<th class="text-center">usuario</th>
								<th class="text-center">Total transferido</th>
								<th class="text-center">Tipo</th>
								<th class="text-center">Estatus</th>
			                    <th class="text-center">Detalle</th>
			                </tr>
			            </thead>
			            <tbody>
			                @foreach($transactions as $transaction)
			                <tr>
								<td class="text-center">{{$transaction->id}}</td>
								<td class="text-center">{{$transaction->unique_code}}</td>
								<td class="text-center">{{$transaction->user->name}}</td>
								<td class="text-center"> @if($transaction->pay_btc_total) {{$transaction->pay_btc_total}} <i class="fa fa-btc"></i> @elseif($transaction->pay_pesos_total)  {{$transaction->pay_pesos_total}} $ @endif</td>
								<td class="text-center"> {{ trans('dictionary.'.$transaction->offer->type)}}</td>

								<td class="text-center">
									@if ($transaction->status == 0)
										<span class="label label-warning">Pendiente</span>
									@elseif($transaction->status == 1)
									 <span class="label label-success">Aprobado</span>
									@elseif($transaction->status == 2)
									 <span class="label label-danger">Rechazada</span>
								 	@endif
								</td>
			                    <td>
			                        <center>
			                            <a href="{{ route('transaction-verification.async', ['detail', 'id'=> $transaction->id]) }}" class="btn btn-primary btn-sm accion">
			                                <i class="fa fa-search"></i>
			                            </a>
			                        </center>
			                    </td>
			                </tr>
			                @endforeach
			            </tbody>
			        </table>
			        <div  class="col-lg-12 flex justify-content-end text-center">
						{{ $transactions->appends(request()->query())->links() }}
					</div>
        		@else
			        <div class="error-body text-center">
			            <h1><i class="fa fa-exclamation error-icon"></i></h1>
			            <h3 class="text-uppercase">No se encontraron resultados</h3>
			        </div>
       			 @endif
            </div>

        </div>
    </div>
@endif

@if($type == 'detail')
	<div class="col-md-12 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<h1 class="page-header">
					Detalle de la transacción <b>{{$transaction->unique_code}}</b>
			        <button type="button" class="btn btn-primary pull-right back" data-toggle="tooltip" data-placement="top" title="Volver">
			        	<i class="fa fa-arrow-left" aria-hidden="true"></i> volver
			        </button>
			        <div class="clearfix"></div>
				</h1>
			</div>
		</div>
        <div class="panel panel-default">
            <div class="panel-body m-l-30">


				<div class="col-md-6">

					<h3>Detalle de la oferta</h3>
					<div class="contDetalleOferta">
						<div class="m-t-10"><b>Usuario:</b> {{$transaction->user->name}} </div>
						<div class="m-t-10"><b>Tipo de oferta:</b> <span class="label label-success">{{ trans('dictionary.'.$transaction->offer->type)}} de Bitcoins </span></div>
						<div class="m-t-10"><b>Fecha solicitud:</b> {{$transaction->created_at->format('d-m-Y')}} </div>
						<div class="m-t-10"><b>Hora solicitud:</b> {{$transaction->created_at->format('h:i:s')}} </div>

						@if ($transaction->offer->type=="seller")
							<div class="m-t-10"><b>Total pagado:</b> {{ $transaction->pay_btc_total}} <i class="fa fa-btc" aria-hidden="true"></i> </div>
							<div class="m-t-10"><b>Total comisión:</b> {{($transaction->pay_btc_total * $transaction->commission)/100}} <i class="fa fa-btc" aria-hidden="true"></i> </div>
						@elseif($transaction->offer->type=="buy")
							<div class="m-t-10"><b>Total pagado:</b> {{$transaction->pay_pesos_total}} <i class="fa fa-dollar" aria-hidden="true"></i> </div>
							<div class="m-t-10"><b>Total comisión:</b> {{($transaction->pay_pesos_total * $transaction->commission)/100}} <i class="fa fa-dollar" aria-hidden="true"></i> </div>
						@endif
						<div class="m-t-10"><b>Total oferta:</b> {{$transaction->offer->btc}} <i class="fa fa-btc" aria-hidden="true"></i> </div>
						<div class="m-t-10"><b>Total pesos a cobrar:</b> {{$transaction->offer->pesos}} <i class="fa fa-dollar" aria-hidden="true"></i> </div>
						<div class="m-t-10"><b>Estatus solicitud:</b>
							@if ($transaction->status == 0)
								<span class="label label-warning">Pendiente</span>
					 		@elseif($transaction->status == 1)
							 <span class="label label-success">Aprobado</span>
			  				@elseif($transaction->status == 2)
							 <span class="label label-danger">Rechazada</span>
							@endif
						</div>
					</div>
				</div>

				<div class="col-md-6 fondoDetallePago">
					<h3>Detalle del pago</h3>
					<div class="contDetalleOferta">
						@if ($transaction->offer->type=="seller")
							<div class="m-t-10"><b>Total transferido:</b> {{ $transaction->pay_btc_total}} <i class="fa fa-btc" aria-hidden="true"></i> </div>

						@elseif($transaction->offer->type=="buy")
							<div class="m-t-10"><b>Total transferido:</b> {{ $transaction->pay_pesos_total}} <i class="fa fa-dollar" aria-hidden="true"></i> </div>
						@endif
						<div class="m-t-10"><b>Forma de pago:</b> {{ $transaction->payment_data->name}} </div>
						<div class="m-t-10"><b>Referencia de transacción:</b> {{$transaction->transaction_number}} </div>
						@foreach ($transaction->payment_data->paymentDataDetail as $paymentDataDetail)
        					<div class="m-t-10"><b>{{$paymentDataDetail->name}}:</b>  {{$paymentDataDetail->value}}</div>
				  		@endforeach
			  			@if ($transaction->offer->verificada ==0)
		            		<div class="m-t-30 m-b-30 contInfo">
		            			<b>Verificar Transacción:</b>
		            			@if ($transaction->offer->type=="seller")
			            			<div class="alert alert-info m-t-20" role="alert">Se debe verificar que los Bticoins esten disponibles en el wallet de destino para poder aprobar la transacción y que esta sea publicada</div>

		            			@elseif($transaction->offer->type=="buy")
		            				<div class="alert alert-info m-t-20" role="alert">Se debe verificar que los Pesos esten disponibles en el banco de destino para poder aprobar la transacción y que esta sea publicada</div>
		            			@endif
		            		</div>
	            		@endif
					</div>

					@if ($transaction->offer->verificada == 0 || $transaction->status == 0)
		            	<div class="text-center m-t-30 m-b-30">
		            		<a id="verificar" href="{{ route('transaction-verification.async', ['verify', 'id'=> $transaction->id]) }}" class="btn btn-primary"><i class="fa fa-check"></i> Aprobar transacción</a>
		            		<a id="rechazar" href="{{ route('transaction-verification.async', ['reject', 'id'=> $transaction->id]) }}" class="btn btn-danger"><i class="fa fa-close"></i> Rechazar transacción</a>
		        		</div>
					@endif

            </div>

        </div>
    </div>

    <script type="text/javascript">
	    $(document).ready(function(){
	        $("input").on("focus",function(event){
                event.stopPropagation();
                $(this).siblings(".mjsError").hide();
            });

            $("select").on("focus",function(event){
				event.stopPropagation();
				$(this).siblings(".mjsError").hide();
			});

	    });
	</script>
@endif

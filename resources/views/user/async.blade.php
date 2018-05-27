@if ($type=='dashboard')
<div class="col-md-3">
		<a href="{{route('buy_offers')}}">
	<div class="card">
		<center>
			<div class="card-image">
					<img class="img-responsive" src="{{asset('images/buy.png')}}">
			</div>
		</center>

		<div class="card-action">
		<text>Comprar Bitcoins</text>
		</div>
	</div>
</a>

</div>
<div class="col-md-3">
		<a href="{{route('sell_offers')}}">
	<div class="card">
		<center>
			<div class="card-image">
					<img class="img-responsive" src="{{asset('images/sell.png')}}">
			</div>
		</center>

		<div class="card-action">
			<text>Vender Bitcoins</text>
		</div>
	</div>
</a>
</div>
<div class="col-md-3">
	<div class="card transactions" style="cursor:pointer">
		<center>
			<div class="card-image ">
				<img class="img-responsive" src="{{asset('images/wallet.png')}}">
			</div>
		</center>

		<div class="card-action">
			<text>Transacciones</text>
		</div>
	</div>
</div>
<div class="col-md-3">
		<a href="{{ route('offer.dashboard') }}">
	<div class="card">
		<center>
			<div class="card-image">
				<a href="{{ route('offer.dashboard') }}">
					<img class="img-responsive" src="{{asset('images/publish.png')}}">
				</a>
			</div>
		</center>

		<div class="card-action">
			<a href="{{ route('offer.dashboard') }}" >Publicar Anuncio</a>
		</div>
	</div>
</a>
</div>


<div class="col-md-12" style="padding-bottom:20px">
	<div class="card">
		<div class="card-action" style="border-bottom: 1px solid rgba(160, 160, 160, 0.2);">
			<a href="#" target="new_blank" >Ultimas Transacciones</a>
		</div>

		<div class="card-content col-lg-12 show-list" >
			<div class="clearfix"></div>

		    <div class="card legend_offer">
		        <div class="card-content card_offer" style="height:50px;">
		            <table style="width:100%">
		                <tr>
		                    <td class="td_offer offerName" style="width:10%"><span>Usuario</span> </td>
		                    <td class="td_offer offerName" style="width:20%">Total Bitcoins</td>
		                    <td class="td_offer offerName" style="width:20%">Total Pesos</td>
		                    <td class="td_offer offerName" style="width:10%">Tipo </td>
		                    <td class="td_offer offerName" style="width:20%">Estatus</td>
		                    <td class="td_offer offerName" style="width:10%">Fecha</td>
		                    <td class="td_offer offerName" style="width:20%">Detalle</td>
		                </tr>
		            </table>
		        </div>
		    </div>
		    @if( count($transactions) > 0)
		    @foreach ($transactions as $transaction)

		    <div class="card">
		        <div class="card-content card_offer" style="height:50px;">
		            <table style="width:100%">

		                <tr>
		                    <td class="td_offer offerName" style="width:10%">@<span>{{$transaction->user->name}}</span> </td>
		                    <td class="td_offer offerPrice" style="width:20%">{{$transaction->offer->btc}} <i class="fa fa-btc" aria-hidden="true"></i></td>
		                    <td class="td_offer offerPrice" style="width:20%">{{$transaction->offer->pesos}} $</td>
		                    <td class="td_offer offerName" style="width:10%">
							  	@if ($transaction->offer->type == "buy")
						  	 		<span class="text-danger text-tipo">{{ trans('dictionary.'.$transaction->offer->type)}}</td>
								@elseif($transaction->offer->type == "seller")
									<span class="text-success text-tipo">{{ trans('dictionary.'.$transaction->offer->type)}}</td>
							  	@endif

		                    <td class="status-transacciones limit_offer" >
								@if ($transaction->offer->verificada == 0 && $transaction->status == 0)
									<span class="label label-warning">Sin verificar</span>
								@else
									@if ($transaction->status == 0)
									  	<span class="label label-warning">Pendiente</span>
								  	@elseif($transaction->status ==1)
										<span class="label label-success">Aprobado</span>
								  	@elseif($transaction->status ==2)
										<span class="label label-danger">Rechazada</span>
								  	@endif
								@endif
		                    </td>
							<td class="offerDate" style="width:10%">{{$transaction->created_at->diffForHumans()}}</td>
							<td style="width:20%">
			                    <center>
		                            <a href="{{ route('user.transaction.detail', ['detail', 'id'=> $transaction->id]) }}" class="btn btn-primary btn-sm accion">
		                                <i class="fa fa-search"></i>
		                            </a>
		                        </center>
							</td>							
		                </tr>

		            </table>
		        </div>
		    </div>
		    @endforeach
				@if ($transactionsCount > 3)
					<div class="d-flex justify-content m-t-30">
						<button class="wheel-btn verMas">Ver mas</button>
					</div>
				@endif
		    @else
		    <div class="card">
		        <div class="card-content card_offer" style="height:70px;">
		            <table style="width:100%">

		                <tr>
		                    <td class="td_offer user_offer" style="width:30%">&nbsp; </td>
		                    <td class="td_offer " style="width:30%">No se ha publicado ninguna transacción</td>
		                    <td class="td_offer " style="width:30%">&nbsp; </td>

		                </tr>

		            </table>
		        </div>
		    </div>
		    @endif
		</div>

	</div>
</div>
@endif

@if ($type=='settings')
<div class="col-md-4" >
		<a class="uedit" href="#" target="new_blank">
	<div class="card"style="height:330px">
		<center>
			<div class="card-image"style="height:200px;padding-top:50px">
				<img class="img-responsive" src="{{asset('images/user-edit.png')}}">
			</div>
		</center>

		<div class="card-action" style="text-align: center;">
     <text> Editar Datos Personales</text>
		</div>
		<div class="card-action" style="text-align: center;">
			Editar datos personales como nombre, apellido, usuario y correo.
		</div>
	</div>
</a>
</div>
<div class="col-md-4" >
		<a class="pedit" href="#" target="new_blank">
	<div class="card"style="height:330px">
		<center>
			<div class="card-image"style="height:200px;padding-top:50px">
				<img class="img-responsive" src="{{asset('images/password-edit.png')}}">
			</div>
		</center>

		<div class="card-action" style="text-align: center;">
		<text>	Cambiar Contraseña</text>
		</div>
		<div class="card-action" style="text-align: center;">
			Editar la contraseña de ingreso al sistema.
		</div>
	</div>
</a>
</div>
<div class="col-md-4" >
<a class="account_index" href="#" target="new_blank">
	<div class="card"style="height:330px">
		<center>
			<div class="card-image"style="height:200px;padding-top:50px">
				<img class="img-responsive" src="{{asset('images/rich.png')}}">
			</div>
		</center>

		<div class="card-action" style="text-align: center;">
		<text>	Datos Bancarios </text>
		</div>
		<div class="card-action" style="text-align: center;">
			Cargar datos de cuentas bancarias.
		</div>
	</div>
</a>
</div>
@endif

@if ($type=='password_edit')
<div class="col-md-12">
	<div class="card">
		<div class="card-action" style="border-bottom: 1px solid rgba(160, 160, 160, 0.2);">
			<a href="#" target="new_blank">Edición de Contraseña</a>
		</div>
		<div class="card-content">
			<div class="wheel-register-log labele" style="background-color:white; padding: 0px">
				<form class="form-horizontal" role="form" method="POST" action="{{ route('user.password') }}">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-12 col-xs-12">
							<label for="userPass" class="fa fa-lock"><input type="password" placeholder='Nueva Contraseña' name="password" maxlength="191" required></label>
						</div>
					</div>
					<button class="wheel-btn">Guardar</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endif

@if ($type=='edit_user')
<div class="col-md-12">
	<div class="card">
		<div class="card-action" style="border-bottom: 1px solid rgba(160, 160, 160, 0.2);">
			<a href="#" target="new_blank">Edición de Datos de Usuario</a>
		</div>
		<div class="card-content">
			<div class="wheel-register-log labele" style="background-color:white; padding: 0px">
				<form class="form-horizontal" role="form" method="POST" action="{{ route('user.account') }}">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-12 " id="valor_imagen" >
							<label>Imagen</label>
							<div class="input-group">
								<span class="input-group-btn">
									<a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
										<i class="fa fa-picture-o"></i> Seleccione una Imagen
									</a>
								</span>
								<input id="thumbnail" class="form-control" type="text"  @if(!empty($logo_user->value))  value="{{$logo_user->value}}" @endif name="value"  required>
							</div>
							<img id="holder" style="margin-top:15px;max-height:100px;padding-bottom: 15px;"  @if(!empty($logo_user->value)) src="{{ asset($logo_user->value) }}" @endif>
						</div>

						<div class="col-md-6 col-xs-12">
							<input type="text" placeholder="Nombre" name="name" value="{{Auth::user()->name}}" maxlength="191" style="width: 100%" required>
							@if ($errors->has('name'))
							<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
							@endif
						</div>

						<div class="col-md-6 col-xs-12">
							<input class="" type="text" placeholder="Apellido" name="lastname" value="{{Auth::user()->lastname}}" maxlength="191" style="width: 100%" required>
							@if ($errors->has('lastname'))
							<span class="help-block"><strong>{{ $errors->first('lastname') }}</strong></span>
							@endif
						</div>

						<div class="col-md-6 col-xs-12">
							<input type="email" placeholder="Correo Electrónico" name="email" value="{{Auth::user()->email}}" maxlength="191" style="width: 100%" required>
							@if ($errors->has('email'))
							<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
							@endif
						</div>

						<div class="col-md-6 col-xs-12">
							<input type="text" placeholder="Usuario" name="username" value="{{Auth::user()->username}}" maxlength="191" style="width: 100%" required>
							@if ($errors->has('username'))
							<span class="help-block"><strong>{{ $errors->first('username') }}</strong></span>
							@endif
						</div>
					</div>
					<button class="wheel-btn">Guardar</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	if ($('#editor1').length > 0) {
		CKEDITOR.replace('editor1', {
			filebrowserImageBrowseUrl: '../laravel-filemanager?type=Images',
			filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
			filebrowserBroeseUrl: '../laravel-filemanager?type=Files',
			fullPage: true,
			allowedContent: true,
			allow_multi_user: true
		});
	}

	var domain = "../laravel-filemanager";
	$('#lfm').filemanager('image', {prefix: domain});
</script>
@endif

@if ($type=='transactions')
<div class="col-md-12">
	<div class="card">
		<div class="card-action" style="border-bottom: 1px solid rgba(160, 160, 160, 0.2);">
			<a href="#" target="new_blank" >Transacciones</a>
		</div>
		<div class="card-content col-lg-12 show-list" >
			<div class="col-lg-12 d-flex justify-content-end">
				{{ $transactions->links() }}
			</div>
			<div class="clearfix"></div>

		    <div class="card legend_offer">
		        <div class="card-content card_offer" style="height:50px;">
		            <table style="width:100%">
		                <tr>
		                    <td class="td_offer offerName" style="width:10%"><span>Usuario</span> </td>
		                    <td class="td_offer offerName" style="width:20%">Total Bitcoins</td>
		                    <td class="td_offer offerName" style="width:20%">Total Pesos</td>
		                    <td class="td_offer offerName" style="width:20%">Tipo </td>
		                    <td class="td_offer offerName" style="width:20%">Estatus</td>
		                    <td class="td_offer offerName" style="width:10%">Fecha</td>
		                    <td class="td_offer offerName" style="width:20%">Detalle</td>
		                </tr>
		            </table>
		        </div>
		    </div>
		    @if( count($transactions) > 0)
			    @foreach ($transactions as $transaction)

			    <div class="card">
			        <div class="card-content card_offer" style="height:50px;">
			            <table style="width:100%">

			                <tr>
			                    <td class="td_offer offerName" style="width:10%">@<span>{{$transaction->user->name}}</span> </td>
			                    <td class="td_offer offerPrice" style="width:20%">{{$transaction->offer->btc}} <i class="fa fa-btc" aria-hidden="true"></i></td>
			                    <td class="td_offer offerPrice" style="width:20%">{{$transaction->offer->pesos}} $</td>
			                    <td class="td_offer offerName" style="width:20%">
									@if ($transaction->offer->type == "buy")
									<span class="text-danger text-tipo">{{ trans('dictionary.'.$transaction->offer->type)}}</td>
							 @elseif($transaction->offer->type == "seller")
								 <span class="text-success text-tipo">{{ trans('dictionary.'.$transaction->offer->type)}}</td>
							   @endif
							 <td class="status-transacciones limit_offer" >
  	  								@if ($transaction->offer->verificada == 0 && $transaction->status == 0)
  	  									<span class="label label-warning">Sin verificar</span>
  	  								@else
  	  									@if ($transaction->status == 0)
  	  									  	<span class="label label-warning">Pendiente</span>
  	  								  	@elseif($transaction->status ==1)
  	  										<span class="label label-success">Aprobado</span>
  	  								  	@elseif($transaction->status ==2)
  	  										<span class="label label-danger">Rechazada</span>
  	  								  	@endif
  	  								@endif

  	  		                    </td>
  	  		                    <td class="offerDate" style="width:10%">{{$transaction->created_at->diffForHumans()}}</td>
  	  		                    <td style="width:20%">
				                    <center>
			                            <a href="{{ route('user.transaction.detail', ['detail', 'id'=> $transaction->id]) }}" class="btn btn-primary btn-sm accion">
			                                <i class="fa fa-search"></i>
			                            </a>
			                        </center>
								</td>
			                </tr>

			            </table>
			        </div>
			    </div>
			    @endforeach
		    @else
		    <div class="card">
		        <div class="card-content card_offer" style="height:70px;">
		            <table style="width:100%">

		                <tr>
		                    <td class="td_offer user_offer" style="width:30%">&nbsp; </td>
		                    <td class="td_offer " style="width:30%">No se ha publicado ninguna transacción</td>
		                    <td class="td_offer " style="width:30%">&nbsp; </td>

		                </tr>

		            </table>
		        </div>
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
					Detalle de la transacción {{$transaction->transaction_number}}
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
			  		</div>
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



@if ($type=='account_index')
<div class="col-md-12">
	<div class="card">
		<div class="card-action" style="border-bottom: 1px solid rgba(160, 160, 160, 0.2);">
			<a href="#">Cuentas Bancarias</a> <a href="#" class="add_account"><buttom href="" class="wheel-cheader-but" style="margin-top: -10px;">Agregar</buttom></a>
		</div>
		@if (count($accounts)>0)
			<div class="card-content col-lg-12" style="overflow-y:auto;background:white;">
				<div class="card legend_offer">
					<div class="card-content card_offer" style="height:50px;">
						<table style="width:100%">
							<tr>
								<td class="td_offer col-md-4 text-center"><span>Nombre</span> </td>
								<td class="td_offer col-md-4 text-center"><span>Variables</span> </td>
								<td class="td_offer col-md-4 text-center">Opciones</td>
							</tr>
						</table>
					</div>
				</div>
				@foreach ($accounts as $account)
				<div class="card">
					<div class="card-content card_offer" style="height:50px;">
						<table style="width:100%" class="responsive">

							<tr>
								<td class="td_offer col-md-4 text-center"><span>{{$account->name}}</span> </td>
								<td class="td_offer col-md-4 text-center"><span>{{$account->UserAccounts->count('count_value')}}</span> </td>
								<td class="col-md-4 text-center">
									<a href="{{ route('user.async', ['edit_bank_account', 'id'=> $account->id]) }}" class="edit_bank_account">
										<buttom class="wheel-cheader-but boton_offer">Editar</buttom>
									</a>
								</td>
								{{-- <td class="col-md-2">
									<a href="{{ route('user.async', ['delete_bank_account', 'id'=> $account->id]) }}" class="delete_bank_account">
										<buttom class="wheel-cheader-but boton_offer_delete">Eliminar</buttom>
									</a>
								</td> --}}
							</tr>

						</table>
					</div>
				</div>
				@endforeach
			</div>
		@else
			<div class="col-md-12 text-center m-t-20">
				<h2>no se han registrados datos bancarios</h2>
			</div>
		@endif

	</div>
</div>
@endif

@if ($type=='add_account')
<div class="col-md-12">
	<div class="card">
		<div class="card-action" style="border-bottom: 1px solid rgba(160, 160, 160, 0.2);">
			<a href="#" target="new_blank">Agregar Cuenta Bancaria</a>
		</div>
	</div>
	<div id="contDetail" class="col-lg-12 col-md-12 col-xs-12 m-t-30 wheel-register-log labele m-t-20">
		<form class="m-t-30 form-add-account" id="form-add-account" method="POST" action="{{ route('user.async', 'store_account') }}" >
			{{ csrf_field() }}
			<div class="col-md-10 col-xs-12">
				<div class="form-group">
					<label class="control-label">Tipo de cuenta: </label>
					<select id="type" name="type" class="form-control">
						<option value="" >Selecciones el tipo de pago</option>
						@foreach ($accountTypes as $accountType)
							<option value="{{$accountType->id}}">{{$accountType->name}}</option>
						@endforeach
					</select>
					<div id="typeError" class="alert alert-danger mjsError" role="alert"></div>
				</div>
			</div>
			<div class="contenedor" id="contenedor0" >
				<div class="col-lg-5 col-md-5 col-xs-12">
					<div class="form-group">
						<label class="control-label">Nombre de variable</label>
						<input required class="form-control"  placeholder="nombre" type="text" name="names[]">
					</div>
				</div>
				<div class="col-lg-5 col-md-5 col-xs-12">
					<div class="form-group">
						<label class="control-label">valor</label>
						<input required class="form-control" placeholder="valor" type="text" name="values[]">
					</div>
				</div>
				<div class="col-lg-2">
					<button type="button" id="agregar" class="btn btn-primary agregarUserAcount"><i class="fa fa-plus"></i></button>
				</div>
			</div>
			<div id="contNew"></div>
			<div class="clearfix"></div>
			<div class="d-flex justify-content m-t-30 m-b-30 col-md-12" >
				<button type="submit" id="createData"  class="btn btn-primary userAccountButton"> <i class="fa fa-check"></i> Guardar</button>
			</div>
		</form>
	</div >
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$("input").on("focus",function(event){
			event.stopPropagation();
			$(this).siblings(".mjsError").hide();
		});
		$("#agregar").on('click',function(){

			i = 0;
			$(".contenedor").each(function(){
				i++;
			});

			var content = $('<div/>', {
				'class' : 'contenedor',
				'id' : 'contenedor'+i
			});
			var contName = $('<div/>', {
				'class' : 'col-lg-5 col-md-5 col-xs-12',
			});
			var contValue = $('<div/>', {
				'class' : 'col-lg-5 col-md-5 col-xs-12',
			});
			var contFormName = $('<div/>', {
				'class' : 'form-group',
			});
			var contFormValue = $('<div/>', {
				'class' : 'form-group',
			});

			var labelName = $('<label/>', {
				'class' : 'control-label',
			});
			var labelValue = $('<label/>', {
				'class' : 'control-label',
			});
			var contButton = $('<div/>', {
				'class' : 'col-lg-2',
			});
			var inputName = $('<input/>', {
				'type' : 'text',
				'name' : 'names[]',
				'class' : 'form-control',
				'placeholder' : 'nombre',
				'required' : 'required',
			});
			var inputValue = $('<input/>', {
				'type' : 'text',
				'name' : 'values[]',
				'class' : 'form-control',
				'placeholder' : 'valor',
				'required' : 'required',
			});
			var buttonDelete = $('<button/>', {
				'class' : 'btn btn-danger borrarUserAcount' ,
				'id' : 'borrar'+i ,
				'type' : 'button'
			});
			var logo = $('<i/>', {
				'class' : 'fa fa-minus',
				'aria-hidden' : 'true'
			});

			$("#contNew").append(content);
			content.append(contName).append(contValue).append(contButton);
			contName.append(contFormName);
			contFormName.append(labelName).append(inputName);
			labelName.append("Nombre de variable");
			contValue.append(contFormValue);
			contFormValue.append(labelValue).append(inputValue);
			labelValue.append("Valor");
			contButton.append(buttonDelete);
			buttonDelete.append(logo);


		});

		$("#contDetail").on('click','.borrarUserAcount',function(){
			id =$(this).parent().parent(".contenedor").attr("id");
			$("#"+id).remove();
		});

	});

</script>
@endif

@if ($type=='edit_bank_account')
<div class="col-md-12">
	<div class="card">
		<div class="card-action" style="border-bottom: 1px solid rgba(160, 160, 160, 0.2);">
			<a href="#" target="new_blank">editar Cuenta Bancaria</a>
		</div>
	</div>
		{{-- <div class="card-content">
			<div class="wheel-register-log labele" style="background-color:white; padding: 0px">
				<form class="form-horizontal form-add-account" role="form" method="POST" action="{{ route('user.async', ['update_bank_account', 'id'=> $account->id]) }}">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-12 col-xs-12">
							<label for="userPass" class="fa fa-money"><input type="account" placeholder='Nro de Cuenta Bancaria' name="account" maxlength="191" required value="{{$account->account_number}}"></label>
						</div>
					</div>
					<button class="wheel-btn" id="submit_account">Guardar</button>
				</form>
			</div>
		</div> --}}
	<div id="contDetail" class="col-lg-12 col-md-12 col-xs-12 m-t-30 wheel-register-log labele m-t-20">
		<form class="m-t-30 form-edit-account" id="form-edit-account" method="POST" action="{{ route('user.async', ['update_bank_account', 'id'=> $paymentData->id]) }}" >
			{{ csrf_field() }}
			<div class="col-md-10 col-xs-12">
				<div class="form-group">
					<label class="control-label">Tipo de cuenta: </label>
					<select readonly id="type" name="type" class="form-control">
						<option  value="{{$paymentData->id}}" >{{$paymentData->name}}</option>
					</select>
					<div id="typeError" class="alert alert-danger mjsError" role="alert"></div>
				</div>
			</div>
			@if (count($userAccounts)>0)
				@foreach ($userAccounts as $userAccount)
					<div class="contenedor" id="{{"contenedor".$loop->index}}" >
						<div class="col-lg-5 col-md-5 col-xs-12">
							<div class="form-group">
								<label class="control-label">Nombre de variable</label>
								<input class="form-control" value="{{$userAccount->name}}" placeholder="nombre" type="text" name="names[]">
							</div>
						</div>
						<div class="col-lg-5 col-md-5 col-xs-12">
							<div class="form-group">
								<label class="control-label">valor</label>
								<input class="form-control" placeholder="valor" value="{{$userAccount->value}}" type="text" name="values[]">
							</div>
						</div>
						@if ($loop->first)
							<div class="col-lg-2">
								<button type="button" id="agregar" class="btn btn-primary agregarUserAcount"><i class="fa fa-plus"></i></button>
							</div>
						@else
							<div class="col-lg-2">
								<button type="button" id="{{"borrar".$loop->index}}" class="btn btn-danger borrarUserAcount"><i class="fa fa-minus"></i></button>
							</div>
						@endif
					</div>
				@endforeach
			@else
				<div class="contenedor" id="contenedor0" >
					<div class="col-lg-5 col-md-5 col-xs-12">
						<div class="form-group">
							<label class="control-label">Nombre de variable</label>
							<input required class="form-control"  placeholder="nombre" type="text" name="names[]">
						</div>
					</div>
					<div class="col-lg-5 col-md-5 col-xs-12">
						<div class="form-group">
							<label class="control-label">valor</label>
							<input required class="form-control" placeholder="valor" type="text" name="values[]">
						</div>
					</div>
					<div class="col-lg-2">
						<button type="button" id="agregar" class="btn btn-primary agregarUserAcount"><i class="fa fa-plus"></i></button>
					</div>
				</div>
			@endif
			<div id="contNew"></div>
			<div class="clearfix"></div>
			<div class="d-flex justify-content m-t-30 m-b-30 col-md-12" >
				<button type="submit" id="createData"  class="btn btn-primary userAccountButton"> <i class="fa fa-check"></i> Guardar</button>
			</div>
		</form>
	</div >
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$("input").on("focus",function(event){
			event.stopPropagation();
			$(this).siblings(".mjsError").hide();
		});
		$("#agregar").on('click',function(){

			i = 0;
			$(".contenedor").each(function(){
				i++;
			});

			var content = $('<div/>', {
				'class' : 'contenedor',
				'id' : 'contenedor'+i
			});
			var contName = $('<div/>', {
				'class' : 'col-lg-5 col-md-5 col-xs-12',
			});
			var contValue = $('<div/>', {
				'class' : 'col-lg-5 col-md-5 col-xs-12',
			});
			var contFormName = $('<div/>', {
				'class' : 'form-group',
			});
			var contFormValue = $('<div/>', {
				'class' : 'form-group',
			});

			var labelName = $('<label/>', {
				'class' : 'control-label',
			});
			var labelValue = $('<label/>', {
				'class' : 'control-label',
			});
			var contButton = $('<div/>', {
				'class' : 'col-lg-2',
			});
			var inputName = $('<input/>', {
				'type' : 'text',
				'name' : 'names[]',
				'class' : 'form-control',
				'placeholder' : 'nombre',
				'required' : 'required',
			});
			var inputValue = $('<input/>', {
				'type' : 'text',
				'name' : 'values[]',
				'class' : 'form-control',
				'placeholder' : 'valor',
				'required' : 'required',
			});
			var buttonDelete = $('<button/>', {
				'class' : 'btn btn-danger borrarUserAcount' ,
				'id' : 'borrar'+i ,
				'type' : 'button'
			});
			var logo = $('<i/>', {
				'class' : 'fa fa-minus',
				'aria-hidden' : 'true'
			});

			$("#contNew").append(content);
			content.append(contName).append(contValue).append(contButton);
			contName.append(contFormName);
			contFormName.append(labelName).append(inputName);
			labelName.append("Nombre de variable");
			contValue.append(contFormValue);
			contFormValue.append(labelValue).append(inputValue);
			labelValue.append("Valor");
			contButton.append(buttonDelete);
			buttonDelete.append(logo);


		});

		$("#contDetail").on('click','.borrarUserAcount',function(){
			id =$(this).parent().parent(".contenedor").attr("id");
			$("#"+id).remove();
		});

	});

</script>
@endif



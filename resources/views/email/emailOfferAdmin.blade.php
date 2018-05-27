@extends('email.base')
@section('content')


<table width="400" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#ffffff"object="drag-module-small">
	<tbody>
		<tr>
			<td width="100%" valign="middle" align="center">

				<table width="500" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter">
					<tbody>
						<tr>
							<td width="100%" height="40"></td>
						</tr>
						<tr>
							<td valign="middle" width="100%" style="text-align: center; font-family: 'Open Sans', Helvetica, Arial, sans-serif; font-size: 36px; color: #f1bc16; line-height: 40px; font-weight: 100;" class="fullCenter"mc:edit="2" >
								¡Se ha Generado una oferta!
							</td>
						</tr>
					</tbody>
				</table>

			</td>
		</tr>
	</tbody>
</table>

<table width="500" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter">
													<!-- Image 42px - 3 -->
	<tbody>
		<tr>
			<td width="100%" height="35" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
		</tr>
		<tr>
			<td valign="top" width="100%" class="image42">

				<table width="20" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="erase">
					<tbody><tr>
						<td width="100%" height="10" style="font-size: 1px; line-height: 1px;" class="erase">&nbsp;</td>
					</tr>
				</tbody></table>

				<table width="100%" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full">
					<tbody>
							<tr>
								<td valign="middle" width="100%" height="40" style="text-align: left; font-family: 'Open Sans', Helvetica, Arial, sans-serif; color: rgb(50, 50, 50); font-size: 17px; font-weight: 300; line-height: 22px;" class="fullCenter"mc:edit="8" >
									<h3>El usuario {{$transaction->user->name}} ha generado una Oferta</h3><br>
									<span><b>Codigo unico de transacción:</b> {{$transaction->unique_code}}</span><br>
									<span><b>Plataforma de pago:</b> {{$transaction->payment_data->name}}</span><br>
									<span><b>Tipo de oferta:</b> {{ trans('dictionary.'.$transaction->offer->type)}}</span><br>
									@if ($transaction->offer->type=="seller")
										<span><b>Total pagado:</b> {{ $transaction->pay_btc_total}} BTC</span><br>
										<span><b>Total comisión:</b> {{($transaction->pay_btc_total * $transaction->commission)/100}} BTC</span><br>
									@elseif($transaction->offer->type=="buy")
										<span><b>Total pagado:</b> {{$transaction->pay_pesos_total}} Pesos</span><br>
										<span><b>Total comisión:</b> {{($transaction->pay_pesos_total * $transaction->commission)/100}} Pesos</span><br>
									@endif
									<span><b>Oferta:</b> {{$transaction->offer->btc}} BTC por {{$transaction->offer->pesos}} Pesos</span><br>
									<span><b>Numero de transacción:</b> {{$transaction->transaction_number}}</span><br>
								</td>
							</tr>
							<tr>
								<td width="100%" height="50" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
							</tr>

					</tbody>
				</table>


			</td>
		</tr>
		<tr>
			<td valign="top" width="100%" class="image42">

				<table width="20" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="erase">
					<tbody><tr>
						<td width="100%" height="10" style="font-size: 1px; line-height: 1px;" class="erase">&nbsp;</td>
					</tr>
				</tbody></table>

				<table width="100%" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full">
					<tbody>
						<tr>
							<td valign="middle" width="100%" height="40" style="text-align: center; font-family: 'Open Sans', Helvetica, Arial, sans-serif; color: rgb(50, 50, 50); font-size: 15px; font-weight: 500; line-height: 22px;" class="fullCenter"mc:edit="8" >
								<h4>Para que esta oferta este habilitada debe ser revisada por un administrador</h4>
							</td>
						</tr>
						<tr>
							<td width="100%" height="5" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
						</tr>
					</tbody>
				</table>


			</td>
		</tr>
		<tr>
			<td width="100%" height="35" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
		</tr>
		<tr>
			<td valign="top" width="100%" class="image42">

				<table width="20" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="erase">
					<tbody><tr>
						<td width="100%" height="10" style="font-size: 1px; line-height: 1px;" class="erase">&nbsp;</td>
					</tr>
				</tbody></table>
			</td>
		</tr>
	</tbody>
</table>
@endsection

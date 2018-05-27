@if(empty($type) || $type == 'main')
	<div class="col-md-12 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<h1 class="page-header">
					 Listado de cuentas
			        <button type="button" class="btn btn-primary btn-circle pull-right add" data-toggle="tooltip" data-placement="top" title="Agregar">
			        	<i class="fa fa-plus" aria-hidden="true"></i>
			        </button>
			        <div class="clearfix"></div>
				</h1>
			</div>
		</div>
        <div class="panel panel-default">
            <div class="panel-body">
            	@if (count($accounts)>0)
			        <table  class="table table-striped">
			            <thead>
			                <tr>
			                    <th class="text-center">ID</th>
			                    <th class="text-center">Nombre</th>
			                    <th class="text-center">Variables</th>
			                    <th class="text-center">Estatus</th>
								<th class="text-center">Acción</th>
			                </tr>
			            </thead>
			            <tbody>
			                @foreach($accounts as $account)
			                <tr>
			                    <td class="text-center">{{$account->id}}</td>
			                    <td class="text-center">{{$account->name}}</td>
			                    <td class="text-center">{{$account->paymentDataDetail->count('count_value')}}</td>
			                    <td class="text-center">
									@if ($account->status == 0)
										<span class="label label-warning">inactivo</span>
							 		@elseif($account->status == 1)
									 	<span class="label label-success">Activo</span>
								 	@endif
			                    </td>

								<td>
			                        <center>
			                            <a href="{{ route('accounts.async', ['edit', 'id'=> $account->id]) }}" class="btn btn-primary btn-sm accion">
			                                <i class="fa fa-pencil"></i> Editar
			                            </a>
			                            &nbsp
			                            <a href="{{ route('accounts.async', ['destroy', 'id'=> $account->id]) }}"  class="btn btn-danger btn-sm delete">
			                                <i class="fa fa-trash-o"></i> Eliminar
			                            </a>
			                        </center>

			                    </td>
			                </tr>
			                @endforeach
			            </tbody>
			        </table>
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

@if($type == 'create')
	<div class="col-md-12 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<h1 class="page-header">
					 Crear cuentas
					<button type="button" class="btn btn-primary btn-circle pull-right back" data-toggle="tooltip" data-placement="top" title="Volver">
						<i class="fa fa-arrow-left" aria-hidden="true"></i>
					</button>
					<div class="clearfix"></div>
				</h1>
			</div>
		</div>
	    <div class="panel panel-default">
	        <div class="panel-body">
	        	<div id="contDetail" class="col-lg-12 col-md-12 col-xs-12 m-t-30">
	        		<form class="m-t-30 form-add" id="form-add" method="POST" >
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
							<div class="col-lg-4 col-md-5 col-xs-12">
								<div class="form-group">
									<label class="control-label">valor</label>
									<input required class="form-control" placeholder="valor" type="text" name="values[]">
								</div>
							</div>
							<div class="col-lg-1 col-md-1 col-xs-12">
									<label class="control-label">Link: </label> <br>
								<label class="switch">
										  <input class="checkPayment" id="" name="is_links[0]" value="1" type="checkbox">
										  <span class="slider round"></span>
									</label>
							</div>
							<div class="col-lg-2">
								<button type="button" id="agregar" class="btn btn-primary agregar"><i class="fa fa-plus"></i></button>
							</div>
						</div>
						<div id="contNew"></div>
						<div class="clearfix"></div>
	            		<div class="text-center m-t-30 m-b-30">
	            			<button type="submit" id="createData"  class="btn btn-primary"> <i class="fa fa-check"></i> Guardar</button>
	            		</div>
					</form>
	        	</div >
	        </div>
	    </div>
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
    				'class' : 'col-lg-5 col-md-4 col-xs-12',
				});
				var contValue = $('<div/>', {
    				'class' : 'col-lg-4 col-md-4 col-xs-12',
				});
				var contLink = $('<div/>', {
    				'class' : 'col-lg-1 col-md-1 col-xs-12',
				});
				var contFormName = $('<div/>', {
    				'class' : 'form-group',
				});
				var contFormValue = $('<div/>', {
    				'class' : 'form-group',
				});
				var contFormLink = $('<div/>', {
    				'class' : 'form-group',
				});
				var labelName = $('<label/>', {
    				'class' : 'control-label',
				});
				var labelValue = $('<label/>', {
    				'class' : 'control-label',
				});
				var labelLink = $('<label/>', {
    				'class' : 'control-label',
				});
				var labelLinkswith = $('<label/>', {
    				'class' : 'switch',
				});
				var labelLinkspan = $('<span/>', {
    				'class' : 'slider round',
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
				var inputLink = $('<input/>', {
    				'type' : 'checkbox',
    				'name' : 'is_links['+i+']',
    				'value' : '1',
    				'class' : 'form-control',
				});
				var buttonDelete = $('<button/>', {
    				'class' : 'btn btn-danger borrar' ,
    				'id' : 'borrar'+i ,
    				'type' : 'button'
				});
				var logo = $('<i/>', {
    				'class' : 'fa fa-minus',
    				'aria-hidden' : 'true'
				});

				$("#contNew").append(content);
				content.append(contName).append(contValue).append(contLink).append(contButton);
				contName.append(contFormName);
				contFormName.append(labelName).append(inputName);
				labelName.append("Nombre de variable");
				contValue.append(contFormValue);
				contFormValue.append(labelValue).append(inputValue);
				labelValue.append("Valor");
				contLink.append(contFormLink);
				contFormLink.append(labelLink).append(labelLinkswith).append(inputLink);
				labelLinkswith.append(inputLink).append(labelLinkspan);
				labelLink.append("Link");
				contButton.append(buttonDelete);
				buttonDelete.append(logo);


	    	});

	    	$("#contDetail").on('click','.borrar',function(){
	    		id =$(this).parent().parent(".contenedor").attr("id");
		    	$("#"+id).remove();
	   	 	});

	    });

	</script>
@endif

@if($type == 'edit')

    <div class="panel panel-default">
        <div class="panel-body">
        	<div id="contDetail" class="col-lg-12 col-md-12 col-xs-12 m-t-30">
        		<form action="{{route('accounts.update', ['id'=> $paymentData->id])}}" class="m-t-30 form-edit" id="form-edit" method="POST" >
        			{{ csrf_field() }}
					<div class="col-md-10 col-xs-12">
						<div class="form-group">
							<label class="control-label">Tipo de cuenta: </label>
							<select readonly id="type" name="type" class="form-control">
								<option value="{{$paymentData->id}}" >{{$paymentData->name}}</option>
							</select>
							<div id="typeError" class="alert alert-danger mjsError" role="alert"></div>
						</div>
					</div>
						@if (count($paymentDataDetails)>0)
						@php $conteo = 0; @endphp
							@foreach ($paymentDataDetails as $paymentDataDetail)
								<div class="contenedor" id="{{"contenedor".$loop->index}}" >
									<div class="col-lg-5 col-md-5 col-xs-12">
										<div class="form-group">
											<label class="control-label">Nombre de variable</label>
											<input class="form-control" value="{{$paymentDataDetail->name}}" placeholder="nombre" type="text" name="names[]">
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-xs-12">
										<div class="form-group">
											<label class="control-label">valor</label>
											<input class="form-control" placeholder="valor" value="{{$paymentDataDetail->value}}" type="text" name="values[]">
										</div>
									</div>
									<div class="col-lg-1 col-md-1 col-xs-12">
											<label class="control-label">Link: </label> <br>
										<label class="switch">
												  <input class="checkPayment" id="" name="is_links[{{$conteo}}]" value="1" @if($paymentDataDetail->is_link == 1) checked @endif type="checkbox">
												  <span class="slider round"></span>
											</label>
									</div>
									@if ($loop->first)
										<div class="col-lg-2">
											<button type="button" id="agregar" class="btn btn-primary agregar"><i class="fa fa-plus"></i></button>
										</div>
        							@else
										<div class="col-lg-2">
											<button type="button" id="{{"borrar".$loop->index}}" class="btn btn-danger borrar"><i class="fa fa-minus"></i></button>
										</div>
								 	@endif
								</div>
								@php $conteo++; @endphp
							@endforeach
						@else
							<div class="contenedor" id="contenedor0" >
								<div class="col-lg-5 col-md-5 col-xs-12">
									<div class="form-group">
										<label class="control-label">Nombre de variable</label>
										<input class="form-control"  placeholder="nombre" type="text" name="names[]">
									</div>
								</div>
								<div class="col-lg-5 col-md-5 col-xs-12">
									<div class="form-group">
										<label class="control-label">valor</label>
										<input class="form-control" placeholder="valor" type="text" name="values[]">
									</div>
								</div>
								<div class="col-lg-2">
									<button type="button" id="agregar" class="btn btn-primary agregar"><i class="fa fa-plus"></i></button>
								</div>
							</div>
						@endif

					<div id="contNew"></div>
					<div class="clearfix"></div>
            		<div class="text-center m-t-30 m-b-30">
            			<button type="submit" id="createData"  class="btn btn-primary"> <i class="fa fa-check"></i> Guardar</button>
            			{{-- <button type="button" id="agregar"  class="btn btn-success "> <i class="fa fa-plus"></i> Agregar Varible</button> --}}
            		</div>
				</form>
        	</div >
        </div>
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
	'class' : 'col-lg-5 col-md-4 col-xs-12',
});
var contValue = $('<div/>', {
	'class' : 'col-lg-4 col-md-4 col-xs-12',
});
var contLink = $('<div/>', {
	'class' : 'col-lg-1 col-md-1 col-xs-12',
});
var contFormName = $('<div/>', {
	'class' : 'form-group',
});
var contFormValue = $('<div/>', {
	'class' : 'form-group',
});
var contFormLink = $('<div/>', {
	'class' : 'form-group',
});
var labelName = $('<label/>', {
	'class' : 'control-label',
});
var labelValue = $('<label/>', {
	'class' : 'control-label',
});
var labelLink = $('<label/>', {
	'class' : 'control-label',
});
var labelLinkswith = $('<label/>', {
	'class' : 'switch',
});
var labelLinkspan = $('<span/>', {
	'class' : 'slider round',
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
var inputLink = $('<input/>', {
	'type' : 'checkbox',
	'name' : 'is_links['+i +']',
	'value' : '1',
	'class' : 'form-control',
});
var buttonDelete = $('<button/>', {
	'class' : 'btn btn-danger borrar' ,
	'id' : 'borrar'+i ,
	'type' : 'button'
});
var logo = $('<i/>', {
	'class' : 'fa fa-minus',
	'aria-hidden' : 'true'
});

$("#contNew").append(content);
content.append(contName).append(contValue).append(contLink).append(contButton);
contName.append(contFormName);
contFormName.append(labelName).append(inputName);
labelName.append("Nombre de variable");
contValue.append(contFormValue);
contFormValue.append(labelValue).append(inputValue);
labelValue.append("Valor");
contLink.append(contFormLink);
contFormLink.append(labelLink).append(labelLinkswith).append(inputLink);
labelLinkswith.append(inputLink).append(labelLinkspan);
labelLink.append("Link");
contButton.append(buttonDelete);
buttonDelete.append(logo);


});

	    	$("#contDetail").on('click','.borrar',function(){
	    		id =$(this).parent().parent(".contenedor").attr("id");
		    	$("#"+id).remove();
	   	 	});

	    });

	</script>
@endif

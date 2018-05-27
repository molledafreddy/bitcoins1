@if(empty($type) || $type == 'main')
	<div class="col-md-12 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<h1 class="page-header">
					 Listado de datos de pago
			        <button type="button" class="btn btn-primary btn-circle pull-right add" data-toggle="tooltip" data-placement="top" title="Agregar">
			        	<i class="fa fa-plus" aria-hidden="true"></i>
			        </button>
			        <div class="clearfix"></div>
				</h1>
			</div>
		</div>
        <div class="panel panel-default">
            <div class="panel-body">
            	@if (count($paymentDatas)>0)
			        <table  class="table table-striped">
			            <thead>
			                <tr>
			                    <th class="text-center">ID</th>
			                    <th class="text-center">Nombre</th>
			                    <th class="text-center">Descripción</th>
			                    <th class="text-center">Estatus</th>
			                    <th class="text-center">Opciones</th>
			                </tr>
			            </thead>
			            <tbody>
			                @foreach($paymentDatas as $paymentData)
			                <tr>
			                    <td class="text-center">{{$paymentData->id}}</td>
			                    <td class="text-center">{{$paymentData->name}}</td>
			                    <td class="text-center">{{$paymentData->description}}</td>
			                    @if ($paymentData->status==1)
			                        <td class="text-center"> <span class="label label-success">activo</span></td>
			                    @else
			                        <td class="text-center"> <span class="label label-danger">inactivo</span></td>
			                    @endif
			                    <td>
			                        <center>
			                            <a href="{{ route('payment-data.async', ['tabsEdit', 'id'=> $paymentData->id]) }}" data-id="{{$paymentData->id}}" class="btn btn-primary btn-sm edit">
			                                <i class="fa fa-pencil"></i> Editar
			                            </a>
			                            &nbsp
			                            <a href="{{ route('payment-data.async', ['destroy', 'id'=> $paymentData->id]) }}"  class="btn btn-danger btn-sm delete">
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

{{-- @if($type == 'tabsCreate')
	<div class="col-md-12 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<h1 class="page-header">
					 Crear metodo de pago
			        <button type="button" class="btn btn-primary btn-circle pull-right back" data-toggle="tooltip" data-placement="top" title="Volver">
			        	<i class="fa fa-arrow-left" aria-hidden="true"></i>
			        </button>
			        <div class="clearfix"></div>
				</h1>
			</div>
		</div>

		<ul class="nav nav-tabs">
			<li role="presentation" class="active"><a id="linkPaymentTab">Forma de pago</a></li>
			<li role="presentation"><a id="linkValueTab"  >Valores</a></li>
		</ul>
		<div class="tab-content tabcontent-border">
	        <div class="tab-pane active" id="paymentTab" role="tabpanel">

	            <div id="contPaymentTab" ></div>
	        </div>
	        <div class="tab-pane" id="valueTab" role="tabpanel">

	            <div id="contValueTab" ></div>
	        </div>
	    </div>
    </div>
@endif --}}

@if($type == 'create')
	<div class="col-md-12 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<h1 class="page-header">
					 Crear tipo de cuenta
			        <button type="button" class="btn btn-primary btn-circle pull-right back" data-toggle="tooltip" data-placement="top" title="Volver">
			        	<i class="fa fa-arrow-left" aria-hidden="true"></i>
			        </button>
			        <div class="clearfix"></div>
				</h1>
			</div>
		</div>

	    <div class="panel panel-default">
	        <div class="panel-body">
	        	<div class="col-lg-12 col-md-12 col-xs-12 m-t-30">
	        		<form class="m-t-30 form-add" id="form-add" method="POST" enctype="multipart/form-data">
	        			{{ csrf_field() }}
	        			<div class="col-md-4 col-xs-12">
							<div class="form-group">
								<label class="control-label">Nombre: </label>
								<input name="name" placeholder="nombre"   class="form-control" >
								<div id="nameError" class="alert alert-danger mjsError" role="alert"></div>
							</div>
						</div>
						<div class="col-md-4 col-xs-12">
							<div class="form-group">
								<label class="control-label">descripción: </label>
								<input name="description" placeholder="Descripción"   class="form-control" >
								<div id="descriptionError" class="alert alert-danger mjsError" role="alert"></div>
							</div>
						</div>
						<div class="col-md-4 col-xs-12">
							<div class="form-group">
								<label class="control-label">Tipo de pago: </label>
								<select id="type" name="type" class="form-control">
									<option value="" >Selecciones el tipo de pago</option>
									<option value="1">Para Bitcoins</option>
									<option value="2">Para Pesos</option>
								</select>
								<div id="typeError" class="alert alert-danger mjsError" role="alert"></div>
							</div>
						</div>
					 	<div class="col-md-12">
	                        <div class="form-group">
	                            <label class="control-label">Logo:</label>
	                            <input type="file" id="input-file-now-custom-1" class="dropify" data-show-remove="true" name="logo" />
	                            <div id="logoError" class="alert alert-danger alert-rounded mjsError oculto" role="alert" ></div>
	                        </div>
	                    </div>
						<div class="clearfix"></div>
	            		<div class="text-center m-t-30 m-b-30">
	            			<button type="submit" id="createPayment"  class="btn btn-primary "> <i class="fa fa-check"></i> Guardar</button>

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

            $('.dropify').dropify();

	    });
	</script>
@endif



@if($type == 'tabsEdit')
	<div class="col-md-12 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<h1 class="page-header">
					 Editar metodo de pago
			        <button type="button" class="btn btn-primary btn-circle pull-right back" data-toggle="tooltip" data-placement="top" title="Volver">
			        	<i class="fa fa-arrow-left" aria-hidden="true"></i>
			        </button>
			        <div class="clearfix"></div>
				</h1>
			</div>
		</div>
		<ul class="nav nav-tabs">
			<li role="presentation" class="active"><a href="#paymentTab" data-id="{{$paymentData->id}}" role="tab"  id="linkPaymentTabEdit">Forma de pago</a></li>
			<li role="presentation"><a href="#valueTab" data-id="{{$paymentData->id}}" role="tab" id="linkValueTabEdit"  >Valores</a></li>
		</ul>
		<div class="tab-content tabcontent-border">
	        <div class="tab-pane active" id="paymentTab" role="tabpanel">

	            <div id="contPaymentTab" ></div>
	        </div>
	        <div class="tab-pane" id="valueTab" role="tabpanel">

	            <div id="contValueTab" ></div>
	        </div>
	    </div>
    </div>
@endif

@if($type == 'edit')
    <div class="panel panel-default">
        <div class="panel-body">
        	<div class="col-lg-12 col-md-12 col-xs-12 m-t-30">
        		<form action="{{route('payment-data.update', ['id'=> $paymentData->id])}}" class="m-t-30 form-edit" id="form-edit" method="POST" enctype="multipart/form-data" >
        			{{ csrf_field() }}
        			<div class="col-lg-4 col-md-4 col-xs-12">
						<div class="form-group">
							<label class="control-label">Nombre: </label>
							<input name="name" placeholder="nombre" value="{{$paymentData->name}}"   class="form-control" >
							<div id="nameError" class="alert alert-danger mjsError" role="alert"></div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-xs-12">
						<div class="form-group">
							<label class="control-label">descripción: </label>
							<input name="description" placeholder="Descripción" value="{{$paymentData->description}}" class="form-control" >
							<div id="descriptionError" class="alert alert-danger mjsError" role="alert"></div>
						</div>
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="form-group">
							<label class="control-label">Tipo de pago: </label>
							<select id="type" name="type" class="form-control">
								<option value="" >Selecciones el tipo de pago</option>
								<option @if ($paymentData->type==1)	selected="selected"	@endif value="1">Para Bitcoins</option>
								<option @if ($paymentData->type==2)	selected="selected"	@endif value="2">Para Pesos</option>
							</select>
							<div id="typeError" class="alert alert-danger mjsError" role="alert"></div>
						</div>
					</div>

				 	<div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Logo:</label>
                            <input type="file" id="input-file-now-custom-1" @if ($paymentData->logo) data-default-file="{{ asset('images/logos/'.$paymentData->logo) }}" @endif  class="dropify" data-show-remove="true" name="logo" />
                            <div id="logoError" class="alert alert-danger alert-rounded mjsError oculto" role="alert" ></div>
                        </div>
                    </div>
					<div class="clearfix"></div>
            		<div class="text-center m-t-30 m-b-30">
            			<button type="submit" id="editPayment"  class="btn btn-primary "> <i class="fa fa-check"></i> Editar</button>

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
            $('.dropify').dropify();


	    });
	</script>
@endif

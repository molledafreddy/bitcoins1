@if(empty($type) || $type == 'main')
	<div class="col-md-12 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<h1 class="page-header">
					 Listado de parametros
			        <button type="button" class="btn btn-primary btn-circle pull-right add" data-toggle="tooltip" data-placement="top" title="Agregar">
			        	<i class="fa fa-plus" aria-hidden="true"></i>
			        </button>
			        <div class="clearfix"></div>
				</h1>
			</div>
		</div>
        <div class="panel panel-default">
            <div class="panel-body">
            	@if (count($parameters)>0)
			        <table  class="table table-striped">
			            <thead>
			                <tr>
			                    <th class="text-center">ID</th>
			                    <th class="text-center">Nombre</th>
			                    <th class="text-center">Valor</th>
			                    <th class="text-center">Estatus</th>
			                    <th class="text-center">Opciones</th>
			                </tr>
			            </thead>
			            <tbody>
			                @foreach($parameters as $parameter)
			                <tr>
			                    <td class="text-center">{{$parameter->id}}</td>
			                    <td class="text-center">{{$parameter->parameterType->name}}</td>
			                    <td class="text-center">@if($parameter->parameterType->id == 2 ||$parameter->parameterType->id == 3){{$parameter->value}} % @else {{$parameter->value}} @endif </td>
			                    @if ($parameter->status==1)
			                        <td class="text-center"> <span class="label label-success">activo</span></td>
			                    @else
			                        <td class="text-center"> <span class="label label-danger">inactivo</span></td>
			                    @endif
			                    <td>
			                        <center>
			                            <a href="{{ route('parameters.async', ['edit', 'id'=> $parameter->id]) }}" class="btn btn-primary btn-sm accion">
			                                <i class="fa fa-pencil"></i> Editar
			                            </a>
			                            &nbsp
			                            <a href="{{ route('parameters.async', ['destroy', 'id'=> $parameter->id]) }}"  class="btn btn-danger btn-sm delete">
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
					 Crear parametros
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
            		<form class="m-t-30 form-add" id="form-add" method="POST" >
            			{{ csrf_field() }}
            			<div class="col-lg-6 col-md-6 col-xs-12">
		            		<div class="form-group">
		            		 	<label class="control-label">Tipo de parametro:</label>
				            	<select  id="parameter_type_id" name="parameter_type_id" class="form-control">
									<option  value="">Selecciones el tipo de parametro</option>
									@foreach ($parameterTypes as $parameterType)
										<option value="{{$parameterType->id}}">{{$parameterType->name}}</option>
									@endforeach
								</select>
								<div id="parameter_type_idError" class="alert alert-danger mjsError" role="alert"></div>
							</div>
            			</div>
            			<div class="col-lg-5 col-md-5 col-xs-11">
							<div class="form-group col-md-12">
								<label class="control-label col-md-12">valor:</label>
								<div id="contInputValor" class="col-lg-10 col-md-10 col-xs-10">
									<input name="value" placeholder="valor"  class="form-control" >
								</div>
								<div id="valueError" class="alert alert-danger mjsError" role="alert"></div>
							</div>
						</div>
						<div class="clearfix"></div>
            		<div class="text-center m-t-30 m-b-30">
            			<button type="submit" id="createParametro"  class="btn btn-primary "> <i class="fa fa-check"></i> Guardar</button>
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

            $("select").on("focus",function(event){
				event.stopPropagation();
				$(this).siblings(".mjsError").hide();
			});

			$("#parameter_type_id").on("change", function(event){
				event.stopPropagation();
				$("#contInputValor").empty();
				if($(this).val() == "2" || $(this).val() == "3"){
					$("#contInputValor").append("<div class='input-group'><input type='text' placeholder='valor' name='value'  class='form-control'><span class='input-group-addon'>%</span></div>");
				}else{
					$("#contInputValor").append("<input name='value' placeholder='valor' class='form-control' >");
				}

			});

	    });
	</script>
@endif

@if($type == 'edit')
	<div class="col-md-12 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<h1 class="page-header">
					 Editar parametros
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
            		<form action="{{ route('parameters.update', ['id' => $parameter->id]) }}" class="m-t-30 form-edit" id="form-add" method="POST" >
            			{{ csrf_field() }}
            			<div class="col-lg-6 col-md-6 col-xs-12">
		            		<div class="form-group">
		            		 	<label class="control-label">Tipo de parametro:</label>
		            		 	<input name="value" value="{{$parameter->parameterType->name}}" disabled class="form-control" >

								<div id="parameter_type_idError" class="alert alert-danger mjsError" role="alert"></div>
							</div>
            			</div>
            			<div class="col-lg-6 col-md-6 col-xs-12">
							<div class="form-group">
								<label class="control-label">valor:</label>
								@if ($parameter->parameterType->id == 2 || $parameter->parameterType->id == 3)
									<div class="input-group">
									   	<input id="value" value="{{$parameter->value}}" type="text" placeholder="valor" name="value"  class="form-control">
								    	<span class="input-group-addon">%</span>
								  	</div>
								@else
									<input name="value" value="{{$parameter->value}}" placeholder="valor"  class="form-control" >
								@endif
								<div id="valueError" class="alert alert-danger mjsError" role="alert"></div>
							</div>
						</div>
						<div class="clearfix"></div>
            		<div class="text-center m-t-30 m-b-30">
            			<button type="submit" id="editParametro"  class="btn btn-primary "> <i class="fa fa-check"></i> Editar</button>
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
	    });
	</script>
@endif

@if(empty($type) || $type == 'main')
	<div class="col-md-12 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<h1 class="page-header">
					 Listado del contenido
			        <button type="button" class="btn btn-primary btn-circle pull-right add" data-toggle="tooltip" data-placement="top" title="Agregar">
			        	<i class="fa fa-plus" aria-hidden="true"></i>
			        </button>
			        <div class="clearfix"></div>
				</h1>
			</div>
		</div>
        <div class="panel panel-default">           
            <div class="panel-body">
            	@if (count($loadContents)>0)
			        <table  class="table table-striped">
			            <thead>
			                <tr>
			                    <th class="text-center">ID</th>
			                    <th class="text-center">Nombre</th>			                  		                    
			                    <th class="text-center">Estatus</th>
			                    <th class="text-center">Opciones</th>
			                </tr>
			            </thead>
			            <tbody>
			                @foreach($loadContents as $loadContent)
			                <tr>
			                    <td class="text-center">{{$loadContent->id}}</td>
			                    <td class="text-center">{{$loadContent->contentType->name}}</td>			                   
			                   
			                    @if ($loadContent->status==1)
			                        <td class="text-center"> <span class="label label-success">activo</span></td>                                
			                    @else
			                        <td class="text-center"> <span class="label label-danger">inactivo</span></td>
			                    @endif
			                    <td>
			                        <center>
			                            <a href="{{ route('load-contents.async', ['edit', 'id'=> $loadContent->id]) }}" class="btn btn-primary btn-sm accion">
			                                <i class="fa fa-pencil"></i> Editar
			                            </a>
			                            &nbsp
			                            <a href="{{ route('load-contents.async', ['destroy', 'id'=> $loadContent->id]) }}"  class="btn btn-danger btn-sm delete">
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
					 Crear contenido
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
            		<div class="text-center">            			
            			<button type="submit" id="createTemplate"  class="btn btn-primary "> <i class="fa fa-check"></i> Guardar</button>
            		</div>
            		<form class="m-t-30" name="createContentForm" id="createContentForm" method="POST" > 
	            		<div class="form-group">  
	            		 	<label class="control-label">Tipo de contenido:</label>       		
			            	<select id="content_type_id" name="content_type_id" class="form-control type-content-select">
								<option value="">Selecciones el tipo de contenido</option>
								@foreach ($contentTypes as $contentType)				  	
									<option value="{{$contentType->id}}">{{$contentType->name}}</option>				 
								@endforeach
							</select>
							<div id="content_type_idError" class="alert alert-danger mjsError" role="alert"></div>
						</div>	
						<div class="form-group">
							<label class="control-label">Contenido:</label>
							<textarea name="template" id="editor"></textarea>
						</div>
					</form>
            	</div >
            </div>
            
        </div>
    </div>

    <script type="text/javascript">
	    $(document).ready(function(){ 
	        CKEDITOR.replace( 'editor',{
	            fullPage: true,
	            allowedContent: true
	        });  

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

@if($type == 'edit')
	<div class="col-md-12 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<h1 class="page-header">
					 Editar contenido
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
            		<div class="text-center">            			
            			<button type="submit" id="editTemplate"  class="btn btn-primary "> <i class="fa fa-check"></i> Guardar</button>
            		</div>
            		<form action="{{ route('load-contents.update', ['id' => $loadContent->id]) }}" class="m-t-30" name="editContentForm" id="editContentForm" method="POST" > 
	            		<div class="form-group">  
	            		 	<label class="control-label">Tipo de contenido:</label>       		
			            	<input name="price" value="{{$loadContent->contentType->name}}" disabled class="form-control decimal"  min="0">
							<div id="content_type_idError" class="alert alert-danger mjsError" role="alert"></div>
						</div>	
						<div class="form-group">
							<label class="control-label">Contenido:</label>
							<textarea name="template" id="editor">{!! $loadContent->template !!}</textarea>
						</div>
					</form>
            	</div >
            </div>
            
        </div>
    </div>

    <script type="text/javascript">
	    $(document).ready(function(){ 
	        CKEDITOR.replace( 'editor',{
	            fullPage: true,
	            allowedContent: true
	        });  
	        

	    });
	</script>
@endif



@if(empty($type) || $type == 'main')
	<div class="col-md-12 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<h1 class="page-header">
					 Listado de comentarios
			        <div class="clearfix"></div>
				</h1>
			</div>
		</div>
        <div class="panel panel-default">           
            <div class="panel-body">
            	@if (count($comments)>0)
			        <table  class="table table-striped">
			            <thead>
			                <tr>
			                    <th class="text-center">ID</th>
			                    <th class="text-center">Nombre</th>	
			                    <th class="text-center">Comentario</th>
			                    <th class="text-center">Estatus</th>
			                    <th class="text-center">Acciones</th>
			                </tr>
			            </thead>
			            <tbody>
			                @foreach($comments as $comment)
			                <tr>
			                    <td class="text-center">{{$comment->id}}</td>
			                    <td class="text-center">{{$comment->name}}</td>
			                    <td class="text-center">{{$comment->comment}}</td>
			                    @if ($comment->status=='si')
			                        <td class="text-center"> <span class="label label-success">activo</span></td>
			                    @else
			                        <td class="text-center"> <span class="label label-danger">inactivo</span></td>
			                    @endif
			                    <td>
			                        <center>
			                            <a href="{{ route('admin.comment.async', ['edit', 'id'=> $comment->id]) }}" class="btn btn-primary btn-sm accion">
			                                <i class="fa fa-pencil"></i> Editar
			                            </a>
			                            &nbsp
			                            <a href="{{ route('admin.comment.async', ['destroy', 'id'=> $comment->id]) }}"  class="btn btn-danger btn-sm delete">
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

@if($type == 'edit')
	<div class="col-md-12 col-sm-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
				<h1 class="page-header">
					 Cambiar estatus
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
            			<button type="submit" id="editStatus"  class="btn btn-primary "> <i class="fa fa-check"></i> Guardar</button>
            		</div>
            		<form action="{{ route('admin.comment.update', ['id' => $comment->id]) }}" class="m-t-30" name="editFormStatus" id="editFormStatus" method="POST" > 
            			<div class="form-group">
						    <label>Estatus</label>
						    <select id="status" name="status" class="form-control">
						    	<option value="si" {{ $comment->status == 'si' ? 'SELECTED' : '' }}>Activo</option>
						    	<option value="no" {{ $comment->status == 'no' ? 'SELECTED' : '' }}>Inactivo</option>
						    </select>
						</div>
					</form>
            	</div >
            </div>            
        </div>
    </div>
@endif



@if(empty($type) || $type == 'main')
<div class="row">
	<div class="col-lg-12 col-md-12 col-xs-12">
		<h1 class="page-header">
			 Listado de Usuarios 
			<button type="button" class="btn btn-primary btn-circle pull-right add" data-toggle="tooltip" data-placement="top" title="Agregar Usuario">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</button>
			<div class="clearfix"></div>

		</h1>
	</div>
</div>
<div class="panel panel-warning">
    <div class="panel-heading text-center">
		<span class="label label-danger" alt="Pendientes por Activar" style="size: 50px;">Pendientes</span>
		<span class="label label-success" alt="Activas">Activos</span>
    </div>
    <div class="panel-body" role="tabpanel" id="myTabs">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#user" data-toggle="tab">Usuarios</a></li>
            <li class=""><a href="#admin" data-toggle="tab">Administradores</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade active in" id="user">
            	<br>
                <table id="users" class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Apellido</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center">Usuario</th>
                            <th class="text-center">Creado</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></th>
				    	</tr>
				    </thead>
			  	</table>
            </div>
            <div class="tab-pane fade" id="admin">
            	<br>
                <table id="admins" class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Apellido</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center">Usuario</th>
                            <th class="text-center">Creado</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></th>
				    	</tr>
				    </thead>
			  	</table>
            </div>
        </div>
    </div>
</div>
@endif

@if($type == 'create')
<div class="panel panel-warning">

	<form method="POST" action="#"  class="form-add">
		{{ csrf_field() }}
		{{ method_field('POST') }}

		<div>
			<div class="row">
				<div class="col-lg-6 col-md-6">
			        <h1 class="h3 title-form">Agregar usuario</h1>
				</div>
			</div>
		</div>
		<div class="alert alert-danger print-error-msg" style="display: none;">
            <ul></ul>
        </div>
		<div class="container-fluid">
		  	<div class="row">
		    	<div class="col-md-12">
					<div class="col-md-3 form-group">
					    <label>Tipo de usuario</label>
					    <select name="type" class="form-control">
					    	<option value="A">Administrador</option>
					    	<option value="U">Usuario</option>					    	
					    </select>
					</div>
					<div class="col-md-3 form-group">
					    <label>Nombre</label>
		              	<input type="text" name="name" maxlength="30" placeholder="Nombre" class="form-control" required>
					</div>
					<div class="col-md-3 form-group">
							<label>Apellido</label>
							  <input type="text" name="lastname" maxlength="30" placeholder="Apellido" class="form-control" required>
						</div>
					<div class="col-md-3 form-group">
					    <label>Contraseña de Ingreso</label>
		              	<input type="text" name="password" maxlength="30" placeholder="Contraseña" class="form-control" required>
					</div>
				</div>
		      	<div class="col-md-12">
				  	<div class="col-md-6 form-group">
					    <label>Correo</label>
					    <input type="text" name="email" maxlength="70" placeholder="Correo electrónico" class="form-control" required>
					</div>
					<div class="col-md-6 form-group">       
		              	<label>Usuario</label>
		              	<input type="text" name="username" maxlength="15" placeholder="Usuario" class="form-control" required>
		            </div>
		      	</div>
		  		<div class="clearfix"></div>
		      	<div class="col-lg-12">
		      		<div class="form-group text-center"> 
	  					<input type="submit" value="Guardar" class="btn btn-primary">
	  					<input type="button" name="cancel" id="cancel" value="Cancelar" class="btn btn-secondary cancel">
					</div>
		      	</div>
		      	<div class="col-lg-12">
		      		<div class="message-sucess alert alert-success" style="display: none;"> Los datos han sido guardados exitosamente!</div>
		      		<div class="message-error alert alert-danger" style="display: none;"> Ha ocurrido un error en el guardado de los datos!</div>
			  	</div>
		    </div>
		</div>
	</form>
</div>

@endif

@if($type == 'edit')
<div class="panel panel-warning">

	<form method="POST" action="{{ route('admin.users.async', ['update', 'id'=> $user->id]) }}" class="form-edit">
		{{ csrf_field() }}
        {{ method_field('PUT') }}
		<div>
			<div class="row">
				<div class="col-lg-6 col-md-6">
			        <h1 class="h3 title-form">Editar usuario</h1>
				</div>
			</div>
		</div>
		<div class="alert alert-danger print-error-msg" style="display: none;">
            <ul></ul>
        </div>
		<div class="container-fluid">
		  	<div class="row">
		    	<div class="col-lg-6">
		    		<div class="form-group">       
		              	<label>Nombre</label>
		              	<input required type="text" maxlength="30" name="name" value="{{ $user->name }}" placeholder="Nombre" class="form-control">
		            </div>
					<div class="form-group">
					    <label>Correo</label>
					    <input required type="text" maxlength="70" name="email" value="{{ $user->email }}" placeholder="Correo electrónico" class="form-control">
					</div>
		      	</div>
		      	<div class="col-lg-6">
					<div class="form-group">       
		              	<label>Apellido</label>
		              	<input required type="text" name="lastname" maxlength="15" value="{{ $user->lastname }}" placeholder="Apellido" class="form-control">
					</div>
					<div class="form-group">       
							<label>Usuario</label>
							<input required type="text" name="username" maxlength="15" value="{{ $user->username }}" placeholder="Usuario" class="form-control">
					  </div>
		      	</div>
		      	<div class="col-lg-6">
		    		<div class="form-group">
					    <label>Estatus</label>
					    <select name="is_active" class="form-control">
					    	<option value="1" {{ $user->is_active == 1 ? 'SELECTED' : '' }}>Activo</option>
					    	<option value="2" {{ $user->is_active == 2 ? 'SELECTED' : '' }}>Inactivo</option>
					    </select>
					</div>
				</div>
		      	<div class="col-lg-12">
		      		<div class="form-group text-center">
	  					<input type="submit" value="Guardar" class="btn btn-primary">
	  					<input type="button" name="cancel" id="cancel" value="Cancelar" class="btn btn-secondary cancel">
					</div>
		      	</div>
		      	<div class="col-lg-12">
		      		<div class="message-sucess alert alert-success" style="display: none;"> Los datos han sido editados exitosamente!</div>
		      		<div class="message-error alert alert-danger" style="display: none;"> Ha ocurrido un error en el editado de los datos!</div>
				  </div>
		    </div>
		</div>
	</form>
</div>

@endif

<script>
	$(document).ready(function(){
		$('#myTabs a[href="' + window.location.hash + '"]').tab('show');

		$('#users').DataTable({
			"language" : {url: "{{ asset('/plugins/datatables/spanish.json') }}"},
			"processing": true,
			"serverSide": true,
			"ajax": "{{ route('admin.users.datatables', ['type' => 'U']) }}",
			"columns": [
				{data: 'name', name: 'users.name'},
				{data: 'lastname', name: 'users.lastname'},
				{data: 'email', name: 'users.email'},
				{data: 'username', name: 'users.username'},
				{data: 'created_at', name: 'users.created_at', class: 'text-center'},
				{data: 'status', name: 'status', class: 'text-center', orderable: false, searchable: false},
				{data: 'actions', name: 'actions', class: 'text-center', orderable: false, searchable: false},
			]
		});
		
		$('#admins').DataTable({
			"language" : {url :"{{ asset('/plugins/datatables/spanish.json') }}"},
			"processing": true,
			"serverSide": true,
			"ajax": "{{ route('admin.users.datatables', ['type' => 'A']) }}",
			"columns": [
				{data: 'name', name: 'users.name'},
				{data: 'lastname', name: 'users.lastname'},
				{data: 'email', name: 'users.email'},
				{data: 'username', name: 'users.username'},
				{data: 'created_at', name: 'users.created_at', class: 'text-center'},
				{data: 'status', name: 'status', class: 'text-center', orderable: false, searchable: false},
				{data: 'actions', name: 'actions', class: 'text-center', orderable: false, searchable: false},
			]
		});
	})
</script>

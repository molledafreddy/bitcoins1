@extends('admin.template.main')

@section('content')
<div class="container-fluid">
  	<ul class="breadcrumb">
    	<li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
    	<li class="breadcrumb-item active">Comentarios</li>
	</ul>
	

	<div class="col-lg-12 col-md-12 col-xs-12" id="content-load-data"></div>
</div>
@endsection

@push('scripts')
    

	<script>
	
		$(document).ready(function(){
			limpiar_sidebar(2);
			
			$('#content-load-data').load("{{ route('admin.comment.async', 'main') }}", function(){
				
			});

			
			$('body').on('click', '.back', function(event){
				event.preventDefault();				
				$('#content-load-data').load("{{ route('admin.comment.async', 'main') }}", function(){
					
				});
			});

			$('body').on('click', '.back', function(event){
				event.preventDefault();				
				$('#content-load-data').load("{{ route('admin.comment.async', 'main') }}", function(){
					
				});
			});

			$('body').on('click', '.accion', function(event){
				event.preventDefault();	
				href = $(this).attr("href");			
				$('#content-load-data').load(href, function(){
					
				});
			});

			$('body').on('click', '.delete', function(event){
				event.preventDefault();	
				href = $(this).attr("href");
				$.confirm({
				    title: '¡Confirmación!',
				    content: '¿Desea Borrar el contenido?',
				    buttons: {
				        Aceptar: function () {	        	
				        	$.ajax({
		                        type:"GET",
		                        dataType: 'json',
		                        url:href,                                                
		                        success:function(response){
				            		$.alert('¡Borrado con éxito!');
				            		$('#content-load-data').load("{{ route('admin.comment.async', 'main') }}", function(){				
									});		                                     
		                        }
		                    });   
				        },
				        Cancelar: function () {
				            
				        }				        
				    }
				});							
				
			});
			
			$("body").on("click","#editStatus", function(event){
				event.preventDefault();					
				$("#editStatus").prop( "disabled",true);				
				var status=document.getElementById('status').value;
				action  = $("#editFormStatus").attr("action");
				$.ajax({
                    type:"POST",                   
                    url:action,
                    dataType: 'json',             
                    data:{"_token": "{{ csrf_token() }}", status:status},                    
                    success:function(response){                    	
                    	$("#editStatus").prop( "disabled",false); 
                    	$('#content-load-data').load("{{ route('admin.comment.async', 'main') }}", function(){
						});              	
                    },
                    error:function(data){                    	                 	
                    	$("#editStatus").prop( "disabled",false); 
                    	$.each(data.responseJSON.errors, function(key,value){
                    		$("#"+key+"Error").html(value);
                    		$("#"+key+"Error").show();
                    	});                       	 
                    }
                });
			});
			
		});
		
	</script>
@endpush
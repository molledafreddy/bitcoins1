@extends('admin.template.main')

@section('content')
<div class="container-fluid">
  	<ul class="breadcrumb">
    	<li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
    	<li class="breadcrumb-item active">Carga de contenido</li>
	</ul>
	

	<div class="col-lg-12 col-md-12 col-xs-12" id="content-load-data"></div>
</div>
@endsection



@push('scripts')
    

	<script>
		

		$(document).ready(function(){
			limpiar_sidebar(3);
			
			$('#content-load-data').load("{{ route('load-contents.async', 'main') }}", function(){
				
			});

			$('body').on('click', '.add', function(event){
				event.preventDefault();
				
				$('#content-load-data').load("{{ route('load-contents.async', 'create') }}", function(){
					
				});
			});

			$('body').on('click', '.back', function(event){
				event.preventDefault();				
				$('#content-load-data').load("{{ route('load-contents.async', 'main') }}", function(){
					
				});
			});

			$('body').on('click', '.back', function(event){
				event.preventDefault();				
				$('#content-load-data').load("{{ route('load-contents.async', 'main') }}", function(){
					
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
				            		$('#content-load-data').load("{{ route('load-contents.async', 'main') }}", function(){				
									});		                                     
		                        }
		                    });   
				        },
				        Cancelar: function () {
				            
				        }				        
				    }
				});							
				
			});

			$("body").on("click","#createTemplate", function(event){
				event.preventDefault();					
				$("#createTemplate").prop( "disabled",true);
                template = CKEDITOR.instances.editor.getData();
                content_type_id = $("#content_type_id").val();                             
                
				$.ajax({
                    type:"POST",                   
                    url:"{{ route('load-contents.store') }}",
                    dataType: 'json',             
                    data:{"_token": "{{ csrf_token() }}",template:template,content_type_id:content_type_id},                    
                    success:function(response){                    	
                    	$("#createTemplate").prop( "disabled",false);                    	
                    	$('#content-load-data').load("{{ route('load-contents.async', 'main') }}", function(){
						});              	
                    },
                    error:function(data){                    	                 	
                    	$("#createTemplate").prop( "disabled",false); 
                    	$.each(data.responseJSON.errors, function(key,value){
                    		$("#"+key+"Error").html(value);
                    		$("#"+key+"Error").show();
                    	});                       	 
                    }
                });
			});

			$("body").on("click","#editTemplate", function(event){
				event.preventDefault();					
				$("#editTemplate").prop( "disabled",true);
                template = CKEDITOR.instances.editor.getData();                                         
                action  = $("#editContentForm").attr("action");

				$.ajax({
                    type:"POST",                   
                    url:action,
                    dataType: 'json',             
                    data:{"_token": "{{ csrf_token() }}",template:template},                    
                    success:function(response){                    	
                    	$("#editTemplate").prop( "disabled",false);                    	
                    	$('#content-load-data').load("{{ route('load-contents.async', 'main') }}", function(){
						});              	
                    },
                    error:function(data){                    	                 	
                    	$("#editTemplate").prop( "disabled",false); 
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
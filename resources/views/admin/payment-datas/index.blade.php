@extends('admin.template.main')

@section('content')
<div class="container-fluid">
  	<ul class="breadcrumb">
    	<li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
    	<li class="breadcrumb-item active">Datos de pago</li>
	</ul>


	<div class="col-lg-12 col-md-12 col-xs-12" id="content-load-data"></div>
</div>
@endsection



@push('scripts')


	<script>


		$(document).ready(function(){
			limpiar_sidebar(3);

			$('#content-load-data').load("{{ route('payment-data.async', 'main') }}", function(){

			});

			$('body').on('click', '.add', function(event){
				event.preventDefault();

				$('#content-load-data').load("{{ route('payment-data.async', 'create') }}", function(){
				});
			});

			$('body').on('click', '.edit', function(event){
                event.preventDefault();
                urlAccion = $(this).attr("href");
                id = $(this).data("id");
            	$('#content-load-data').load("{{ route('payment-data.async', 'edit') }}/"+id, function(){

				});


            });


			$('body').on('click', '.back', function(event){
				event.preventDefault();
				$('#content-load-data').load("{{ route('payment-data.async', 'main') }}", function(){

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
				    content: '¿Desea Borrar el dato de pago?',
				    buttons: {
				        Aceptar: function () {
				        	$.ajax({
		                        type:"GET",
		                        dataType: 'json',
		                        url:href,
		                        success:function(response){
				            		$.alert('¡Borrado con éxito!');
				            		$('#content-load-data').load("{{ route('payment-data.async', 'main') }}", function(){
									});
		                        }
		                    });
				        },
				        Cancelar: function () {

				        }
				    }
				});

			});

			$('body').on('submit', '.form-add', function(event){
				event.preventDefault();
				formData = new FormData(this);
				$("#createPayment").prop( "disabled",true);
				$.ajax({
                    type:"POST",
                    url:"{{ route('payment-data.store') }}",
                    dataType: 'json',
                  	processData: false,
                    contentType: false,
                    data:formData,
                    success:function(response){
                    	$('#content-load-data').load("{{ route('payment-data.async', 'main') }}", function(){
						});
                    },
                    error:function(data){
                    	$("#createPayment").prop( "disabled",false);
                    	$.each(data.responseJSON.errors, function(key,value){
                    		$("#"+key+"Error").html(value);
                    		$("#"+key+"Error").show();
                    	});
                    }
                });
			});

			

			$("body").on("submit",".form-edit", function(event){
				event.preventDefault();
				$("#editPayment").prop( "disabled",true);
                action  = $(this).attr("action");
                formData = new FormData(this);

				$.ajax({
                    type:"POST",
                    url:action,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data:formData,
                    success:function(response){
                    	$("#editPayment").prop( "disabled",false);
                    	$('#content-load-data').load("{{ route('payment-data.async', 'main') }}", function(){
						});
                    },
                    error:function(data){
                    	$("#editPayment").prop( "disabled",false);
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

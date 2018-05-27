@extends('admin.template.main')

@section('content')
<div class="container-fluid">
	<div class="loader" style="display: none; z-index: 990"></div>

	<ul class="breadcrumb">
    	<li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
    	<li class="breadcrumb-item active">Verificar Transacción</li>
	</ul>


	<div class="col-lg-12 col-md-12 col-xs-12" id="content-load-data"></div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

	<script>

		$(document).ready(function(){
			limpiar_sidebar(3);

			$('#content-load-data').load("{{ route('transaction-verification.async','main') }}", function(){

			});

			$('body').on('click', '.add', function(event){
				event.preventDefault();

				$('#content-load-data').load("{{ route('transaction-verification.async', 'create') }}", function(){

				});
			});

			$('body').on('click', '#clean', function(event){
				event.preventDefault();

				$('#content-load-data').load("{{ route('transaction-verification.async','main') }}", function(){

				});
			});

			$('body').on('click', '.pagination a', function(event){
				event.preventDefault();
				href = $(this).attr("href");
				$('#content-load-data').load(href, function(){
				});
			});

			$('body').on('submit', '#search', function(event){

	            event.preventDefault();

	            var name =$("#name").val();
	            var type =$("#type").val();
	            var status =$("#status").val();
	            var money =$("#money").val();
	            var transaction_number =$("#transaction_number").val();
	            $(".overlayLoading").removeClass("oculto");
	            $.ajax({
	                type:"GET",
	                url:"{{ route('transaction.search') }}",
	                dataType: 'html',
	                data:$(this).serialize(),
	                success:function(response){
	                	console.log(response);
	                    $(".overlayLoading").addClass("oculto");
	                    $('#content-load-data').html(response);
	                	$("#name").val(name);
	                	$("#type").val(type);
	                	$("#status").val(status);
	                	$("#money").val(money);
	                	$("#transaction_number").val(transaction_number);
	                }
	            });
	        });

			$('body').on('click', '.back', function(event){
				event.preventDefault();
				$('#content-load-data').load("{{ route('transaction-verification.async', 'main') }}", function(){

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
				    content: '¿Desea Borrar el parametro?',
				    buttons: {
				        Aceptar: function () {
				        	$.ajax({
		                        type:"GET",
		                        dataType: 'json',
		                        url:href,
		                        success:function(response){
				            		$.alert('¡Borrado con éxito!');
				            		$('#content-load-data').load("{{ route('transaction-verification.async', 'main') }}", function(){
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

				$("#createParametro").prop( "disabled",true);
				$.ajax({
                    type:"POST",
                    url:"{{ route('parameters.store') }}",
                    dataType: 'json',
                    data:$(this).serialize(),
                    success:function(response){
                    	$('#content-load-data').load("{{ route('transaction-verification.async', 'main') }}", function(){

						});
                    },
                    error:function(data){
                    	$("#createParametro").prop( "disabled",false);
                    	$.each(data.responseJSON.errors, function(key,value){
                    		$("#"+key+"Error").html(value);
                    		$("#"+key+"Error").show();
                    	});
                    }
                });
			});

			$("body").on("submit",".form-edit", function(event){
				event.preventDefault();
				$("#editParametro").prop( "disabled",true);
                action  = $(this).attr("action");

				$.ajax({
                    type:"POST",
                    url:action,
                    dataType: 'json',
                    data:$(this).serialize(),
                    success:function(response){
                    	$("#editParametro").prop( "disabled",false);
                    	$('#content-load-data').load("{{ route('transaction-verification.async', 'main') }}", function(){
						});
                    },
                    error:function(data){
                    	$("#editParametro").prop( "disabled",false);
                    	$.each(data.responseJSON.errors, function(key,value){
                    		$("#"+key+"Error").html(value);
                    		$("#"+key+"Error").show();
                    	});
                    }
                });
			});

			$('body').on('click', '#verificar', function(event){
				event.preventDefault();
				href = $(this).attr("href");

				$.confirm({
				    title: 'Confirmacion!',
				    content: '¿Desea Aprobar la oferta?',
				    buttons: {
				        Aceptar: function () {
							$(".overlayLoading").removeClass("oculto");
				            $.ajax({
				                type:"GET",
				                url:href,
				                dataType: 'json',
				                success:function(response){
									$(".overlayLoading").addClass("oculto");
				                	$('#content-load-data').load("{{ route('transaction-verification.async', 'main') }}", function(){

									});
				                },
				                error:function(data){
									$(".overlayLoading").addClass("oculto");
				                	$.each(data.responseJSON.errors, function(key,value){
				                		$("#"+key+"Error").html(value);
				                		$("#"+key+"Error").show();
				                	});
				                }
				            });
				        },
				        Cancelar: function () {

				        }

				    }
				});


			});

			$('body').on('click', '#rechazar', function(event){
				event.preventDefault();
				href = $(this).attr("href");

				$.confirm({
				    title: 'Confirmacion!',
				    content: '¿Desea rechazar la oferta?',
				    buttons: {
				        Aceptar: function () {
							$(".overlayLoading").removeClass("oculto");
				            $.ajax({
			                    type:"GET",
			                    url:href,
			                    dataType: 'json',
			                    success:function(response){
									$(".overlayLoading").addClass("oculto");
			                    	$('#content-load-data').load("{{ route('transaction-verification.async', 'main') }}", function(){

									});
			                    },
			                    error:function(data){
									$(".overlayLoading").addClass("oculto");
			                    	$.each(data.responseJSON.errors, function(key,value){
			                    		$("#"+key+"Error").html(value);
			                    		$("#"+key+"Error").show();
			                    	});
			                    }
                			});
				        },
				        Cancelar: function () {

				        }

				    }
				});

			});

		});
	</script>
@endpush

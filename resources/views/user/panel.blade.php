@extends('site.template.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
<div class="" id="contChat"></div>
<div class="loader" style="display: none; z-index: 990"></div>
<div class="col-lg-12  padd-lr0">
<div class="container">
    <div class="row profile">
		<div class="col-md-3 no-left-padding" >
			<!--  ofertas -->
			@include('site.template.partials.panel')
		</div>
		<div class="col-md-9 profile-content" id="profile-content">
		</div>
	</div>
	</div>
	</div>
<center>
<strong>  &nbsp; </strong>
</center>
<br>
<br>

<script>
	$(document).ready(function(){


		$('#profile-content').load("{{ route('user.dashboard') }}", function(){
		});

		$('body').on('click', '.back', function(event){
			event.preventDefault();
			$('#profile-content').load("{{ route('user.dashboard') }}", function(){

			});
		});

      	$('body').on('click', '.pagination a', function(event){
			event.preventDefault();
			href = $(this).attr("href");
			$('#profile-content').load(href, function(){
			});
		});

		$('body').on('click', '.accion', function(event){
				event.preventDefault();
				href = $(this).attr("href");
				$('#profile-content').load(href, function(){

				});
			});


		$('body').on('click', '.uedit', function(event){
			event.preventDefault();
			showLoading(1);
			$('#profile-content').load("{{ route('user.edituser') }}", function(){
			});
			showLoading(2);
		});

		$('body').on('click', '.pedit', function(event){
			event.preventDefault();
			showLoading(1);
			$('#profile-content').load("{{ route('user.editpassword') }}", function(){
			});
			showLoading(2);
		});

        $('body').on('click', '.account_index', function(event){
            event.preventDefault();
            showLoading(1);
            $('#profile-content').load("{{ route('user.account_index') }}", function(){
            });
            showLoading(2);
        });

        

        $('body').on('click', '.add_account', function(event){
            event.preventDefault();
            showLoading(1);
            $('#profile-content').load("{{ route('user.async', 'add_account') }}", function(){
            });
            showLoading(2);
        });

        $('body').on('click', '.edit_bank_account', function(event){
            event.preventDefault();
            showLoading(1);
            href = $(this).attr("href");
            $('#profile-content').load(href, function(){
            });
            showLoading(2);
        });
        $('body').on('click', '.verMas', function(event){
            event.preventDefault();
            $( ".active" ).removeClass( "active" )
            $( ".transactions" ).addClass( "active" );
			showLoading(1);
			$('#profile-content').load("{{ route('user.transactions') }}", function(){
			});
			showLoading(2);
		});

		$('body').on('submit', '.form-add-account', function(event){
				event.preventDefault();
				action  = $(this).attr("action");

				$("#createData").prop( "disabled",true);
				$.ajax({
                    type:"POST",
                    url:action,
                    dataType: 'json',
                    data:$(this).serialize(),
                    success:function(response){
                        $("#createData").prop( "disabled",false);
                    	$('#profile-content').load("{{ route('user.async', 'account_index') }}", function(){

						});
                    },
                    error:function(data){
                    	$("#createData").prop( "disabled",false);
                    	$.each(data.responseJSON.errors, function(key,value){
                    		$("#"+key+"Error").html(value);
                    		$("#"+key+"Error").show();
                    	});
                    }
                });
			});

        $('body').on('submit', '.form-edit-account', function(event){
				event.preventDefault();
				action  = $(this).attr("action");

				$("#createData").prop( "disabled",true);
				$.ajax({
                    type:"POST",
                    url:action,
                    dataType: 'json',
                    data:$(this).serialize(),
                    success:function(response){
                        $("#createData").prop( "disabled",false);
                    	$('#profile-content').load("{{ route('user.async', 'account_index') }}", function(){
						});
                    },
                    error:function(data){
                    	$("#createData").prop( "disabled",false);
                    	$.each(data.responseJSON.errors, function(key,value){
                    		$("#"+key+"Error").html(value);
                    		$("#"+key+"Error").show();
                    	});
                    }
                });
			});

        $('body').on('click', '.edit_account', function(event){
            event.preventDefault();
            showLoading(1);
            $('#profile-content').load("{{ route('user.async', 'main') }}", function(){
            });
            showLoading(2);
        });

        $('body').on('click', '.delete_bank_account', function(event){
				event.preventDefault();
				href = $(this).attr("href");
				$.confirm({
				    title: '¡Confirmación!',
				    content: '¿Desea eliminar la cuenta?',
				    buttons: {
				        Aceptar: function () {
				        	$.ajax({
		                        type:"GET",
		                        dataType: 'json',
		                        url:href,
		                        success:function(response){
				            		$.alert('¡Borrado con éxito!');
				            		$('#profile-content').load("{{ route('user.async', 'account_index') }}", function(){
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
@endsection

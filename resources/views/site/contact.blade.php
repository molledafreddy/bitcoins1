@extends('site.template.main')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-xs-6">
                    <div class="wheel-contact-info text-center marg-lg-t150 marg-lg-b50 marg-xs-t50 marg-xs-b50">
                        <div class="wheel-contact-logo"><i class="fa fa-map-marker"></i></div>
                        <h4>Dirección</h4>
                        <span>Carrera 70 #78-28, barrio Bonanza Bogota Colombia</span>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-6">
                    <div class="wheel-contact-info text-center marg-lg-t150 marg-lg-b50 marg-xs-t50 marg-xs-b50">
                        <div class="wheel-contact-logo"><i class="fa fa-phone"></i></div>
                        <h4>telefono</h4>
                        <a href=""><span>(+57) 35 0835 7856</span></a>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-6">
                    <div class="wheel-contact-info text-center marg-lg-t150 marg-lg-b50 marg-xs-t50 marg-xs-b50">
                        <div class="wheel-contact-logo"><i class="fa fa-envelope"></i></div>
                        <h4>Email</h4>
                        <a href=""><span>contacto@bitcoinbogota.co</span></a>                        
                    </div>
                </div>
            </div>
        </div>
        <!-- ////////////////////////////////// -->
        <div class="container">
                <div class="col-xs-12">
                    <div class="wheel-header text-center marg-lg-t50 marg-lg-b50  marg-md-t20">
                        <h5>Contactanos</h5>
                    </div>
                </div>

            <div class="row">
                <div class="col-xs-12 padd-lr0">
                    <div class="preloader marg-lg-b145 oculto">
                      <img class="load" src="{{asset("images/Ripple.gif")}}" alt="">
                    </div>
                    <div class="wheel-contact-form text-center marg-lg-b145 ">
                      <form id="form-contacto"  method="post">
                        {{ csrf_field() }}
                        <div class="form">
                            <input name="nombre" id="nombre" type="text" placeholder="Nombre *">
                            <input name="email" id="email"  type="text" placeholder="Email *">
                            <input name="asunto" id="asunto" type="text" placeholder="Asunto *">
                            <textarea name="mensaje" id="mensaje"  placeholder="Mensaje *"></textarea>
                            <div class="alert alert-success message-sucess m-t-10 oculto" role="alert">Los datos se han enviado con éxito</div>
                            <div class="alert alert-danger message-error m-t-10 oculto" role="alert"></div>
                            <button id="contactoEnviar" class="wheel-btn">Enviar mensaje</button>
                        </div>

                      </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
          $(document).ready(function(){
            $("#contactoEnviar").on("click",function(){
              $("#contactoEnviar").prop("disabled",true);
              $(".wheel-contact-form").hide();
              $(".preloader").show();
              event.preventDefault();
              showLoading(1);
              $.ajax({
                  type:"POST",
                  url:"{{ route('contact.store') }}",
                  dataType:"json",
                  data:$("#form-contacto").serialize(),
                  success:function(data){
                    $("#contactoEnviar").prop("disabled",false);
                    $(".wheel-contact-form").show();
                    $(".preloader").hide();
                    $('.message-sucess').show();
                    showLoading(2);
                    setTimeout(function() {
                      $('.message-sucess').hide();
                      $('#nombre').val('');
                      $('#email').val('');
                      $('#asunto').val('');
                      $('#mensaje').val('');
                    }, 3000);
                  },
                  error:function(data){
                    showLoading(2);
                    $(".wheel-contact-form").show();
                    $(".preloader").hide();
                    $("#contactoEnviar").prop("disabled",false);
                    $(".message-error").empty();
                    $.each(data.responseJSON.errors, function(key,value){
                      $(".message-error").append("<li>"+value+"</li>");
                      $('.message-error').show();
                      setTimeout(function() {
                        $('.message-error').hide();
                      }, 3000);
                  	});
                  }
              });
            });
          });

        </script>
        @endsection

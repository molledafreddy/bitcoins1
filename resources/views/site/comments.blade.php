@extends('site.template.main')

@section('content')
<div class="wheel-register-block" style=" background-size: cover;background-image:url({{ asset('images/bg8.jpg') }});">    
    <div class="container ">
        <div class=" marg-lg-t150 marg-md-t150  marg-sm-t100 marg-sm-b100" >
            <div class="row">
                <div class="col-md-12"  style="padding-bottom:20px;">
                    <div class="card" style="background-color: rgba(230,300,200,0.5);">             
                        <div class="card-action" style="border-bottom: 1px solid rgba(160, 160, 160, 0.2);">
                            <a href="#">                
                                <div class="wheel-header">
                                    <center>
                                        <h3 style="padding-bottom:10px" >Escribe tu Comentario</h3>
                                    </center>
                                     <p  style=" margin-left: 100px; font-size: 15px; color:#6c7179;">
                                        Estamos agradecidos de que quieras compartir tu experiencia, envianos tus comentarios y estaremos felices de mostrarselos a nuestros visitantes.
                                    </p>                                    
                                </div>
                            </a>
                        </div>  
                        <div class="wheel-register-log labele" style="background-color: rgba(600,600,600,0.5); padding: 0px">
                            <div class="card-content" >
                                <form  class="form-add" role="form" method="POST" action="{{ route('user.account') }}">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}
                                    <div class="row">
                                        <div class="alert alert-danger print-error-msg" style="display: none;">
                                            <ul></ul>
                                        </div>
                                        <div class=" col-lg-10 col-md-10 col-xs-12 col-md-offset-1">
                                            <input id="name" type="text" placeholder="Tu nombre" name="name" required class="form-control">
                                            @if ($errors->has('name'))
                                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class=" col-lg-10 col-md-10 col-xs-12 col-md-offset-1">
                                            <textarea id="comment" maxlength="500" class="form-control" rows="5" name="comment" required placeholder="Tu comentario" class="form-control"></textarea>
                                            @if ($errors->has('comment'))
                                                <span class="help-block"><strong>{{ $errors->first('comment') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-xs-12 col-md-offset-1">
                                            <button type="submit" class="wheel-btn">Enviar</button>
                                        </div>
                                        <div class="col-lg-10 col-md-12 col-xs-12 col-md-offset-1">
                                            <div class="message-sucess alert alert-success" style="display: none;"> Los datos han sido guardados exitosamente!</div>
                                            <div class="message-error alert alert-danger" style="display: none;"> Ha ocurrido un error en el guardado de los datos!</div>
                                        </div>                             
                                    </div>                          
                                </form>
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </div>           
</div>
<script>
    
    $(document).ready(function() {

      $('body').on('submit', '.form-add', function(event){
            $(".print-error-msg").css('display','none');
            event.preventDefault();
            showLoading(1);
            $.ajax({
                type:"POST",
                url:"{{ route('comment.store') }}",
                dataType:"json",
                data:$(this).serialize(),
                success:function(response){
                    if($.isEmptyObject(response.error)){
                        $('.message-sucess').show();
                        showLoading(2);
                        setTimeout(function() {
                            $('.message-sucess').hide();
                             $('#name').val('');
                             $('#comment').val('');
                             $('').load("{{ route('comments') }}");
                        }, 3000);
                    } else {
                        showLoading(2);
                        printErrorMsg(response.error);
                    }
                },
                error:function(response){
                    console.log(response);
                }
            });
        });

        function printErrorMsg (msg, type) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }

    });
</script>
@endsection


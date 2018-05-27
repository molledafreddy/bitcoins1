@extends('site.template.main')

@section('content')
@include('site.template.modals.message')
<div class="loader" style="display: none; z-index: 990"></div>
<div class="col-lg-12  padd-lr0">
  <div class="container">
    <div class="row profile">
      <div class="col-md-12 profile-content" id="create-form"></div>
    </div>
  </div>
</div>
<center>
  <strong>  &nbsp; </strong>
</center>
<br>
<br>
<script>

  $(document).ready(function() {

    $('#create-form').load("{{ route('offers.async', 'create_panel') }}", function() {});


     $("body").on("keyup","#transaction_number_buy", function(event){
        event.preventDefault();
        if($(this).val() != ''){
           $('#procesarCompra').removeAttr('disabled');
        }
    }).keyup();

    $("body").on("keyup","#transaction_number_seller", function(event){
        event.preventDefault();
        if($(this).val() != ''){
           $('#procesarVenta').removeAttr('disabled');
        }
    }).keyup();

    $('body').on('click', '#offers', function(event) {
      event.preventDefault();
      showLoading(1);
      $('#create-form').load("{{ route('offers.async', 'create_panel') }}", function() {});
      showLoading(2);
    });


    $('body').on('click', '#settings', function(event) {
      event.preventDefault();
      showLoading(1);
      $('#create-form').load("{{ route('user.settings') }}", function() {});
      showLoading(2);
    });

    $('body').on('click', '#panel', function(event) {
      event.preventDefault();
      showLoading(1);
      $('#create-form').load("{{ route('user.dashboard') }}", function() {});
      showLoading(2);
    });

    $('body').on('click', '.transactions', function(event){
      event.preventDefault();
      showLoading(1);
      $('#create-form').load("{{ route('user.transactions') }}", function(){
      });
      showLoading(2);
    });

    $("body").on("keyup","#total-seller", function(event){
      event.preventDefault();
      getDataOffer();
    }).keyup();

    $("body").on("keyup","#value_offer_seller", function(event){
      event.preventDefault();
      getDataOffer();
    }).keyup();

    $("body").on("keyup","#total-buy", function(event){
      event.preventDefault();
      getDataOfferBuy();

    }).keyup();
    $("body").on("keyup","#value_offer_buy", function(event){
      event.preventDefault();
      getDataOfferBuy();

    }).keyup();

    $('body').on('click', '.transactions', function(event) {
      event.preventDefault();
      showLoading(1);
      $('#profile-content').load("{{ route('user.transactions') }}", function() {});
      showLoading(2);
    });
    $("#modalMessage").on("hidden.bs.modal", function () {
      window.location.replace("{{ route('user.panel') }}");
    });

    $('body').on('submit', '.form-add', function(event){

      $("#procesarVenta").prop( "disabled",true);
      $("#overlayLoading").removeClass("oculto");
      $(".print-error-msg").css('display','none');

      event.preventDefault();

      $.ajax({
        type:"POST",
        url:"{{ route('offers.async', 'store') }}",
        dataType:"json",
        data:$(this).serialize(),
        success:function(response){
          console.log(response);
          $("#overlayLoading").addClass("oculto");
          $("#procesarVenta").prop( "disabled",false);
          $('.message-sucess').show();
          $('#contentModal').empty();
          $('#contentModal').append("<p>Su transaccion sera evaluada y recibira respuesta en en los proximos minutos</p>");
          $('#modalMessage').modal('show');
        },
        error:function(data){
          $("#overlayLoading").addClass("oculto");
          $("#procesarVenta").prop( "disabled",false);
          $.each(data.responseJSON.errors, function(key,value){
            $("#"+key+"Error").html(value);
            $("#"+key+"Error").show();
          });
        }
      });
    });

    $('body').on('submit', '.form-add-buy', function(event){

      $("#overlayLoading").removeClass("oculto");
      $("#procesarCompra").prop( "disabled",true);
      $(".print-error-msg").css('display','none');
      event.preventDefault();
      $.ajax({
        type:"POST",
        url:"{{ route('offers.async', 'storeBuy') }}",
        dataType:"json",
        data:$(this).serialize(),
        success:function(response){
          console.log(response);
          $("#overlayLoading").addClass("oculto");
          $("#procesarCompra").prop( "disabled",false);
          $('.message-sucess').show();
          $('#contentModal').empty();
          $('#contentModal').append("<p>Su transaccion sera evaluada y recibira respuesta en los proximos minutos</p>");
          $('#modalMessage').modal('show');
        },
        error:function(data){
          $("#overlayLoading").addClass("oculto");
          $("#procesarCompra").prop( "disabled",false);
          $.each(data.responseJSON.errors, function(key,value){
            $("#"+key+"Error").html(value);
            $("#"+key+"Error").show();
          });
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
    function getDataOffer(){
      showLoading(1);
      $.ajax({
        type:"GET",
        url:"{{ route('offers.async', 'getDataPayment') }}",
        dataType:"json",
        success:function(response){
          showLoading(2);

          sell = parseFloat($("#total-seller").val());
          oferta = parseFloat($("#value_offer_seller").val());
          commision = parseFloat(response.comisionBticoins);
          valor = (sell.toFixed(8)*commision.toFixed(8))/100;
          comicionBTC = valor.toFixed(8);
          valor = sell.toFixed(8) - valor.toFixed(8);
          if(isNaN(valor)){
            valor = "0.00";
          }
          console.log(valor);

          $("#totalBTC").empty();
          $("#contComision").empty();
          $("#contComisionBTC").empty();
          $("#ofertaBTC").empty();
          $("#ofertaPesos").empty();
          $("#totalBTC").text(sell);
          $("#ofertaBTC").text(valor.toFixed(8));
          $("#ofertaPesos").text(oferta.toFixed(2));
          $("#contComision").text(commision);
          $("#contComisionBTC").text(comicionBTC);
        }
      });
    }

    function getDataOfferBuy(){
      showLoading(1);
      $.ajax({
        type:"GET",
        url:"{{ route('offers.async', 'getDataPayment') }}",
        dataType:"json",
        success:function(response){
          showLoading(2);
          value_offer_buy = parseFloat($("#value_offer_buy").val());
          buy = parseFloat($("#total-buy").val());
          commision = parseFloat(response.comisionPesos);
          valor = (value_offer_buy*commision)/100;
          total = value_offer_buy - valor;
          total = total.toFixed(2);
          if(isNaN(total)){
            total = "0.00";
          }
          console.log(total);

          $("#totalPesos").empty();
          $("#contComision").empty();
          $("#ofertaBTCBuy").empty();
          $("#ofertaPesosBuy").empty();
          $("#totalPesos").text(value_offer_buy.toFixed(2));
          $("#comisionPesos").text(valor.toFixed(2));
          $("#ofertaBTCBuy").text(buy.toFixed(8));
          $("#ofertaPesosBuy").text(total);
        }
      });
    }

    function ShowPreviewSeller(){
      var offer = $("#value_offer_seller").val();
      var total = $("#total-seller").val();
      if(offer != "" && total != ""){
        $(".previa").show();
      }else{
        $(".previa").hide();
      }
    }
  });

</script>
@endsection

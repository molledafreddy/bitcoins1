@inject('home', 'App\Http\Controllers\HomeController')
<div id="leydeuso" class="modal fade" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Terminos y Condiciones</h4>
      </div>
      <div class="modal-body" onscroll="comprobar()">
        {!!$home->terms_cond()->template!!}
      </div>
      <div class="modal-footer text-center">
        <center>
        <button disabled="disabled" type="button" id="#acepto" class="btn boton_offer_disabled acepto" data-dismiss="modal" style="float:none">Aceptar</button>
      </center>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
  var terms = document.getElementById("leydeuso");
  function comprobar(){
    if(terms.scrollHeight == (terms.scrollTop + terms.clientHeight)){
      $(".acepto").removeAttr("disabled");
      $(".acepto").removeClass("boton_offer_disabled");
      $(".acepto").addClass("btn-default");
    }
  }
</script>



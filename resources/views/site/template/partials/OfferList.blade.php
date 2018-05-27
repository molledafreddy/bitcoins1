
<div class="wheel-start wheel-start2 col-md-12 col-xs-12" style="background-color: #eceff1;padding-bottom:10px;margin-top:30px">
    <div class="container">
        <div class="col-lg-12">
            <header class="wheel-header  wheel-testi-header text-center ">
                <h3>COMPRAR <span> BITCOINS</span> </h3>
                <h3 class="font-15 "> Tienes <span><b> pesos</b></span> y deseas comprar <span><b>Bitcoins</b> </span></h3>
            </header>
        </div>
    </div>
</div>

<div class="container">
    <div class="tab-content">
        <div id="compra" class="tab-pane fade in active">
        </div>
    </div>
</div>


<div class="wheel-start wheel-start2 col-md-12 col-xs-12" style="background-color: #eceff1;padding-bottom:10px;margin-top:30px">
    <div class="container">
        <div class="col-lg-12">
            <header class="wheel-header  wheel-testi-header text-center " >
                <h3>VENDER <span> BITCOINS</span> </h3>
                <h3 class="font-15 " >Tienes <span><b>Bitcoins</b> </span> y deseas optener <span><b> pesos</b></span></h3>
            </header>
        </div>
    </div>
</div>

<div class="container">
    <div class="tab-content">
        <div id="venta" class="tab-pane fade in active">
        </div>
    </div>
</div> 

@push('scripts')
<script>
    $(document).ready(function(){

        $('#compra').load("{{ route('buys') }}", function(){
        });

        $('#venta').load("{{ route('sells') }}", function(){
        });
    });
</script>
@endpush

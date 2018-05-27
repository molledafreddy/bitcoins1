<div class="wheel-footer-info wheel-bg6">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-6  padd-lr0"><span>&#169; BITCOINBOGOTA 2018 | Todos los derechos reservados</span></div>
            <div class="col-lg-4 col-sm-6 padd-lr0">
                <div class="wheel-soc wheel-soc-null pull-right">
                    <a href="" class="fa fa-twitter"></a>
                    <a href="" class="fa fa-facebook"></a>
                    <a href="" class="fa fa-linkedin"></a>
                    <a href="" class="fa fa-instagram"></a>
                    <a href="" class="fa fa-share-alt"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready(function(){
            @if(Auth::user())
                setTimeout(function(){
                    window.location = '{{ route('salida') }}';
                }, 2000000);
            @endif
        });
</script>
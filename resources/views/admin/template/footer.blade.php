<!-- Footer -->
<footer class="clearfix footer">
    <div class="pull-left">
            <span>&#169; BITCOINBOGOTA 2018 | Todos los derechos reservados</span>
    </div>
</footer>
<!-- END Footer -->

<!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
<a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a> 
@push('scripts')
<script>
        $(document).ready(function(){
            @if(Auth::user())
                setTimeout(function(){
                    window.location = '{{ route('salida') }}';
                }, 2000000);
            @endif
        });
</script>
@endpush

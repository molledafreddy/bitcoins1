<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<!-- Header-->
 
@include('site.template.header')

<script>
function showLoading($con) {
        if ($con == '1') {
            $('.loader').show(500);
        } else {
            $('.loader').hide(500);
        }
    }
</script>

<body class=""  @if(!Auth::guest()) style="background-color:aliceblue"@endif >

        <!-- Loader -->
        <div class="load-wrap">
            <div class="wheel-load">
                <img src="{{ asset('images/logo.png') }}" width="190px" alt="" class="image">
            </div>
        </div>
        {{-- loading --}}
        <div id="overlayLoading" class="overlayLoading d-flex aling-item-center justify-content oculto">
           <div id="loading" class="loader" style="z-index: 3001;"></div>
        </div>

        <span class="ir-arriba"><i class="fa fa-angle-double-up"></i></span>

        @include('site.template.partials.banner')

        <!-- Navbar -->
        @include('site.template.partials.NavBar')

        <!-- Flash Messages -->
        @include('flash::message')

        <!-- MAIN -->
        @yield('content')



        <!-- footer -->
        @if(Auth::guest()) @include('site.template.footer') @else @include('site.template.user_footer') @endif

        @include('site.template.scripts')

        <script>
            $('#flash-overlay-modal').modal();
        </script>
</body>

</html>

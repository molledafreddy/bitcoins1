<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<!-- Header-->
@include('admin.template.header')
<script>
    function showLoading($con) {
        if ($con == '1') {
            $('.loader-Admin').show(500);
        } else {
            $('.loader-Admin').hide(500);
        }
    }
</script>

<body class="">
        <div class="loader-Admin" style="display: none; z-index: 990"></div>
        {{-- loading --}}
        <div id="overlayLoading" class="overlayLoading d-flex aling-item-center justify-content-center oculto">
           <div id="loading" class="loader" style="z-index: 3001;"></div>
        </div>

    <!-- Navbar -->


    <div id="page-wrapper">
        <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
            @include('admin.template.partials.SideBar')
            <!-- Main Container -->
            <div id="main-container">
                @include('admin.template.partials.NavBar')
                <div id="page-wrapper">
                    <!-- Page content -->
                    <div id="page-content">
                        <!-- MAIN -->
                        @yield('content') 
                    </div>
                    @include('admin.template.footer')
                    @include('site.template.modals.admin_settings')
                    <!-- footer -->
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
                @include('admin.template.scripts') @stack('scripts')

                <script>
                    $('#flash-overlay-modal').modal();
                </script>
</body>

</html>
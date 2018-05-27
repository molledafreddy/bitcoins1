 

        <!-- Scripts project -->
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

        <script type="text/javascript" src="{{ asset('js/jquery-confirm.js') }}"></script>
        <!-- count -->
        <script type="text/javascript"  src="{{ asset('js/jquery-countTo.js') }}"></script>
        <!-- google maps -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt5tJTim4lOO3ojbGARhPd1Z3O3CnE-C8" type="text/javascript"></script>
        <!-- swiper -->
        <script type="text/javascript" src="{{ asset('js/idangerous.swiper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/equalHeightsPlugin.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/index.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-ui.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
       


        @stack('scripts')

        <!-- sixth block end -->

        
        <script type="text/javascript">
        $('.ir-arriba').click(function(){
          $('body, html').animate({
            scrollTop: '0px'
          }, 300);
        });

        $(window).scroll(function(){
          if( $(this).scrollTop() > 0 ){
            $('.ir-arriba').slideDown(300);
          } else {
            $('.ir-arriba').slideUp(300);
          }
        });


                $('#flash-overlay-modal').modal();
        </script>


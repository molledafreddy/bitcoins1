<div class="profile-sidebar">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
            <img @if(!empty($logo_user->value))src="{{ asset($logo_user->value) }}" @else  src="{{ asset('images/user-icon.png') }}" @endif class="img-responsive" alt="">
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
            <span>@</span>{{Auth::user()->name}} {{Auth::user()->lastname}}
            </div>
            <div class="profile-usertitle-job">
                {{Auth::user()->username}}
            </div>

            {{-- <div class="profile-usertitle-name">
                $ 400 - BTC 0.001
                <br><span style="font-size:12px">Este es su saldo disponible en BITCOINBOGOTA</span>
            </div> --}}
        </div>
        <!-- END SIDEBAR USER TITLE -->

        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
                <li id="panel" class="active">
                    <a  href="">
                    <i class="glyphicon glyphicon-user"></i>
                    Inicio </a>
                </li>
                <li class="transactions">
                    <a  href="" >
                    <i class="glyphicon glyphicon-ok"></i>
                    Transacciones </a>
                </li>
                <li id="settings">
                    <a  href="">
                    <i class="glyphicon glyphicon-cog"></i>
                    Configuración de Cuenta </a>
                </li>
            </ul>
        </div>
        <!-- END MENU -->
    </div>
<script>

		$('body').on('click', '#settings', function(event){
            event.preventDefault();
            $( ".active" ).removeClass( "active" )
            $( "#settings" ).addClass( "active" );
            showLoading(1);
			$('#profile-content').load("{{ route('user.settings') }}", function(){
			});
			showLoading(2);
		});

		$('body').on('click', '#panel', function(event){
			event.preventDefault();
            showLoading(1);
            $( ".active" ).removeClass( "active" )
            $( "#panel" ).addClass( "active" );
            showLoading(1);
			$('#profile-content').load("{{ route('user.dashboard') }}", function(){
			});
			showLoading(2);
		});

		$('body').on('click', '.transactions', function(event){
            event.preventDefault();
            $( ".active" ).removeClass( "active" )
            $( ".transactions" ).addClass( "active" );
			showLoading(1);
			$('#profile-content').load("{{ route('user.transactions') }}", function(){
			});
			showLoading(2);
		});


</script>

@extends('site.template.main')

@section('content')
<div class="wheel-register-block" style="min-height: 550px;background-size: cover;background-image:url({{ asset('images/bg6.jpg') }});">
<div class="container">
            <div class=" marg-lg-t150  marg-sm-t100 marg-sm-b100">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="col-md-12" style="padding-bottom:20px;">
                                <div class="card" style="background-color:white">
                                    <div class="card-action" style="border-bottom: 1px solid rgba(160, 160, 160, 0.2);">
                                        <a href="#" target="new_blank" >
                                            <div class="wheel-header">
                                                <center>
                                                    <h3 style="padding:0px" >Ofertas de Venta</h3>
                                                    <h3 class="font-15 " >Tienes <span><b>Bitcoins</b> </span> y deseas optener <span><b> pesos</b></span></h3>
                                                </center>
                                            </div>
                                        </a>
                                    </div>
                                    <div id="sells"></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){

        $('#sells').load("{{ route('sells') }}", function(){
        });
    });
</script>
@endpush

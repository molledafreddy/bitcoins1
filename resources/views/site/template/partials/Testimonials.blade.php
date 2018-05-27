<div class="wheel-bg2">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="wheel-header wheel-testi-header text-center marg-lg-t155 marg-lg-b65 marg-md-t50  marg-md-b50">
                    <h3>Nuestra Misión es satisfacer al <span>Cliente</span></h3>
                </div>
            </div>
        </div>
     <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @php $i = 0; @endphp
                    @foreach ($comments as $element)
                        @if ($i == 0)
                          <div class="item active">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="wheel-testimonial text-center">
                                            <p>{{$element->comment}}.</p>
                                            <div class="wheel-testimonial-info">
                                                <span>{{ $element->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          </div> 
                        @php $i++; @endphp
                        @endif
                        <div class="item ">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="wheel-testimonial text-center">
                                        <p>{{$element->comment}}.</p>
                                        <div class="wheel-testimonial-info">
                                            <span>{{$element->name}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    @endforeach
                <!-- Left and right controls -->
                <a class="left carousel-control no-back" href="#myCarousel" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left main-color"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control no-back" href="#myCarousel" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right main-color"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>

        <div class="row">
            <div class="col-xs-12 padd-lr0  marg-lg-b50  marg-md-b50 marg-lg-t50 marg-lg-t50">
                <div class="wheel-testimonial-item">
                    <i class="fa fa-users"></i>
                    <span data-to="200" data-speed="10000"></span><b>+</b>
                    <p>Usuarios Registrados</p>
                </div>
                <div class="wheel-testimonial-item">
                    <i class="fa fa-thumbs-o-up"></i>
                    <span data-to="240" data-speed="5000"></span><b>+</b>
                    <p>Compradores Satisfechos</p>
                </div>
                <div class="wheel-testimonial-item">
                    <i class="fa  fa-btc"></i>
                    <span data-to="34" data-speed="6000"></span><b>+</b>
                    <p>Bitcoins Vendidos</p>
                </div>
                <div class="wheel-testimonial-item">
                    <i class="fa fa-check"></i>
                    <span data-to="312" data-speed="1000"></span><b>+</b>
                    <p>Transacciones Completadas</p>
                </div>
            </div>
        </div>
    </div>
</div>
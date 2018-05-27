<div class="col-md-12" style="padding-top:20px; background-color: #fff; padding-bottom:30px">

        @php $i = 0; @endphp
        @foreach ($items as $item)
          @php
          $src = '';
          $doc = new DOMDocument();
          @$doc->loadHTML($item->get_description());

          $tags = $doc->getElementsByTagName('img');

          foreach ($tags as $tag) {
            $src = $tag->getAttribute('src');
          }
          @endphp
          @if($src)
          <div class="col-md-2 col-sm-4 col-xs-12">
            <div class="card" style="height:230px">
                <div class="card-image" >
                    <img class="img-responsive" style="width:100%" src="{{ $src }}">
                </div>
                             
                <div class="card-action">
                    <a  href="{{ $item->get_permalink() }}"  rel="nofollow" target="new_blank">{{ $item->get_title() }}</a>
                </div>
            </div>
        </div>
        @if ($i == 5) @break @endif
        @php $i++; @endphp
        @endif
        @endforeach
        </div>
        </div>
<script>

  $(document).ready(function(){
    
	var clickEvent = false;
	$('#myCarousel').carousel({
		interval:   4000	
	}).on('click', '.list-group li', function() {
			clickEvent = true;
			$('.list-group li').removeClass('active');
			$(this).addClass('active');		
	}).on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = $('.list-group').children().length -1;
			var current = $('.list-group li.active');
			current.removeClass('active').next().addClass('active');
			var id = parseInt(current.data('slide-to'));
			if(count == id) {
				$('.list-group li').first().addClass('active');	
			}
		}
		clickEvent = false;
	});
})

$(window).load(function() {
    var boxheight = $('#myCarousel .carousel-inner').innerHeight();
    var itemlength = $('#myCarousel .item').length;
    var triggerheight = Math.round(boxheight/itemlength+1);
	$('#myCarousel .list-group-item').outerHeight(triggerheight);
});
  
</script>
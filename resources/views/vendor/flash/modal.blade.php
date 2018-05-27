<div id="flash-overlay-modal" class="modal flash fade {{ $modalClass or '' }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <div>
                    <img class="logo" src="{{asset('images/logo.png')}}" alt="">        
                </div>
            </div>

            <div class="modal-body">
                <p>{!! $body !!}</p>
            </div>

            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

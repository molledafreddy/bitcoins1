@extends('site.template.main')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="wheel-contact-info text-center marg-lg-t150 marg-lg-b50 marg-xs-t50 marg-xs-b50">
                        <div class="wheel-contact-logo"><i class="fa fa-book"></i></div>
                        <h4>{{$content->contentType->name}}</h4>
                        <span>{!!$content->template!!}</span>
                    </div>
                </div>
            </div>
        </div>
@endsection

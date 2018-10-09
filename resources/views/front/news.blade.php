@extends('front.layout')

@section('lay_out')

    <div class="news">
        <div class="container">
            <div class="row">

                @foreach($news as $new)
                    <div class="col-xs-12">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <div class="img-container">
                                        <img class="media-object img-responsive" src="{{url('uploads/'.$new->news_images[0]->img_url)}}" alt="new_img">
                                    </div>
                                </a>
                            </div>
                            <div class="media-body media-middle">
                                <h4 class="media-heading">{{$new->name}}</h4>
                                <p>
                                    {!! html_entity_decode($new->description) !!}
                                </p>
                                <a href="{{url('news/'.$new->id)}}">
                                    المزيد ...
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>

@endsection


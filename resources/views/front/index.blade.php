@extends('front.layout')

@section('lay_out')

    <div class="home-slide-container left_direction">
        <div class="home_slider">
            @foreach($slides as $slide)
                <div>
                    <img src="{{url('uploads/' . $slide->img_url)}}">
                </div>
            @endforeach

        </div>
    </div>

    <div class="elsafwa_info">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <p class="text">
                        {{$detail->description}}
                    </p>
                </div>
                <div class="col-md-6 col-xs-12">
                    <video playsinline autoplay  muted controls class="section-background-video" width="0" style="min-width: 100%;
   width: 100%">
                        <source src="{{url('uploads/'.$detail->video)}}">
                    </video>

                </div>
            </div>
        </div>
    </div>

@endsection


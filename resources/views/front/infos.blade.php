@extends('front.layout')

@section('lay_out')

    <div class="news">
        <div class="container new_details">

            <div class="new-slider_container left_direction">
                <div class="new_slider">
                    @foreach($imgs as $img)
                        <div>
                            <img src="{{url('uploads/'.$img->img_url)}}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <div class="new_info">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="article-container">
                            {!! html_entity_decode($info->description) !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>

@endsection


@extends('front.layout')

@section('lay_out')

    <div class="departs">
        <div class="container">
            <h2>
                اقسام الموقع :
            </h2>

            <div class="row">
                @foreach($departs as $depart)
                    <div class="col-md-3 col-sm-6 col-xs-12">

                        <div class="depart_holder">
                            <div class="v-align">
                                <img src="{{url('uploads/'.$depart->img_url)}}" class="img-responsive">
                                <p class="text-center">
                                    {{$depart->name}}
                                </p>
                            </div>
                            <div class="overlay text-center">
                                <a href="{{url('departs/'.$depart->id)}}" class="v-align">
                                    المزيد
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>

@endsection


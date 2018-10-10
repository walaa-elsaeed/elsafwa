@extends('front.layout')

@section('lay_out')

    <div class="news">
        <div class="container">


            <div class="row">

                <div class="col-xs-12">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <div class="img-container">
                                    <img class="media-object img-responsive" src="{{url('uploads/'.$user->img_url)}}"
                                         alt="profile_img" style="width: 100%">
                                </div>
                            </a>
                        </div>
                        <div class="media-body media-middle">
                            <h4 class="media-heading">
                                الاسم :
                                {{$user->name}}
                            </h4>
                            <p>
                                البريد الالكترونى :
                                {{$user->email}}
                                <br>
                                @if(isset($user->phone))
                                    التليفون :
                                    {{$user->phone}}
                                @endif
                            </p>

                            @if (Auth::check())
                                @if(Auth::user()->id ==$user->id )
                                    <a href="{{url('users/'.$user->id.'/edit')}}">
                                        تعديل ...
                                    </a>
                                    </div>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>




            @if(count($user->interests)>0)

                <div class="row departs">
                    <h2>
                        قائمه المفضله الخاصه بك
                    </h2>
                    @foreach($user->interests as $interest)

                        <div class="col-md-3 col-sm-6 col-xs-12">

                            <div class="depart_holder">
                                <div class="v-align">
                                    <img src="{{url('uploads/'.$interest->depart->img_url)}}" class="img-responsive">
                                    <p class="text-center">
                                        {{$interest->depart->name}}
                                    </p>
                                </div>
                                <div class="overlay text-center">
                                    <a href="{{url('departs/'.$interest->depart->id)}}" class="v-align">
                                        المزيد
                                    </a>
                                </div>
                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>
    </div>

@endsection


@extends('front.layout')

@section('lay_out')

    <div class="blog">
        <div class="container">
            <h2>
                البلوج :
            </h2>

            <div class="row">
                @foreach($blogs as $blog)
                    <div class="col-md-3 col-sm-6 col-xs-12">

                        <div class="blog_holder">
                            <div class="v-align">
                                <p class="text-center">
                                   {{$blog->name}}
                                </p>
                            </div>
                            <div class="overlay text-center">
                                <a href="{{url('blogs/'.$blog->id)}}" class="v-align">
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


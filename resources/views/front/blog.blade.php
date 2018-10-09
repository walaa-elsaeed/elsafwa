@extends('front.layout')

@section('lay_out')

    <div class="blog_details">
        <div class="container">

            <div class="row">
                <div class="col-xs-12">
                    <h2>
                       {{$blog->name}} :
                    </h2>
                </div>
            </div>

            <div class="articles">
                <h3 class="text-center">
                    المقالات
                </h3>

                @if(count($blog->blog_article)>0)
                    <div class="row">

                        @foreach($blog->blog_article as $article)
                            <div class="col-md-3 col-sm-6 col-xs-12 btm-margin">
                                <div>
                                    <img src="{{url('front/images/article-icon.jpg')}}" class="img-responsive">

                                    <div class="content text-center">
                                        <h5 class="text-center">
                                            {{$article->name}}
                                        </h5>
                                        <p class="text-center">
                                            {!! html_entity_decode($article->description) !!}
                                        </p>
                                        <a href="{{url('blog_articles/'.$article->id)}}">
                                            التفاصيل
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endif


            </div>


        </div>



    </div>

@endsection


@extends('front.layout')

@section('lay_out')

    <div class="depart_details">
        <div class="container">

            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <h2>
                       {{$depart->name}} :
                    </h2>
                </div>
                @if (Auth::check())
                    @if($depart_interest)
                        <div class="col-md-6 col-xs-12">
                            <form class="interested" method="post" action="{{url('departs/'.$depart->id)}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <input type="hidden" name="depart_id" value="{{$depart->id}}">
                                <div class="form-group">
                                    <div class="input-group">
                                        <button class="btn btn-default" type="submit">
                                            <i class="fas fa-trash" style="color: #ffda44"></i>
                                            حذف من المفضله
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="col-md-6 col-xs-12">
                            <form class="interested" method="post" action="{{url('departs')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="depart_id" value="{{$depart->id}}">
                                <div class="form-group">
                                    <div class="input-group">
                                        <button class="btn btn-default" type="submit">
                                            <img src="{{url('front/images/add-to-favourites.png')}}">
                                            اضف الى المفضله
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif

                @endif

            </div>

            @if(count($depart->depart_series)>0)
                <div class="serieses">
                    <h3 class="text-center">
                        الحلقات
                    </h3>
                    <div class="slider-holder">
                        <div class="series_slider">
                            @foreach($depart->depart_series as $series)
                                @if($series->type == 0)
                                    <div>
                                        <iframe src="{{$series->url}}"
                                                frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>

                                        </iframe>

                                        <a href="{{url('series/'.$series->id)}}">
                                            التفاصيل
                                        </a>
                                    </div>
                                @elseif($series->type == 1)
                                    <div>
                                        <video controls class="section-background-video" style="min-width: 100%;
   width: 100%">
                                            <source src="{{url('uploads/videos/'.$series->upload_url)}}">
                                        </video>

                                        <a href="{{url('series/'.$series->id)}}">
                                            التفاصيل
                                        </a>
                                    </div>
                                @endif

                            @endforeach
                        </div>
                    </div>
                </div>

                <hr>
            @endif

            @if(count($depart->depart_articles)>0)

                <div class="articles">
                    <h3 class="text-center">
                        المقالات
                    </h3>
                    <div class="slider-holder">
                        <div class="article_slider">
                            @foreach($depart->depart_articles as $article)
                                <div>
                                    <img src="{{url('front/images/article-icon.jpg')}}" class="img-responsive">

                                    <div class="content text-center">
                                        <h5 class="text-center">
                                            {{$article->name}}
                                        </h5>
                                        <p class="text-center">
                                            {!! html_entity_decode($article->description) !!}
                                        </p>
                                        <a href="{{url('depart_articles/'.$article->id)}}">
                                            التفاصيل
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <hr>

            @endif

            @if(count($depart->depart_books)>0)
                <div class="books">
                    <h3 class="text-center">
                        الكتب
                    </h3>
                    <div class="slider-holder">
                        <div class="article_slider">
                            @foreach($depart->depart_books as $book)
                                <div>
                                    <img src="{{url('front/images/article-icon.jpg')}}" class="img-responsive">

                                    <div class="content">
                                        <h5 class="text-center">
                                            {{$book->name}}
                                        </h5>
                                        <p class="text-center">
                                            {{$book->description}}
                                        </p>
                                        <a href="{{url('books/'.$book->id)}}">
                                            التفاصيل
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif




        </div>



    </div>

@endsection


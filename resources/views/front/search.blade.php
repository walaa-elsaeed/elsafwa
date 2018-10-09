@extends('front.layout')

@section('lay_out')

    <div class="depart_details">
        <div class="container">

            @if(count($blogs) == 0 && count($blog_articles) == 0 && count($departs) == 0 &&
            count($depart_articles) == 0 && count($depart_books) == 0 && count($news) == 0 &&
            count($users) == 0)

                <div class="row">
                    <p class="text-center">
                        لا يوجد نتائج لبحثك
                    </p>
                </div>
            @else
                <div class="row">
                    @if(count($blogs)>0)
                        <div class="blog">
                            <h2>
                                نتائج البحث فى البلوج :
                            </h2>
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

                    @endif

                </div>


                <div class="row">
                    @if(count($blog_articles)>0)
                        <div class="articles">
                            <h2>
                                نتائج البحث فى مقالات البلوجات :
                            </h2>
                            @foreach($blog_articles as $article)
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


                <div class="row">
                    @if(count($departs)>0)
                        <div class="departs">
                            <h2>
                                نتائج البحث فى الاقسام :
                            </h2>
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

                    @endif

                </div>


                <div class="row">
                    @if(count($depart_articles)>0)
                        <div class="departs">
                            <h2>
                                نتائج البحث فى مقالات الاقسام :
                            </h2>
                            @foreach($depart_articles as $article)
                                <div class="col-md-3 col-sm-6 col-xs-12 btm-margin">
                                    <div>
                                        <img src="{{url('front/images/article-icon.jpg')}}" class="img-responsive" style="width: 100%">

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



                <div class="row">
                    @if(count($depart_books)>0)
                        <div class="books">
                            <h2>
                                نتائج البحث فى كتب الاقسام :
                            </h2>
                            @foreach($depart_books as $book)
                                <div class="col-md-3 col-sm-6 col-xs-12 btm-margin">
                                    <div>
                                        <img src="{{url('front/images/article-icon.jpg')}}" class="img-responsive" style="width: 100%">

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
                                </div>
                            @endforeach
                        </div>

                    @endif

                </div>


                <div class="row">
                    @if(count($news)>0)
                        <div class="books">
                            <h2>
                                نتائج البحث فى الاخبار :
                            </h2>
                            @foreach($news as $new)
                                <div class="col-md-3 col-sm-6 col-xs-12 btm-margin">
                                    <div>
                                        <img src="{{url('uploads/'.$new->news_images[0]->img_url)}}" class="img-responsive" style="width: 100%">

                                        <div class="content">
                                            <h5 class="text-center">
                                                {{$new->name}}
                                            </h5>
                                            <p class="text-center">
                                                {!! html_entity_decode($new->description) !!}
                                            </p>
                                            <a href="{{url('news/'.$new->id)}}">
                                                التفاصيل
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @endif

                </div>


                <div class="row">
                    @if(count($users)>0)
                        <div class="books">
                            <h2>
                                نتائج البحث فى المستخدمين :
                            </h2>
                            @foreach($users as $user)
                                <div class="col-md-3 col-sm-6 col-xs-12 btm-margin">
                                    <div>
                                        <img src="{{url('uploads/'.$user->img_url)}}" class="img-responsive" style="width: 100%">

                                        <div class="content">
                                            <h5 class="text-center">
                                                {{$user->name}}
                                            </h5>
                                            <a href="{{url('users/'.$user->id)}}">
                                                التفاصيل
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @endif

                </div>
            @endif




        </div>



    </div>

@endsection


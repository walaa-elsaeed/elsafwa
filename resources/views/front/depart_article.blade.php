@extends('front.layout')

@section('lay_out')

    <div class="series_details">
        <div class="container">

            <div class="row">
                <div class="col-xs-12">
                    <div class="article-container">
                        {!! html_entity_decode($article->description) !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <p class="commenting">
                        <span class="num-font">{{count($article->comment)}}</span>
                        تعليقات
                    </p>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <p class="rating">
                        @for($i=0;$i<$article->rate;$i++)
                            <i class="fas fa-star"></i>
                        @endfor
                        @for($i;$i<5;$i++)
                            <i class="far fa-star"></i>
                        @endfor
                    </p>
                </div>
            </div>

            <hr>

            <div class="comments">
                @foreach($article->comment as $comment)

                    <div class="media">
                        <div class="media-left">
                            <a href="{{url('users/'.$comment->user_id)}}">
                                <div class="img-container">
                                    <img class="media-object img-responsive" src="{{url('uploads/' . $comment->user->img_url)}}" alt="profile_img">
                                </div>
                            </a>
                        </div>
                        <div class="media-body media-middle">
                            <h4 class="media-heading">{{$comment->user->name}}</h4>
                            <p>
                                {{$comment->comment}}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            @if (Auth::check())
                <div class="add_comment">
                    <form  method="post" action={{url ('depart_article_comment')}} enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="media">
                            <div class="media-left">
                                <a href="{{url('users/'.Auth::user()->id)}}">
                                    <div class="img-container">
                                        <img class="media-object img-responsive" src="{{url('uploads/'.Auth::user()->img_url)}}" alt="profile_img">
                                    </div>
                                </a>
                            </div>
                            <div class="media-body">
                                @if($alreadyRated == 0)
                                    <div class="col-xs-12">
                                        <div id="stars-default">
                                            <label>اضف تقييم </label>
                                            <input type=hidden name="rating"/>
                                        </div>
                                    </div>
                                @endif
                                <input type="hidden" name="depart_article" value="{{$article->id}}">
                                <textarea class="form-control" name="comment" rows="3"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-default submit-comment">
                            تعلييق
                        </button>
                    </form>
                </div>
            @endif


        </div>



    </div>

@endsection


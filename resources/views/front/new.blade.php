@extends('front.layout')

@section('lay_out')

    <div class="news">
        <div class="container new_details">

            <h2>
              {{$new->name}} :
            </h2>

            <div class="new-slider_container left_direction">
                <div class="new_slider">

                    @foreach($new->news_images as $img)
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
                            {!! html_entity_decode($new->description) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-offset-6 col-sm-6 col-xs-12">
                        <p class="commenting">
                            <span class="num-font">{{count($new->news_comments)}}</span>
                            تعليقات
                        </p>
                    </div>
                </div>

                <hr>

                <div class="comments">
                    @foreach($new->news_comments as $comment)

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
                        <form  method="post" action={{url ('news_comment')}} enctype="multipart/form-data">
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
                                    <input type="hidden" name="new" value="{{$new->id}}">
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



    </div>
@endsection


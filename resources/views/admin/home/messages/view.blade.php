@extends('layouts.app')


@section('content')
    <div class="row" style="padding-top: 6%">
        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">
                        رساله من :
                        <a href="mailto:{{$message->mail}}">
                             {{$message->mail}}
                        </a>

                    </h3>
                </div>

                <div class="box-body">
                    <p>
                        {{$message->message}}
                    </p>

                    <p>
                    <h4> تم الارسال فى : </h4>
                    {{$message-> created_at}}
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection



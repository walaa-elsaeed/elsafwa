<!DOCTYPE html>
<html lang="en">
<head>
    @include('front.common.heading')
    <span style="display: none">;</span>
    @include('sweet::alert')
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl7gZbf_aXumi-xEIr2U6Df9aWqO92fx8&callback=initialize&libraries=places">
    </script>
</head>

<body>


@if($status = session::get('status'))
    <div class="alert alert-info">
        {{$status}}
    </div>
@endif
<!-- Navigation area -->
@include('front.common.nav')
<!-- Navigation area end -->

<!-- SLIDER AREA -->
<div class="top-slider">
    <ul class="tournslider">

        @foreach($header_slides as $header_slide)
            <li>
                <img
                        src="{{url ('uploads')}}/{{$header_slide->img_url}}"
                        style="width: 100%"

                >
            </li>
        @endforeach

    </ul>
</div>


<div class="tourn-info">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-xs-12">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object img-responsive" src="{{url ('uploads')}}/{{$tourn->img_url}}">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            {{$tourn->name}}
                        </h4>
                    </div>
                </div>
                <div class="tourn-desc">
                    <p>
                        {{$tourn->description}}
                    </p>

                </div>

            </div>
            <div class="col-md-5 col-xs-12">
                <ul class="ads-slider">
                    @foreach($adds as $add)
                        @if($add->type == 0)
                            <li>
                                <img  class="img-responsive" src="{{url ('uploads')}}/{{$add->img_url}}">
                            </li>
                        @else
                            <li>
                                <iframe src="{{$add->src}}"></iframe>
                            </li>
                        @endif

                    @endforeach




                </ul>
            </div>
        </div>
    </div>
</div>

<div class="rules">
    <div class="container">

        <h2 class="tit">
            <span class="right-color"></span>
            {{ __('strings.tourn_phases')}}
        </h2>

        <br>

        <p class="phase">
            {{ __('strings.Phase_1')}}
        </p>

        <ul>
            @foreach($rules as $rule)
                <li>
                    {{$rule->text}}
                </li>
            @endforeach
        </ul>

        <p class="phase">
            {{ __('strings.Phase_2')}}
        </p>

        <ul>
            @foreach($rules1 as $rule1)
                <li>
                    {{$rule1->text}}
                </li>
            @endforeach
        </ul>

        <p class="phase">
            {{ __('strings.Phase_3')}}
        </p>

        <ul>
            @foreach($rules2 as $rule2)
                <li>
                    {{$rule2->text}}
                </li>
            @endforeach
        </ul>
    </div>
</div>


<div class="sponser-area">
    <h2 class="text-center">
        <span class="bg"></span>
        <span class="text">
           {{ __('strings.Partners')}}
        </span>
    </h2>

    <div class="container">
        <div class="row">
            <div class="sponser-slider">

                @foreach($partners as $partner)
                    <div class="text-center">
                        <img  src="{{url ('uploads')}}/{{$partner->img_url}}" class="img-responsive">
                    </div>
                @endforeach

            </div>
        </div>
    </div>

</div>

<!-- SLIDER AREA end -->
<!--Footer-->
@include('front.common.footer')

<!--Footer-->

@include('front.common.modals')

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
@include('front.common.scripts')


</body>
</html>


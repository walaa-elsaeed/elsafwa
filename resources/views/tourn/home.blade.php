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
<style>
    #cyber-card .col-md-4.col-xs-6
    {
        height: 120px!important;
    }
</style>

<script>
    function ListTourn(){
        var zone = $("#place").val();
        var state = $('#status').val();
        if(zone == undefined){
            zone = 0;
        }
        if(state == undefined){
            state = 2;
        }

        /*console.log("zone"+zone);*/
        var url = '{{url("ajaxcyber")}}';
        url +='/'+zone+'/'+state;
        /*console.log("url"+url);*/

        $.ajax({
            url: url,
            type: 'get',
            data: {
            },
            success: function (data) {
                var d = JSON.parse(data);
                $("#cyber-card").html(d.htmlString);
            },
            failure: function(e){

            },
            complete: function () {

            }
        });

    }
</script>

<script>
    $(function () {
        ListTourn();
    });
</script>

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

                    <a href="{{url('rules&regulations')}}">
                        {{ __('strings.rules_regulations')}}
                        @if(App::isLocale('en'))
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                        @endif

                    </a>
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



<div class="rank-holder">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-7 col-xs-12">
                <img src="{{url('img/coca-cola.png')}}" class="img-responsive">
            </div>
            <div class="col-sm-5 col-xs-12">
                <p class="rank">
                    {{ __('strings.rank')}}
                    @if (Auth::user()->joined == 1)
                        <span>
                            {{$userRanking->rank}}
                        </span>
                    @endif
                </p>
            </div>
        </div>
        <div class="row top-10">
            <div class="slashed">
            </div>
            <div class="ten-area">
                <div class="cont">
                    {{--<p>Top 10</p>--}}
                    <img class="img-responsive" src="{{url('img/top-10.png')}}" style="width: auto!important">
                </div>
                <div class="imgs">


                    @if(count($topTen = array_slice($ranks,0,10)) > 0)
                        @foreach($topTen = array_slice($ranks,0,10) as $top)
                            <div class="bundle">
                                <div class="img-circle">
                                    <a href="">
                                        <img src="{{url('uploads/' . $top->img_url)}}" class="img-responsive">
                                    </a>

                                </div>

                            </div>
                        @endforeach
                    @endif


                    {{--<div class="bundle">
                        <div class="img-circle">
                            <img src="{{url('img/top-10-img-2.jpg')}}">
                        </div>

                    </div>
                    <div class="bundle">
                        <div class="img-circle">
                            <img src="{{url('img/top-10-img-3.jpg')}}">
                        </div>

                    </div>
                    <div class="bundle">
                        <div class="img-circle">
                            <img src="{{url('img/top-10-img-4.jpg')}}">
                        </div>

                    </div>
                    <div class="bundle">
                        <div class="img-circle">
                            <img src="{{url('img/top-10-img-5.jpg')}}">
                        </div>

                    </div>
                    <div class="bundle">
                        <div class="img-circle">
                            <img src="{{url('img/top-10-img-6.jpg')}}">
                        </div>

                    </div>
                    <div class="bundle">
                        <div class="img-circle">
                            <img src="{{url('img/top-10-img-7.jpg')}}">
                        </div>

                    </div>
                    <div class="bundle">
                        <div class="img-circle">
                            <img src="{{url('img/top-10-img-8.jpg')}}">
                        </div>

                    </div>
                    <div class="bundle">
                        <div class="img-circle">
                            <img src="{{url('img/top-10-img-9.jpg')}}">
                        </div>

                    </div>
                    <div class="bundle">
                        <div class="img-circle">
                            <img src="{{url('img/top-10-img-10.jpg')}}">
                        </div>

                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tabs-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-xs-12">
                <div class="tour-profile text-center">
                    <img class="media-object img-circle" src="{{url('uploads/' . Auth::user()->img_url)}}">
                </div>

                <div class="profile-info">
                    <h4 class="text-center">
                        {{ __('strings.personal_info')}}
                    </h4>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-5">
                                <p class="tit">
                                    {{ __('strings.user_name')}}
                                </p>
                            </div>
                            <div class="col-xs-7">
                                <p class="desci">
                                    {{Auth::user()->user_name}}
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                <p class="tit">
                                    {{ __('strings.join_date')}}
                                </p>
                            </div>
                            <div class="col-xs-7">
                                <p class="desci">

                                    {{Date('Y-m-d',strtotime(Auth::user()->created_at))}}
                                </p>
                            </div>
                        </div>

                        <div class="row ranking">
                            <div class="col-xs-5">
                                <p class="text-center">
                                    {{ __('strings.el_rank')}}
                                </p>
                            </div>
                            <div class="col-xs-7">
                                @if (Auth::user()->joined == 1)
                                    <p class="text-center">
                                        {{$userRanking->rank}}
                                    </p>
                                @endif
                            </div>
                        </div>


                        <div class="result">
                            <div class="row">
                                <div class="col-xs-5">
                                    <p>
                                        {{ __('strings.played')}}
                                    </p>
                                </div>
                                <div class="col-xs-7">
                                    <p class="pull-right">
                                        {{Auth::user()->score['num_of_matches']}}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-5">
                                    <p>
                                        {{ __('strings.win')}}
                                    </p>
                                </div>

                                <div class="col-xs-7">
                                    <p class="win pull-right">
                                        {{Auth::user()->score['win']}}
                                    </p>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-5">
                                    <p>
                                        {{ __('strings.lost')}}
                                    </p>
                                </div>
                                <div class="col-xs-7">
                                    <p class="lost pull-right">
                                        {{Auth::user()->score['lose']}}
                                    </p>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-xs-5">
                                    <p>
                                        {{ __('strings.draw')}}
                                    </p>
                                </div>
                                <div class="col-xs-7">
                                    <p class="draw pull-right">
                                        {{Auth::user()->score['draw']}}
                                    </p>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-xs-5">
                                    <p>
                                        {{ __('strings.gd')}}
                                    </p>
                                </div>
                                <div class="col-xs-7">
                                    <p class="pull-right">
                                        {{Auth::user()->score['g_d']}}
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-5">
                                    <p>
                                        {{ __('strings.points')}}
                                    </p>
                                </div>
                                <div class="col-xs-7">
                                    <p class="pull-right">
                                        {{Auth::user()->score['points']}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="point-system">
                    <h4 class="text-center">
                        {{ __('strings.Points_System')}}
                    </h4>

                    <div class="container-fluid">

                        <div class="result">

                            <div class="row">
                                <div class="col-xs-9">
                                    <p>
                                        {{ __('strings.p_win')}}
                                    </p>
                                </div>

                                <div class="col-xs-3">
                                    <p class="win pull-right">
                                        5
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-9">
                                    <p>
                                        {{ __('strings.p_Lose')}}
                                    </p>
                                </div>
                                <div class="col-xs-3">
                                    <p class="lost pull-right">
                                        1
                                    </p>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-xs-9">
                                    <p>
                                        {{ __('strings.p_Draw')}}
                                    </p>
                                </div>
                                <div class="col-xs-3">
                                    <p class="draw pull-right">
                                        2
                                    </p>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-xs-9">
                                    <p>
                                        {{ __('strings.p_over40')}}
                                    </p>
                                </div>
                                <div class="col-xs-3">
                                    <p class="draw pull-right">
                                        0
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="match-system">
                    <h4 class="text-center">
                        match System
                    </h4>

                    <div class="container-fluid">

                        <div class="result">

                            <div class="row">
                                <div class="col-xs-5">
                                    <p>
                                        Win
                                    </p>
                                </div>

                                <div class="col-xs-7">
                                    <p class="win pull-right">
                                        15
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-5">
                                    <p>
                                        Lost
                                    </p>
                                </div>
                                <div class="col-xs-7">
                                    <p class="lost pull-right">
                                        10
                                    </p>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-xs-5">
                                    <p>
                                        Draw
                                    </p>
                                </div>
                                <div class="col-xs-7">
                                    <p class="draw pull-right">
                                        2
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-9 col-xs-12">
                <div class="tabs">
                    <ul class="nav nav-tabs">
                        <li class="active point"><a href="#tab1" data-toggle="tab" class="rank-seeker">{{ __('strings.leaderboard')}}</a></li>
                        <li class="cyber"><a href="#tab2" data-toggle="tab">{{ __('strings.cybers_List')}}</a></li>
                        <li class="match"><a href="#tab3" data-toggle="tab">
                                {{ __('strings.my_matches')}} <span class="count-noti">{{Auth::user()->score['num_of_matches']}}</span>
                            </a></li>
                        <li class="guide"><a href="#tab4" data-toggle="tab">{{ __('strings.gamer_Guide')}}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class="rank-table">
                                <table>
                                    <tr class="rank-head hidden-xs">
                                        <th>
                                            {{ __('strings.el_rank')}}
                                        </th>
                                        <th>
                                            {{ __('strings.user_name')}}
                                        </th>
                                        <th>
                                            {{ __('strings.played')}}
                                        </th>
                                        <th>
                                            {{ __('strings.win')}}
                                        </th>
                                        <th>
                                            {{ __('strings.lost')}}
                                        </th>
                                        <th>
                                            {{ __('strings.draw')}}
                                        </th>
                                        <th>
                                            {{ __('strings.gd')}}
                                        </th>
                                        <th>
                                            {{ __('strings.points')}}
                                        </th>
                                    </tr>
                                    <tr class="rank-head visible-xs">
                                        <th>
                                            {{ __('strings.el_rank-xs')}}
                                        </th>
                                        <th>
                                            {{ __('strings.user_name-xs')}}
                                        </th>
                                        <th>
                                            {{ __('strings.played-xs')}}
                                        </th>
                                        <th>
                                            {{ __('strings.win-xs')}}
                                        </th>
                                        <th>
                                            {{ __('strings.lost-xs')}}
                                        </th>
                                        <th>
                                            {{ __('strings.draw-xs')}}
                                        </th>
                                        <th>
                                            {{ __('strings.gd-xs')}}
                                        </th>
                                        <th>
                                            {{ __('strings.points-xs')}}
                                        </th>
                                    </tr>
                                    <tr></tr>
                                    @foreach($ranks_cut = array_slice($ranks,0,1) as $rank_cut)
                                        <tr class="rank-elemet" style="opacity:0;">
                                            <td>
                                                <div class="rank-num">
                                                    {{$rank_cut->rank}}
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('uploads/' . $rank_cut->img_url)}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                {{$rank_cut->user_name}}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    {{$rank_cut->num_of_matches}}
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    {{$rank_cut->win}}
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    {{$rank_cut->lose}}
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    {{$rank_cut->draw}}
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    {{$rank_cut->g_d}}
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    {{$rank_cut->points}}
                                                </span>
                                                </div>

                                            </td>

                                        </tr>
                                    @endforeach

                                </table>
                                <div class="scrollable">
                                    <table style="margin-top: -30px">
                                        <tr class="rank-head hidden-xs" style="opacity:0;">
                                            <th>
                                                {{ __('strings.el_rank')}}
                                            </th>
                                            <th>
                                                {{ __('strings.user_name')}}
                                            </th>
                                            <th>
                                                {{ __('strings.played')}}
                                            </th>
                                            <th>
                                                {{ __('strings.win')}}
                                            </th>
                                            <th>
                                                {{ __('strings.lost')}}
                                            </th>
                                            <th>
                                                {{ __('strings.draw')}}
                                            </th>
                                            <th>
                                                {{ __('strings.gd')}}
                                            </th>
                                            <th>
                                                {{ __('strings.points')}}
                                            </th>
                                        </tr>
                                        <tr class="rank-head visible-xs" style="opacity:0;">
                                            <th>
                                                {{ __('strings.el_rank-xs')}}
                                            </th>
                                            <th>
                                                {{ __('strings.user_name-xs')}}
                                            </th>
                                            <th>
                                                {{ __('strings.played-xs')}}
                                            </th>
                                            <th>
                                                {{ __('strings.win-xs')}}
                                            </th>
                                            <th>
                                                {{ __('strings.lost-xs')}}
                                            </th>
                                            <th>
                                                {{ __('strings.draw-xs')}}
                                            </th>
                                            <th>
                                                {{ __('strings.gd-xs')}}
                                            </th>
                                            <th>
                                                {{ __('strings.points-xs')}}
                                            </th>
                                        </tr>
                                        <tr></tr>

                                        @foreach($ranks as $rank)
                                            @if($rank->user_id == Auth::user()->id)
                                                <tr class="current" id="8">
                                                    <td style="width: 10%;">
                                                        <div class="rank-num">
                                                            {{$rank->rank}}
                                                        </div>

                                                    </td>

                                                    <td style="width: 30%;">
                                                        <div class="rank-content first-cont">
                                                            <div class="media">
                                                                <div class="media-left">
                                                                    <a href="">
                                                                        <img class="media-object img-responsive" src="{{url('uploads/' . $rank->img_url)}}">
                                                                    </a>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h5>
                                                                        {{$rank->user_name}}
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td style="width: 10%;">
                                                        <div class="rank-content text-center">
                                                <span>
                                                    {{$rank->num_of_matches}}
                                                </span>
                                                        </div>
                                                    </td>

                                                    <td style="width: 10%;">
                                                        <div class="rank-content text-center">
                                                <span class="win">
                                                    {{$rank->win}}
                                                </span>
                                                        </div>
                                                    </td>

                                                    <td style="width: 10%;">
                                                        <div class="rank-content text-center">
                                                <span class="lose">
                                                    {{$rank->lose}}
                                                </span>
                                                        </div>

                                                    </td>

                                                    <td style="width: 10%;">
                                                        <div class="rank-content text-center">
                                                <span class="draw">
                                                    {{$rank->draw}}
                                                </span>
                                                        </div>
                                                    </td>

                                                    <td style="width: 10%;">
                                                        <div class="rank-content text-center">
                                                <span>
                                                    {{$rank->g_d}}
                                                </span>
                                                        </div>

                                                    </td>

                                                    <td style="width: 10%;">
                                                        <div class="rank-content last-cont text-center">
                                                <span>
                                                    {{$rank->points}}
                                                </span>
                                                        </div>

                                                    </td>


                                                </tr>
                                            @else
                                                <tr class="rank-elemet">
                                                    <td style="width: 10%;">
                                                        <div class="rank-num">
                                                            {{$rank->rank}}
                                                        </div>

                                                    </td>

                                                    <td style="width: 30%;">
                                                        <div class="rank-content first-cont">
                                                            <div class="media">
                                                                <div class="media-left">
                                                                    <a href="" class="rank-color">
                                                                        <img class="media-object img-responsive" src="{{url('uploads/' . $rank->img_url)}}">
                                                                    </a>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h5>
                                                                        {{$rank->user_name}}
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td style="width: 10%;">
                                                        <div class="rank-content text-center">
                                                <span>
                                                    {{$rank->num_of_matches}}
                                                </span>
                                                        </div>
                                                    </td>

                                                    <td style="width: 10%;">
                                                        <div class="rank-content text-center">
                                                <span class="win">
                                                    {{$rank->win}}
                                                </span>
                                                        </div>
                                                    </td>

                                                    <td style="width: 10%;">
                                                        <div class="rank-content text-center">
                                                <span class="lose">
                                                    {{$rank->lose}}
                                                </span>
                                                        </div>

                                                    </td>

                                                    <td style="width: 10%;">
                                                        <div class="rank-content text-center">
                                                <span class="draw">
                                                    {{$rank->draw}}
                                                </span>
                                                        </div>
                                                    </td>

                                                    <td style="width: 10%;">
                                                        <div class="rank-content text-center">
                                                <span>
                                                    {{$rank->g_d}}
                                                </span>
                                                        </div>

                                                    </td>

                                                    <td style="width: 10%;">
                                                        <div class="rank-content last-cont text-center">
                                                <span>
                                                    {{$rank->points}}
                                                </span>
                                                        </div>

                                                    </td>


                                                </tr>
                                            @endif
                                        @endforeach


                                        {{--<tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    2
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    3
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    4
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    5
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    6
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    7
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="current" id="8">
                                            <td>
                                                <div class="rank-num">
                                                    8
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    9
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    10
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>


                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    8
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    9
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    10
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>


                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    8
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    9
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    10
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>




                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    8
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    9
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    10
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>


                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    8
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    9
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    10
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    8
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    9
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    10
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    8
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    9
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    10
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr >

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    8
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    9
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr class="rank-elemet">
                                            <td>
                                                <div class="rank-num">
                                                    10
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content first-cont">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="" class="rank-color">
                                                                <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>
                                                                Juan Crawford
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    25
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="win">
                                                    15
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="lose">
                                                    10
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span class="draw">
                                                    2
                                                </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="rank-content text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="rank-content last-cont text-center">
                                                <span>
                                                    2
                                                </span>
                                                </div>

                                            </td>


                                        </tr>--}}


                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="cybers-table">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="materialSelect inline empty ">
                                            <ul class="select" >
                                                <input type="hidden" name="place" id="place" value="0">
                                                <li data-selected="true">{{ __('strings.zone')}}</li>
                                                @foreach($zones as $zone)
                                                    <li data-value="0" value="{{$zone->id}}">{{$zone->name}}</li>
                                                @endforeach
                                            </ul>
                                            <div class="message">Please select something</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="materialSelect inline empty pull-right">
                                            <ul class="select" >
                                                <input type="hidden" name="status" id="status" value="2">
                                                <li data-selected="true">{{ __('strings.status')}}</li>

                                                <li data-value="0" value="0">{{ __('strings.joined_cyber')}}</li>
                                                <li data-value="0" value="1">{{ __('strings.out_cyber')}}</li>
                                            </ul>
                                            <div class="message">Please select something</div>
                                        </div>
                                    </div>
                                </div>


                                <div class="scrollable">
                                    <div id="cyber-card">
                                        @foreach($tourn_cybers as $tourn_cyber)
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="cyber-item">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="{{url('cyber/'.$tourn_cyber->id)}}">
                                                                <img class="media-object img-responsive" src="{{url('uploads/'.$tourn_cyber->cyberImg[0]->img_url)}}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            @if($tourn_cyber->tourn_cyber_status() == 0)
                                                                <h5>
                                                                    {{$tourn_cyber->name}}
                                                                </h5>
                                                                <p class="rate">
                                                                    @for($i=0;$i<$tourn_cyber->tourn_rate();$i++)
                                                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                                                    @endfor
                                                                    @for($i;$i<5;$i++)
                                                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                                    @endfor
                                                                    <span>({{$tourn_cyber->count_tourn_rates()}})</span>
                                                                </p>

                                                                <p class="add">
                                                                    {{$tourn_cyber->address}}
                                                                    <br>
                                                                    {{$tourn_cyber->phone}}
                                                                </p>
                                                            @elseif($tourn_cyber->tourn_cyber_status() == 1)
                                                                <h5 class="cyber-gray">
                                                                    {{$tourn_cyber->name}}
                                                                </h5>
                                                                <p class="block-text">
                                                                    {{ __('strings.out_cyber')}}
                                                                </p>
                                                            @endif


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <div class="matches-table">
                                <table>
                                    <tr class="match-head">
                                        <th>
                                            {{ __('strings.match')}}
                                        </th>
                                        <th>
                                            {{ __('strings.vs')}}
                                        </th>
                                        <th>
                                            {{ __('strings.res')}}
                                        </th>
                                        <th>
                                            {{ __('strings.res')}}
                                        </th>
                                        <th>
                                            {{ __('strings.cyber')}}
                                        </th>
                                        <th>
                                            {{ __('strings.rate')}}
                                        </th>
                                    </tr>
                                    <tr></tr>
                                    <tr class="match-elemet" style="opacity:0;">
                                        <td>
                                            <div class="match-date">
                                                11-06
                                            </div>

                                        </td>

                                        <td>
                                            <div class="match-content first-cont">
                                                <div class="media">
                                                    <div class="media-left hidden-xs">
                                                        <a href="" class="rank-color">
                                                            <img class="media-object img-responsive" src="{{url('img/top-10-img.jpg')}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5>
                                                            Admin
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="match-content text-center">
                                                <span class="win hidden-xs">
                                                    Lose
                                                </span>
                                                <span class="win visible-xs">
                                                    L
                                                </span>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="match-content text-center">
                                                <span >
                                                    5
                                                </span>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="match-content  cyber-con text-center">
                                                <p class="cyber-name">
                                                    Cyber
                                                    <span class="rate">
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                            <span>
                                                                (2)
                                                            </span>
                                                        </span>
                                                </p>
                                                <a class="report" data-toggle="modal" data-target="#reportModal">
                                                    <span class="info">!</span>
                                                    report
                                                </a>
                                            </div>
                                        </td>



                                        <td>
                                            <div class="match-content last-cont text-center">
                                                <form>
                                                    <div id="stars-default-no">
                                                        <input type=hidden name="rating"/>
                                                    </div>

                                                    <button class="btn btn-default" type="submit">
                                                        {{ __('strings.add')}}
                                                    </button>
                                                </form>

                                            </div>

                                        </td>


                                    </tr>
                                </table>


                                <div class="scrollable">
                                    <table style="margin-top: -40px">
                                        <tr class="match-head" style="opacity:0;">
                                            <th>
                                                Match
                                            </th>
                                            <th>
                                                VS
                                            </th>
                                            <th>
                                                Res
                                            </th>
                                            <th>
                                                Pts
                                            </th>
                                            <th>
                                                Cyber
                                            </th>
                                            <th>
                                                Rate
                                            </th>
                                        </tr>
                                        <tr></tr>

                                        @foreach($matchs as $match)
                                            <tr class="match-elemet">
                                                <td>
                                                    <div class="match-date hidden-xs">
                                                        {{Date('Y-m-d',strtotime($match->created_at))}}
                                                    </div>

                                                    <div class="match-date visible-xs">
                                                        {{Date('m-d',strtotime($match->created_at))}}
                                                    </div>

                                                </td>

                                                <td>
                                                    <div class="match-content first-cont">
                                                        <div class="media">
                                                            <div class="media-left hidden-xs">
                                                                @if(Auth::user()->id == $match->player1_id )
                                                                <a href="" class="rank-color">
                                                                    <img class="media-object img-responsive" src="{{url('uploads/' . $match->player2['img_url'])}}">
                                                                </a>
                                                                @elseif(Auth::user()->id == $match->player2_id )
                                                                    <a href="" class="rank-color">
                                                                        <img class="media-object img-responsive" src="{{url('uploads/' . $match->player1['img_url'])}}">
                                                                    </a>
                                                                @endif
                                                            </div>
                                                            <div class="media-body">
                                                                <h5>
                                                                    @if(Auth::user()->id == $match->player1_id )
                                                                        {{$match->player2['user_name']}}
                                                                    @elseif(Auth::user()->id == $match->player2_id )
                                                                        {{$match->player1['user_name']}}
                                                                    @endif
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="match-content text-center">

                                                    @if(Auth::user()->id == $match->player1_id )
                                                        @if($match->score1 > $match->score2)
                                                            <span class="win hidden-xs">
                                                                {{'Win'}}
                                                            </span>
                                                                <span class="win visible-xs">
                                                                {{'W'}}
                                                            </span>
                                                        @elseif($match->score1 < $match->score2)
                                                            <span class="lose hidden-xs">
                                                                {{'Lose'}}
                                                            </span>

                                                                <span class="lose visible-xs">
                                                                {{'L'}}
                                                            </span>

                                                        @else
                                                            <span class="draw hidden-xs">
                                                                {{'draw'}}
                                                            </span>

                                                            <span class="draw visible-xs">
                                                                {{'d'}}
                                                            </span>
                                                        @endif

                                                        @elseif(Auth::user()->id == $match->player2_id)
                                                            @if($match->score2 > $match->score1)
                                                                <span class="win hidden-xs">
                                                                {{'Win'}}
                                                            </span>

                                                                <span class="win visible-xs">
                                                                {{'W'}}
                                                            </span>
                                                            @elseif($match->score2 < $match->score1)
                                                                <span class="lose hidden-xs">
                                                                {{'Lose'}}
                                                            </span>

                                                                <span class="lose visible-xs">
                                                                {{'L'}}
                                                            </span>

                                                            @else
                                                                <span class="draw hidden-xs">
                                                                {{'draw'}}
                                                            </span>

                                                                <span class="draw visible-xs">
                                                                {{'d'}}
                                                            </span>
                                                            @endif

                                                        @endif

                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="match-content text-center">
                                                <span >
                                                    @if(Auth::user()->id == $match->player1_id )
                                                        @if($match->score1 > $match->score2)
                                                            <span class="win">
                                                                5
                                                            </span>
                                                        @elseif($match->score1 < $match->score2)
                                                            <span class="lose">
                                                                1
                                                            </span>

                                                        @else
                                                            <span class="draw">
                                                                2
                                                            </span>
                                                        @endif

                                                    @elseif(Auth::user()->id == $match->player2_id)
                                                        @if($match->score2 > $match->score1)
                                                            <span class="win">
                                                                5
                                                            </span>
                                                        @elseif($match->score2 < $match->score1)
                                                            <span class="lose">
                                                                1
                                                            </span>

                                                        @else
                                                            <span class="draw">
                                                                2
                                                            </span>
                                                        @endif

                                                    @endif
                                                </span>
                                                    </div>
                                                </td>

                                                <td>
                                                    @if(strtotime(Date('Y-m-d H:i')) >= strtotime(Date('Y-m-d H:i',strtotime("+ 24 hours",strtotime($match->created_at)))))
                                                        <div class="match-content text-center">
                                                            <span class="cyber-name" style="font-weight: lighter">
                                                            {{$match->cyber['name']}}
                                                                <span class="rate">

                                                            <span>
                                                                {{$match->cyber->tourn_rate()}}
                                                            </span>
                                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                        </span>
                                                        </span>
                                                        </div>
                                                    @else
                                                        <div class="match-content  cyber-con text-center">
                                                            <p class="cyber-name">
                                                                {{$match->cyber['name']}}
                                                                <span class="rate">
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                            <span>
                                                                ({{$match->cyber->tourn_rate()}})
                                                            </span>
                                                        </span>
                                                            </p>
                                                            <a class="report" data-toggle="modal" data-target="#report{{$match->id}}">
                                                                <span class="info">!</span>
                                                                report
                                                            </a>

                                                            <!--reportModal -->
                                                            <div class="modal fade" id="report{{$match->id}}" tabindex="-1" role="dialog" aria-labelledby="mysortModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="mysortModalLabel">Report Your Result !!</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!--Selectors Section-->
                                                                            <div class="row">
                                                                                @if (count($errors) > 0)
                                                                                    <div class="alert alert-danger">
                                                                                        <strong>Whoops!</strong> There is a problem with Your input:
                                                                                        <br><br>
                                                                                        <ul>
                                                                                            @foreach ($errors->all() as $error)
                                                                                                <li>{{ $error }}</li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                @endif


                                                                                <form class="cyber_form" method="post" action="{{url('store_report')}}" enctype="multipart/form-data">
                                                                                    {{csrf_field()}}

                                                                                    <input type="hidden" name="match" value="{{$match->id}}">

                                                                                    <div class="col-xs-12 cus-12">
                                                                                        <div class="form-group">
                                                                                            <textarea class="form-control report-text" placeholder="type your report" name="report" rows="5"></textarea>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-xs-12 text-center reg">
                                                                                        <button class="btn btn-default add-stuff" type="submit">
                                                                                            <img src="{{url('img/area-border.png')}}" class="img-responsive">

                                                                                            <span>
                                        {{ __('strings.submit')}}
                                    </span>

                                                                                            <img src="{{url('img/area-border.png')}}" class="img-responsive">
                                                                                        </button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endif

                                                </td>



                                                <td>
                                                    <div class="match-content last-cont text-center">

                                                        @if($match->user_rated() == false)
                                                            <form method="post" action={{url ('match_rate')}} enctype="multipart/form-data">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="match" value="{{$match->id}}">
                                                                <input type="hidden" name="user" value="{{Auth::user()->id}}">

                                                                <div id="stars-default{{$match->id}}">
                                                                    <input type=hidden name="rating"/>
                                                                </div>

                                                                <script>
                                                                    $(function ()
                                                                        {
                                                                            $("#stars-default{{$match->id}}").rating();
                                                                        }
                                                                    );

                                                                </script>

                                                                <button class="btn btn-default" type="submit">
                                                                    {{ __('strings.add')}}
                                                                </button>
                                                            </form>
                                                        @endif

                                                    </div>

                                                </td>


                                            </tr>
                                        @endforeach

                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <div class="scrollable">
                                <ol class="guide_table">
                                    @foreach($guides as $guide)
                                        <li>
                                            {{$guide->text}}
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
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


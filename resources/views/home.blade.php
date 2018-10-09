@extends('layouts.app')


@section('content')
    <div class="row" style="padding: 20px 15px 0">
        <div class="col-xs-12">
            <div class="content-header">
                <h1>
                    لوحه التحكم
                    <small>من هنا يمكنك التحكم بكل شئ لموقع الصفوه للانتاج الفنى</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="">
                            <i class="fa fa-dashboard"></i>
                            الرئيسيه
                        </a>
                    </li>
                    <li class="active">
                        <a href="">
                            لوحه التحكم
                        </a>
                    </li>
                </ol>
            </div>
        </div>

    </div>

    {{--<div class="row" style="padding: 20px 15px 0">
        <div class="col-xs-12"  style="margin-bottom: 20px">
            <h1>
                المستخدمين :
            </h1>
        </div>
        <div class="col-md-6 col-xs-12">
            <!-- USERS LIST -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">احدث الاعضاء</h3>

                    <div class="box-tools pull-right">
                        <span class="label label-danger">8 New Members</span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">

                        @foreach($users->take(8) as $user)
                            <li>

                                <img src="{{url('uploads/'.$user->img_url)}}" alt="User Image" style="width: 112px;height: 112px">
                                <a class="users-list-name" href="#">{{$user->name}}</a>
                                <span class="users-list-date">{{Date('Y-m-d',strtotime($user->created_at))}}</span>

                            </li>
                        @endforeach
                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="{{url('members')}}" class="uppercase">View All Users --}}{{--({{ count($members) }})--}}{{--</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!--/.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-6 col-xs-12">

            <!-- TABLE: LATEST ORDERS -->
            --}}{{--<div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">احدث المشرفين</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mail</th>
                                </tr>
                            </thead>
                            <tbody>
                                --}}{{----}}{{--@foreach($admins->take(8) as $admin)
                                    <tr>
                                        <td><a href="">{{$admin->user_name}}</a></td>
                                        <td>{{$admin->email}}</td>

                                        @if($admin->user_type == 1)
                                            <td><span class="label label-success">{{'Admin'}}</span></td>
                                        @elseif($admin->user_type == 2)
                                            <td><span class="label label-warning">{{'Cyber Admin'}}</span></td>
                                        @elseif($admin->user_type == 3)
                                            <td><span class="label label-info">{{'Trade Admin'}}</span></td>
                                        @endif
                                    </tr>
                                @endforeach--}}{{----}}{{--
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="{{url('add_account')}}" class="btn btn-sm btn-info btn-flat pull-left">Add New Admin</a>
                    <a href="{{url('admins')}}" class="btn btn-sm btn-default btn-flat pull-right">View All Admins</a>
                </div>
                <!-- /.box-footer -->
            </div>--}}{{--
            <!-- /.box -->

        </div>

    </div>--}}
    <!-- /.col -->

    {{--<div class="row" style="padding: 20px 15px 0">
        <div class="col-xs-12"  style="margin-bottom: 20px">
            <h1>
                Tournament :
            </h1>
        </div>
        <div class="col-md-6 col-xs-12">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: url('{{url('img/photo1.jpg')}}') center center;">

                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{url('img/user3-128x128.png')}}" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">--}}{{--{{$players}}--}}{{--</h5>
                                <span class="description-text">Player</span>
                                <br>
                                <a href="{{url('players')}}" class="uppercase">
                                    View All Players
                                </a>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">--}}{{--{{$tourn_cybers}}--}}{{--</h5>
                                <span class="description-text">Cyber</span>
                                <br>
                                <a href="{{url('joined-list')}}" class="uppercase">
                                    View All Cybers
                                </a>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">--}}{{--{{$matches}}--}}{{--</h5>
                                <span class="description-text">Match</span>
                                <br>
                                <a href="{{url('matches-list')}}" class="uppercase">
                                    View All Matches
                                </a>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        <!-- /.col -->
    </div>--}}


    {{--<div class="row" style="padding: 20px 15px 0">
        <div class="col-xs-12"  style="margin-bottom: 20px">
            <h1>
                Home :
            </h1>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        --}}{{--{{$allslides}}--}}{{--
                    </h3>
                    <p>All Slides</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-browsers"></i>
                </div>
                <a class="small-box-footer" href="{{url('slider')}}">
                    More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        --}}{{--{{$allmarquees}}--}}{{--
                    </h3>
                    <p>All News</p>
                </div>
                <div class="icon">
                    <i class="ion ion-arrow-move"></i>
                </div>
                <a class="small-box-footer" href="{{url('marquee')}}">
                    More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>


        <div class="col-md-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        --}}{{--{{$allmsg}}--}}{{--
                    </h3>
                    <p>All Messages</p>
                </div>
                <div class="icon">
                    <i class="ion ion-email-unread"></i>
                </div>
                <a class="small-box-footer" href="{{url('messages')}}">
                    More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

    </div>--}}



    <div class="row" style="padding: 20px 15px 0">
        <div class="col-xs-12"  style="margin-bottom: 20px">
            <h1>
                الاقسام :
            </h1>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        {{$departs_count}}
                    </h3>
                    <p>كل الاقسام</p>
                </div>
                <div class="icon">
                    <i class="fa fa-th-large"></i>
                </div>
                <a class="small-box-footer" href="{{url('admin/departs')}}">
                    التفاصيل
                    <i class="fa fa-arrow-circle-left"></i>
                </a>
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        {{$departs_series_count}}
                    </h3>
                    <p>كل الحلقات</p>
                </div>
                <div class="icon">
                    <i class="fa fa-youtube-play"></i>
                </div>
                <a class="small-box-footer" href="{{url('admin/serieses')}}">
                    التفاصيل
                    <i class="fa fa-arrow-circle-left"></i>
                </a>
            </div>
        </div>


        <div class="col-md-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        {{$departs_articles_count}}
                    </h3>
                    <p>كل المقالات</p>
                </div>
                <div class="icon">
                    <i class="fa fa-file"></i>
                </div>
                <a class="small-box-footer" href="{{url('admin/articles')}}">
                    التفاصيل
                    <i class="fa fa-arrow-circle-left"></i>
                </a>
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        {{$departs_books_count}}
                    </h3>
                    <p>كل الكتب</p>
                </div>
                <div class="icon">
                    <i class="fa fa-book"></i>
                </div>
                <a class="small-box-footer" href="{{url('admin/books')}}">
                    التفاصيل
                    <i class="fa fa-arrow-circle-left"></i>
                </a>
            </div>
        </div>
    </div>



    <div class="row" style="padding: 20px 15px 0">
        <div class="col-xs-12"  style="margin-bottom: 20px">
            <h1>
                الاخبار :
            </h1>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        {{$news_count}}
                    </h3>
                    <p>كل الاخبار</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-notifications-none"></i>
                </div>
                <a class="small-box-footer" href="{{url('admin/news')}}">
                    التفاصيل
                    <i class="fa fa-arrow-circle-left"></i>
                </a>
            </div>
        </div>

    </div>


    <div class="row" style="padding: 0 15px 20px">
        <div class="col-xs-12"  style="margin-bottom: 20px">
            <h1>
                البلوج :
            </h1>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        {{$blogs_count}}
                    </h3>
                    <p>كل البلوجات</p>
                </div>
                <div class="icon">
                    <i class="fa fa-edit"></i>
                </div>
                <a class="small-box-footer" href="{{url('admin/blogs')}}">
                    التفاصيل
                    <i class="fa fa-arrow-circle-left"></i>
                </a>
            </div>
        </div>



        <div class="col-md-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        {{$departs_articles_count}}
                    </h3>
                    <p>كل المقالات</p>
                </div>
                <div class="icon">
                    <i class="fa fa-file"></i>
                </div>
                <a class="small-box-footer" href="{{url('admin/blog_articles')}}">
                    التفاصيل
                    <i class="fa fa-arrow-circle-left"></i>
                </a>
            </div>
        </div>



    </div>

@endsection

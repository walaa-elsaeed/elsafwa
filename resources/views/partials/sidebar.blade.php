@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/admin/home') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">لوحه التحكم</span>
                </a>
            </li>


            <li class="treeview">

                <a href="#">
                    <i class="ion ion-home" aria-hidden="true"></i>
                    <span class="title">الصفحه الرئيسيه</span>
                    <i class="fa fa-angle-left pull-left"></i>
                </a>

                <ul class="treeview-menu">

                    <li>
                        <a href="{{url('admin/homeslides')}}">
                            <i class="fa " aria-hidden="true"></i>
                            <span class="title">
                                الاسليدر
                            </span>
                            <span class="pull-left-container">
                                <span class="label label-primary pull-left">
                                    {{$departs_count}}
                                </span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('admin/homedetails')}}">
                            <i class="fa " aria-hidden="true"></i>
                            <span class="title">
                                التفاصيل
                            </span>

                        </a>
                    </li>
                    <li>
                        <a href="{{url('admin/messages')}}">
                            <i class="fa " aria-hidden="true"></i>
                            <span class="title">
                           الرسائل
                            </span>
                            <span class="pull-left-container">
                                <span class="label label-yellow pull-left">

                                </span>
                            </span>
                        </a>
                    </li>



                </ul>
            </li>



            <li class="treeview">

                <a href="#">
                    <i class="ion ion-home" aria-hidden="true"></i>
                    <span class="title">الاقسام</span>
                    <i class="fa fa-angle-left pull-left"></i>
                </a>

                <ul class="treeview-menu">

                    <li>
                        <a href="{{url('admin/departs')}}">
                            <i class="fa " aria-hidden="true"></i>
                            <span class="title">
                                كل الاقسام
                            </span>
                            <span class="pull-left-container">
                                <span class="label label-primary pull-left">
                                    {{$departs_count}}
                                </span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('admin/serieses')}}">
                            <i class="fa " aria-hidden="true"></i>
                            <span class="title">
                                كل الحلقات
                            </span>
                            <span class="pull-left-container">
                                <span class="label label-success pull-left">
                                    {{$departs_series_count}}
                                </span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('admin/articles')}}">
                            <i class="fa " aria-hidden="true"></i>
                            <span class="title">
                                كل المقالات
                            </span>
                            <span class="pull-left-container">
                                <span class="label label-yellow pull-left">
                                    {{$departs_articles_count}}
                                </span>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/books')}}">
                            <i class="fa " aria-hidden="true"></i>
                            <span class="title">
                                كل الكتب
                            </span>
                            <span class="pull-left-container">
                                <span class="label label-red pull-left">
                                    {{$departs_books_count}}
                                </span>
                            </span>
                        </a>
                    </li>


                </ul>
            </li>



            <li class="treeview">

                <a href="#">
                    <i class="ion ion-ios-game-controller-b" aria-hidden="true"></i>
                    <span class="title">الاخبار</span>
                    <i class="fa fa-angle-left pull-left"></i>
                </a>

                <ul class="treeview-menu">

                    <li>
                        <a href="{{url('admin/news')}}">
                            <i class="fa " aria-hidden="true"></i>
                            <span class="title">
                                كل الاخبار
                            </span>
                            <span class="pull-left-container">
                                <span class="label label-primary pull-left">
                                    {{$news_count}}
                                </span>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">

                <a href="#">
                    <i class="ion ion-android-notifications-none" aria-hidden="true"></i>
                    <span class="title">البلوج</span>
                    <i class="fa fa-angle-left pull-left"></i>
                </a>

                <ul class="treeview-menu">

                    <li>
                        <a href="{{url('admin/blogs')}}">
                            <i class="fa " aria-hidden="true"></i>
                            <span class="title">
                                كل البلوج
                            </span>
                            <span class="pull-left-container">
                                <span class="label label-primary pull-left">
                                    {{$blogs_count}}
                                </span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('admin/blog_articles')}}">
                            <i class="fa " aria-hidden="true"></i>
                            <span class="title">
                                كل المقالات
                            </span>
                            <span class="pull-left-container">
                                <span class="label label-yellow pull-left">
                                    {{$blogs_article_count}}
                                </span>
                            </span>
                        </a>
                    </li>

                </ul>
            </li>


            @can('users_manage')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.permissions.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.roles.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.users.title')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            {{--<li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">تغيير كلمه السر</span>
                </a>
            </li>--}}

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">تسجيل الخروج</span>
                </a>
            </li>
        </ul>
    </section>
</aside>



{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('global.logout')</button>
{!! Form::close() !!}

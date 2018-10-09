<!--Start Header Area-->
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <a href="{{url('/')}}">
                    <img src="{{url('front/images/logo.png')}}" class="img-responsive">
                </a>
            </div>
            <div class="col-md-2 col-xs-12">
                <div class="social">
                    <a href="{{$detail->facebook}}">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a href="{{$detail->twitter}}">
                        <i class="fab fa-twitter"></i>
                    </a>


                    <a href="{{$detail->youtube}}">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>

            </div>

            <div class="col-md-4 col-xs-12">
                <div class="search_form">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="بحث" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'بحث'" id="inputSearch">
                            <span class="input-group-addon" id="search">
                                <button class="btn btn-default" >
                                    <i class="fas fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="{{ Request::segment(1) === '/' ? 'active' : null }}">
                        <a href="{{ url('/' )}}" ></i> الرئيسية</a>
                    </li>

                    <li class="{{ Request::segment(1) === 'departs' ? 'active' : null }}">
                        <a href="{{url('departs')}}">الاقسام</a>
                    </li>
                    <li class="{{ Request::segment(1) === 'news' ? 'active' : null }}">
                        <a href="{{url('news')}}">اخبارنا</a>
                    </li>
                    <li class="{{ Request::segment(1) === 'contact' ? 'active' : null }}">
                        <a href="{{url('contact')}}">اتصل بنا</a></li>
                    <li class="{{ Request::segment(1) === 'who_we_are' ? 'active' : null }}">
                        <a href="{{url('who_we_are')}}">من نحن</a></li>
                    <li class="{{ Request::segment(1) === 'blogs' ? 'active' : null }}">
                        <a href="{{url('blogs')}}">البلوج</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        <li>
                            <a href="{{url('users/'.Auth::user()->id)}}" style="display: inline-block">{{Auth::user()->name}}</a>
                            <span style="color: white;font-size: 14px">{{'/'}}</span>
                            <a href="{{url('logout')}}" style="display: inline-block">خروج</a>
                        </li>
                    @else
                        <li><a href="{{url('users/create')}}">تسجيل الدخول</a></li>
                    @endif

                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
<!--end Header Area-->
<a  value="{{url('search')}}" id="loc" style="display: none;"></a>


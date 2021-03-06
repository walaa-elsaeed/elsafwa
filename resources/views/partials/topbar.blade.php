<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/admin/home') }}" class="logo"
       style="font-size: 16px;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
           <img src="{{url('img/logo-mini.png')}}" class="img-responsive"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
           <img src="{{url('img/logo-inline.png')}}" class="img-responsive"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>


       <div class="navbar-custom-menu">
            <ul class="nav navbar-nav" style="margin-left: 0">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"
                       style="padding-top: 15px;padding-bottom: 15px;line-height: 20px">
                        <img src="{{url('uploads/' . Auth::user()->img_url)}}" class="user-image" alt="">
                        <span class="hidden-xs"> {{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu user-drop">
                        <li class="user-header">
                            <img src="{{url('uploads/' . Auth::user()->img_url)}}" class="img-circle">
                            <p>
                                 {{Auth::user()->name}}
                            </p>
                        </li>

                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="#logout" onclick="$('#logout').submit();" class="btn btn-default btn-flat">
                                    Log out
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        

    </nav>
</header>

<script>
    $('.user').click(function () {
        $('.user-drop').toggle();
    });
</script>



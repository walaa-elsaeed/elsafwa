@extends('front.layout')

@section('lay_out')

    <div class="regitration">

        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="text-center">
                        انشاء حساب <span>او</span> تسجيل الدخول
                    </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <form class="contacts_form"  method="post" action="{{url('users')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="الاسم" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'الاسم'" required name="name">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="البريد الالكترونى" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'البريد الالكترونى'" required name="email">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="كلمه السر" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'كلمه السر'" required name="password">
                        </div>


                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="اعد كتابه كلمه السر" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'اعد كتابه كلمه السر'" required name="retype_password">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-default">انشاء</button>
                            <div class="clearfix"></div>
                        </div>

                    </form>
                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="form-group facebook_form">
                        <a href="{{url('login/facebook')}}" class="btn btn-default">
                            <i class="fab fa-facebook"></i>
                            تسجيل الدخول بالفيس بوك
                        </a>
                    </div>

                    <p class="text-center or">
                        او
                    </p>

                    <form class="contacts_form no-border" method="post" action="{{url('user_login')}}" enctype="multipart/form-data">

                        {{csrf_field()}}

                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="البريد الالكترونى" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'البريد الالكترونى'" name="email">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="كلمه السر" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'كلمه السر'" name="password">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-default">دخول</button>
                            <div class="clearfix"></div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


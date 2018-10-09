@extends('front.layout')

@section('lay_out')

    <div class="contact_us">
        <div class="map_container">
            <iframe src="{{$detail->location}}"
                    height="650" frameborder="0" style="border:0" allowfullscreen>

            </iframe>
        </div>

        <div class="container">
            <h2 class="text-center">
                تواصل معنا
            </h2>

            <div class="row">
                <div class="col-md-5 col-xs-12">
                    <form class="contacts_form" method="post" action="{{url('storecont')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="الاسم" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'الاسم'" required name="name">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="رقم الهاتف" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'رقم الهاتف'" required name="phone">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="البريد الالكترونى" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'البريد الالكترونى'" required name="email">
                        </div>
                        <div class="form-group">
                        <textarea class="form-control" rows="10" placeholder="الرساله" onfocus="this.placeholder = ''"
                                  onblur="this.placeholder = 'الرساله'" required name="message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">ارسال</button>
                    </form>
                </div>

                <div class="col-md-2 hidden-sm hidden-xs">
                    <div class="border">

                    </div>
                </div>

                <div class="col-md-5 col-xs-12">
                    <div class="social_holder">
                        <div class="v-align">
                            <p class="text-center">
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:info@i-DVinc.com">
                                    info@i-DVinc.com
                                </a>
                            </p>

                            <p class="text-center">
                                <i class="fas fa-phone"></i>
                                01089876543
                            </p>

                            <p class="text-center">
                                <a href="{{url($detail->facebook)}}" target="_blank">
                                    <i class="fab fa-facebook-f fa-2x"></i>
                                </a>

                                <a href="{{url($detail->twitter)}}" target="_blank">
                                    <i class="fab fa-twitter fa-2x"></i>
                                </a>

                                <a href="{{url($detail->youtube)}}" target="_blank">
                                    <i class="fab fa-youtube fa-2x"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


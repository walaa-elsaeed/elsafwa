<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <h4>
                    العنوان :
                </h4>
                <p>
                 {{$detail->address}}
                </p>

                <div class="map_container">
                    <iframe src="{{$detail->location}}"
                            height="450" frameborder="0" style="border:0" allowfullscreen>

                    </iframe>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <h4>
                    تواصل معنا :
                </h4>

                <form class="contact_form"  method="post" action="{{url('storemsg')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="البريد الالكترونى" onfocus="this.placeholder = ''"
                               onblur="this.placeholder = 'البريد الالكترونى'" required name="email">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="10" placeholder="الرساله" onfocus="this.placeholder = ''"
                                  onblur="this.placeholder = 'البريد الالكترونى'" required name="message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">ارسال</button>
                </form>
            </div>
        </div>

        <div class="row final_menu">
            <div class="col-xs-12">
                <ul class="list-unstyled list-inline text-center">
                    <li>
                        <a href="{{url('/')}}">الرئيسية</a>
                    </li>

                    <li>
                        <a href="{{url('departs')}}">الاقسام</a>
                    </li>

                    <li >
                        <a href="{{url('news')}}">اخبارنا</a>
                    </li>
                    <li>
                        <a href="{{url('contact')}}">اتصل بنا</a>
                    </li>
                    <li>
                        <a href="{{url('who_we_are')}}">من نحن</a>
                    </li>

                    <li>
                        <a href="{{url('blogs')}}">البلوج</a>
                    </li>


                </ul>
            </div>
        </div>
    </div>
</footer>
@extends('front.layout')

@section('lay_out')

    <div class="regitration">

        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="text-center">
تعديل الحساب الشخصى
                    </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <form class="contacts_form no-border"  method="post" action="{{url('users/'.$user->id)}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="form-group">
                            <input type="text" class="form-control"  name="name" value="{{$user->name}}">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" name="email" value="{{$user->email}}">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="*********" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = '*********'"  name="password">
                        </div>


                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="*********" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = '*********'"  name="retype_password">
                        </div>

                        <div class="form-group custom_img">
                            <input type="file"  class="upload-hidden" name="file" style="width: 100%!important;height: 100%!important;"  onchange="readURL2(this);">
                            <div class="form-group form-ar">
                                <img id="profile-img-ar" src="{{url('uploads/'.$user->img_url)}}" alt=""
                                     style="width: 300px;border: 1px solid #3030e1"/>

                            </div>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-default">تعديل</button>
                            <div class="clearfix"></div>
                        </div>


                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection


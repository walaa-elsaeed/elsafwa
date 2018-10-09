@extends('layouts.app')


@section('content')

    <div class="row" style="padding-top: 6%">
        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">
                        تعديل
                    </h3>
                </div>

                <form method="post" action="{{url('admin/homedetails/'.$detail->id)}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PUT')}}

                    <div class="box-body">

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">عن الصفوه *</label>
                                <textarea type="text" class="form-control" placeholder="عن الصفوه" name="description" rows="8" style="resize: none">{{$detail->description}}</textarea>
                            </div>
                        </div>


                        <div class="col-xs-12 cus-12">
                            <div class="form-group reli form-ar">
                                <label for="video">ارفع الفديو *</label>
                                <input type="file" class="upload-hidden file" name="video" style="width: 100%!important;height: 100%!important;" value="{{$detail->video}}" onchange="readURL3(this);">
                                <label id="video_name">{{$detail->video}}</label>
                            </div>
                        </div>

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">العنوان *</label>
                                <input type="text" class="form-control" placeholder="العنوان" name="address" style="width: 100%" value="{{ $detail->address }}">
                            </div>
                        </div>

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">الموقع على الخريطه *</label>
                                <input type="text" class="form-control" placeholder="https://www.google.com/maps/embed?pb" name="location" style="width: 100%"
                                       value="{{ $detail->location }}">
                            </div>
                        </div>

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">لينك الفيس بوك *</label>
                                <input type="text" class="form-control" placeholder="https://www.facebook.com/lorem" name="facebook" style="width: 100%"
                                       value="{{ $detail->facebook }}">
                            </div>
                        </div>

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">لينك تويتر *</label>
                                <input type="text" class="form-control" placeholder="https://twitter.com/lorem" name="twitter" style="width: 100%"
                                       value="{{ $detail->twitter }}">
                            </div>
                        </div>

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">لينك يو تيوب *</label>
                                <input type="text" class="form-control" placeholder="https://www.youtube.com/user/lorem/lorem" name="youtube" style="width: 100%"
                                       value="{{ $detail->youtube }}">
                            </div>
                        </div>


                    </div>


                    <div class="box-footer" style="text-align: left">
                        <div class="col-xs-12">
                            <button class="btn btn-primary " type="submit">
                                        <span>
                                                تعديل
                                            </span>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection



@extends('layouts.app')


@section('content')
    <div class="row" style="padding-top: 6%">
        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">
                        اضافه حلقه
                    </h3>
                </div>

                <form method="post" action="{{url('admin/serieses')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-body">

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">اختر القسم *</label>
                                <select class="form-control" name="depart">
                                    <option selected disabled>اختر</option>

                                    @foreach($departs as $depart)
                                        <option value="{{$depart->id}}">
                                            {{$depart->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">اختر النوع *</label>
                                <select class="form-control" name="type" onchange="toggle_method($(this));">
                                    <option selected disabled>اختر</option>

                                   <option value="0">حلقه من اليوتيوب</option>
                                    <option value="1">رفع فيديو من الجهاز</option>
                                </select>
                            </div>
                        </div>





                        <div class="col-xs-12 cus-12 url_wrapper">
                            <div class="form-group form-ar">
                                <label for="name">اضف لينك الحلقه *</label>
                                <input type="text" class="form-control" id="name" placeholder="اللينك" name="url" style="width: 100%" value="{{ old('url') }}">
                            </div>
                        </div>

                        <div class="col-xs-12 cus-12 upload_wrapper">
                            <div class="form-group reli">
                                <label for="image">ارفع الفديو *</label>
                                <input type="file" id="gallery-photo-add" class="upload-hidden" name="video"  accept="video/mp4,video/x-m4v,video/*"  style="width: 100%!important;height: 100%!important;">
                                <button class="btn btn-default upload">
                                    ارفع الفديو
                                </button>
                            </div>
                        </div>


                    </div>

                    <div class="box-footer" style="text-align: left">
                        <div class="col-xs-12">
                            <button class="btn btn-primary " type="submit">
                                        <span>
                                                اضافه
                                            </span>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection





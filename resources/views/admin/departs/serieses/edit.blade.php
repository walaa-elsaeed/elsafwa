@extends('layouts.app')


@section('content')
    <div class="row" style="padding-top: 6%">
        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">
                        تعديل {{$series->url}}
                    </h3>
                </div>

                <form method="post" action="{{url('admin/serieses/'.$series->id)}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="box-body">

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">اختر القسم *</label>
                                <select class="form-control" name="depart">
                                    @foreach($departs as $depart)
                                        @if($series->departs_id == $depart->id)
                                            <option value="{{$depart->id}}" selected>
                                                {{$depart->name}}
                                            </option>
                                        @else
                                            <option value="{{$depart->id}}">
                                                {{$depart->name}}
                                            </option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">اختر النوع *</label>
                                <select class="form-control" name="type" onchange="toggle_method($(this));">
                                    @if($series->type == 0)
                                        <option value="0" selected>حلقه من اليوتيوب</option>
                                        <option value="1">رفع فيديو من الجهاز</option>
                                    @elseif($series->type == 1)
                                        <option value="0">حلقه من اليوتيوب</option>
                                        <option value="1" selected>رفع فيديو من الجهاز</option>
                                    @endif


                                </select>
                            </div>
                        </div>

                        @if($series->type == 0)
                            <div class="col-xs-12 cus-12 url_wrapper">
                                <div class="form-group form-ar block">
                                    <label for="name"> لينك الحلقه *</label>
                                    <input type="text" class="form-control" id="name" placeholder="اللينك" name="url" style="width: 100%" value="{{$series->url}}">
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

                        @elseif($series->type == 1)

                            <div class="col-xs-12 cus-12 url_wrapper">
                                <div class="form-group form-ar">
                                    <label for="name"> لينك الحلقه *</label>
                                    <input type="text" class="form-control" id="name" placeholder="اللينك" name="url" style="width: 100%" value="{{$series->url}}">
                                </div>
                            </div>

                            <div class="col-xs-12 cus-12 upload_wrapper">
                                <div class="form-group reli block" onclick="hidevideo()">
                                    <label for="image">تعديل الفيديو *</label>
                                    <input type="file" id="gallery-photo-add" class="upload-hidden" name="video"  accept="video/mp4,video/x-m4v,video/*"  value="{{$series->upload_url}}" style="width: 100%!important;height: 100%!important;">
                                    <button class="btn btn-default upload">
                                        تعديل الفيديو
                                    </button>

                                </div>

                                <video controls class="section-background-video" style="min-width: 100%;
   width: 100%">
                                    <source src="{{url('uploads/videos/'.$series->upload_url)}}">
                                </video>
                            </div>
                        @endif





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



@extends('layouts.app')


@section('content')
    <div class="row" style="padding-top: 6%">
        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">
                        اضافه صوره
                    </h3>
                </div>

                <form method="post" action="{{url('admin/homeslides')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-body">

                        <div class="col-xs-12 cus-12">
                            <div class="form-group reli form-ar">
                                <label for="image">ارفع الصوره *</label>
                                <input type="file"  class="upload-hidden" name="file" style="width: 100%!important;height: 100%!important;"  onchange="readURL2(this);">
                                <div class="form-group form-ar">
                                    <img id="profile-img-ar" src="{{url('img/homeslider_placeholder.jpg')}}" alt=""
                                         style="width: 100%;border: 1px dashed #0080c4"/>

                                </div>
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



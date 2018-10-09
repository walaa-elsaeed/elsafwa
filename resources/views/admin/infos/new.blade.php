@extends('layouts.app')


@section('content')
    <div class="row" style="padding-top: 6%">
        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">
                        اضافه معلومات عن الصفوه
                    </h3>
                </div>

                <form method="post" action="{{url('admin/infos')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-body">

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">المحتوى *</label>

                                <textarea class="text" name="description"></textarea>
                            </div>
                        </div>


                        <div class="col-md-6 col-xs-12 cus-12">
                            <div class="form-group reli">
                                <label for="image">ارفع *</label>
                                <input type="file" id="gallery-photo-add" class="upload-hidden" name="images[]"  accept="jpg, gif, png" multiple style="width: 100%!important;height: 100%!important;">
                                <button class="btn btn-default upload">
                                    ارفع الصور
                                </button>
                                <div class="gallery"></div>
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



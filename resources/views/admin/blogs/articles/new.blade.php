@extends('layouts.app')


@section('content')
    <div class="row" style="padding-top: 6%">
        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">
                        اضافه مقال
                    </h3>
                </div>

                <form method="post" action="{{url('admin/blog_articles')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-body">

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">اختر البلوج *</label>
                                <select class="form-control" name="blog">
                                    <option selected disabled>اختر</option>

                                    @foreach($blogs as $blog)
                                        <option value="{{$blog->id}}">
                                            {{$blog->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">اسم المقال *</label>
                                <input type="text" class="form-control" id="name" placeholder="الاسم" name="name" style="width: 100%" value="{{ old('url') }}">
                            </div>
                        </div>


                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">تفاصيل المقال *</label>

                                <textarea class="text" name="description"></textarea>
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



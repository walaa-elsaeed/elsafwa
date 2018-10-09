@extends('layouts.app')


@section('content')
    <div class="row" style="padding-top: 6%">
        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">
                        اضافه كتاب
                    </h3>
                </div>

                <form method="post" action="{{url('admin/books')}}" enctype="multipart/form-data">
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
                                <label for="name">اضف اسم الكتاب *</label>
                                <input type="text" class="form-control" id="name" placeholder="الاسم" name="name" style="width: 100%" value="{{ old('url') }}">
                            </div>
                        </div>

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">اضف وصف عن الكتاب *</label>
                                <textarea name="description" class="form-control" rows="7"></textarea>
                            </div>
                        </div>


                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">اضف لينك الكتاب *</label>
                                <input type="text" class="form-control" id="name" placeholder="اللينك" name="url" style="width: 100%" value="{{ old('url') }}">
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



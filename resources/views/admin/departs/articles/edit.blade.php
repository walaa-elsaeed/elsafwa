
@extends('layouts.app')


@section('content')
    <div class="row" style="padding-top: 6%">
        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">
                        تعديل {{$article->name}}
                    </h3>
                </div>

                <form method="post" action="{{url('admin/articles/'.$article->id)}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="box-body">

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">اختر القسم *</label>
                                <select class="form-control" name="depart">
                                    @foreach($departs as $depart)
                                        @if($article->departs_id == $depart->id)
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
                                <label for="name">اسم المقال *</label>
                                <input type="text" class="form-control" id="name"  name="name" style="width: 100%" value="{{ $article->name }}">
                            </div>
                        </div>

                        <div class="col-xs-12 cus-12">
                            <div class="form-group form-ar">
                                <label for="name">التفاصيل *</label>

                                <textarea class="text" name="description">
                                    {{$article->description}}
                                </textarea>
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



@extends('layouts.app')

@section('content')
    <div class="row" style="padding-top: 2%;padding-bottom: 4%">

        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h5>تفاصيل الصفحه الرئيسيه</h5>
                </div>

                <div class="panel-body">
                    <div class="tabbable">

                        <div class="tab-content" style="padding-top: 20px;padding-bottom: 20px">
                            <div class="tab-pane active" id="tab1">
                                <div id="w0" class="grid-view">
                                    <table class="table table-bordered" style="overflow-x: auto">
                                        <thead>
                                        <tr>
                                            <th>الوصف</th>
                                            <th>الفديو</th>
                                            <th>العنوان</th>
                                            <th>الموقع</th>
                                            <th>فيس بوك</th>
                                            <th>تويتر</th>
                                            <th>يوتيوب</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($details as $detail)
                                            <tr>
                                                <td>{{$detail->description}}</td>
                                                <td>
                                                    <a target="_blank" href="{{url('uploads/'.$detail->video)}}">
                                                        {{$detail->video}}
                                                    </a>
                                                </td>
                                                <td>{{$detail->address}}</td>
                                                <td style="
                                                overflow-wrap: break-word;
                                                  word-wrap: break-word;
                                                  -ms-word-break: break-all;
                                                  word-break: break-all;
                                                  word-break: break-word;
                                                  -ms-hyphens: auto;
                                                  -moz-hyphens: auto;
                                                  -webkit-hyphens: auto;
                                                  hyphens: auto;

                                                 ">
                                                    {{$detail->location}}
                                                </td>
                                                <td>
                                                    <a target="_blank" href="{{$detail->facebook}}">
                                                        {{$detail->facebook}}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a target="_blank" href="{{$detail->twitter}}">
                                                        {{$detail->twitter}}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a target="_blank" href="{{$detail->youtube}}">
                                                        {{$detail->youtube}}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{url('/admin/homedetails/'.$detail->id.'/edit')}}" class="btn btn-primary">
                                                        تعديل
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>


    </div>
@endsection



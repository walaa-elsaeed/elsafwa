@extends('layouts.app')

@section('content')
    <div class="row" style="padding-top: 2%;padding-bottom: 4%">

        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h5>من نحن</h5>
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
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($infos as $info)
                                            <tr>
                                                <td>
                                                    {!! html_entity_decode($info->description) !!}
                                                </td>
                                                <td>
                                                    <a href="{{url('/admin/infos/'.$info->id.'/edit')}}" class="btn btn-primary">
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



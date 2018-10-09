@extends('layouts.app')

@section('content')
    <div class="row" style="padding-top: 2%;padding-bottom: 4%">

        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h5>الرسائل</h5>
                </div>

                <div class="panel-body">

                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="{{url('admin/messages')}}">كل الرسائل</a></li>
                        </ul>


                        <div class="tab-content" style="padding-top: 20px;padding-bottom: 20px">
                            <div class="tab-pane active" id="tab1">
                                <div id="w0" class="grid-view">
                                    <table class="table table-bordered" id="users-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>البريد الالكترونى</th>
                                            <th>التليفون</th>
                                            <th>الرساله</th>
                                            <th>اجرائات</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>


    </div>
    <script>
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{url('admin/all_messages')}}',
            columns: [
                { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                { data: 'name', name: 'name' },
                { data: 'mail', name: 'mail' },
                { data: 'phone', name: 'phone' },
                { data: 'message', name: 'message' },
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@endsection



@extends('layouts.app')

@section('content')
    <div class="row" style="padding-top: 2%;padding-bottom: 4%">

        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h5>سليدر الصفحه الرئيسيه</h5>
                </div>

                <div class="panel-body">

                    <p>
                        <a class="btn btn-success" href="{{url('admin/homeslides/create')}}">اضافه صوره</a>
                    </p>

                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="{{url('admin/homeslides')}}">كل الصور</a></li>
                        </ul>


                        <div class="tab-content" style="padding-top: 20px;padding-bottom: 20px">
                            <div class="tab-pane active" id="tab1">
                                <div id="w0" class="grid-view">
                                    <table class="table table-bordered" id="users-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الصوره</th>
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
            ajax: '{{url('admin/all_slides')}}',
            columns: [
                { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                { data: 'image', name: 'image', "render": function (data, type, full, meta) {
                    return "<img src=\"{{url('/uploads')}}" +"/"+ data + "\" height=\"50\"/>";
                },
                    "title": "الصوره",
                    "orderable": true,
                    "searchable": true
                },
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@endsection



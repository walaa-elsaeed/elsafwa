<script>
    var dataTable;
    function updateTable($depart){
        var filter = $depart;
        if(filter == undefined){
            filter = 0;
        }
        var url = '{{url("admin/all_serieses")}}';
        url +='/'+filter;
        dataTable.ajax.url( url ).load();
    }
</script>

@extends('layouts.app')

@section('content')
    <div class="row" style="padding-top: 2%;padding-bottom: 4%">

        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h5>الحلقات</h5>
                </div>

                <div class="panel-body">

                    <p>
                        <a class="btn btn-success" href="{{url('admin/serieses/create')}}">اضافه حلقه</a>
                    </p>

                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="{{url('admin/serieses')}}">كل الحلقات</a></li>
                        </ul>


                        <div class="tab-content" style="padding-top: 20px;padding-bottom: 20px">

                            <div class="search-inputs text-center">
                                <div class="row">
                                    <a id="t" name="_token" value="{{csrf_token()}}" style="display: none"></a>
                                    <div class="col-md-offset-3 col-md-3 col-xs-4">
                                        <div class="form-control" style="border-color: transparent">
                                            <span>تصفيه النتائج بواسطه:</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-4">
                                        <select id="depart_filter" onchange="updateTable(this.value)" class="form-control">
                                            <option disabled selected>اختر القسم</option>
                                            @foreach($departs as $depart)
                                                <option value="{{$depart->id}}">{{$depart->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane active" id="tab1">
                                <div id="w0" class="grid-view">
                                    <table class="table table-bordered" id="users-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>لينك الحلقه</th>
                                            <th>اسم الحلقه</th>
                                            <th>القسم</th>
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
        $(function() {
            dataTable = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('admin/all_serieses')}}'+'/0',
                columns: [
                    { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                    { data: 'url', name: 'url' },
                    { data: 'upload_url', name: 'upload_url' },
                    { data: 'depart', name: 'depart' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            updateTable();
        });
    </script>
@endsection



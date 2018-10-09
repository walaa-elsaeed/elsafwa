<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div id="wrapper" style="background: #13486a">

@include('partials.topbar')
@include('partials.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">

            <div class="row" style="padding-top: 2%;padding-bottom: 4%">

                <div class="col-md-offset-1 col-md-10 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h5>Adds Slider</h5>
                        </div>

                        <div class="panel-body">

                            <p>
                                <a class="btn btn-success" href="{{url('add_adds_slide')}}">Add</a>
                            </p>

                            <div class="tabbable">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="{{url('alladds')}}">All</a></li>
                                </ul>


                                @if(session()->has('message'))
                                    <h1 class="alert alert-success">
                                        {{session()->get('message')}}
                                    </h1>
                                @endif

                                <div class="tab-content" style="padding-top: 20px;padding-bottom: 20px">
                                    {{--<div class="search-inputs">
                                        <a id="t" name="_token" value="{{csrf_token()}}" style="display: none"></a>
                                        <div class="col-md-2 col-xs-4">
                                            <span>Filter By:</span>
                                        </div>
                                        <div class="col-md-3 col-xs-4">
                                            <select id="zone_filter" onchange="getCitiesAdmin(this.value)">
                                                <option disabled selected>Select a government</option>
                                                @foreach($zones as $zone)
                                                    <option value="{{$zone->id}}">{{$zone->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3  col-xs-4">
                                            <select id="cities_filter" onchange="updateTable()">
                                                <option disabled selected>Select a city</option>
                                            </select>
                                        </div>
                                    </div>--}}
                                    <div class="tab-pane active" id="tab1">
                                        <div id="w0" class="grid-view">
                                            <table class="table table-bordered" id="users-table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>img_url</th>
                                                    <th>Source</th>
                                                    <th>Actions</th>
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

        </section>
    </div>
    <div class="main-footer">
        <div class="pull-right hidden-xs"></div>
        <strong>
            Copyright © 2017-2018
            <a href="http://fumestudio.com/website/" target="_blank">
                Fume Studio
            </a>
        </strong>
        All rights
        reserved.

    </div>
</div>


{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Logout</button>
{!! Form::close() !!}



@include('partials.javascripts')

<script>
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{url('getadds')}}',
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index' },
            { data: 'img_url', name: 'img_url' },
            { data: 'src', name: 'src' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
</script>


</body>
</html>

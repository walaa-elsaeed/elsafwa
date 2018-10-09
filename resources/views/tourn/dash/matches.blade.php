<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<script>

    var dataTable;

    function getcybermatch(cyber) {
        $.ajax({
            url: '{{url("matchcyber")}}',
            type: 'post',
            data: {
                cyber_id:cyber,
                _token : $('#t').attr('value')

            },
            success: function (data) {
                console.log(data);
                var d = JSON.parse(data);
            },
            failure/*error*/: function(e){

            },
            complete: function () {
                updateTable();
            }
        });
    }

    function getusermatch(user) {
        $.ajax({
            url: '{{url("matchuser")}}',
            type: 'post',
            data: {
                player1_id:user,
                _token : $('#t').attr('value')

            },
            success: function (data) {
                console.log(data);
                var d = JSON.parse(data);
            },
            failure/*error*/: function(e){

            },
            complete: function () {
                updateTable();
            }
        });
    }

    function updateTable(){
        var cyber = $("#cyber_filter").val();
        var user = $("#user_filter").val();
        if(cyber == undefined){
            cyber = 0;
        }
        if (user == undefined){
            user = 0;
        }
        console.log("cyber"+cyber);
        console.log("user"+user);
        var url = '{{url("getmatches")}}';
        url +='/'+cyber+'/'+user;
        console.log("url"+url);
        dataTable.ajax.url( url ).load();
    }

</script>

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
                            <h5>Matches</h5>
                        </div>

                        <div class="panel-body">


                            <div class="tabbable">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="{{url('matches-list')}}">All</a></li>
                                </ul>


                                @if(session()->has('message'))
                                    <h1 class="alert alert-success">
                                        {{session()->get('message')}}
                                    </h1>
                                @endif

                                <div class="tab-content" style="padding-top: 20px;padding-bottom: 20px">

                                    <div class="search-inputs">
                                        <a id="t" name="_token" value="{{csrf_token()}}" style="display: none"></a>
                                        <div class="col-md-2 col-xs-4">
                                            <span>Filter By:</span>
                                        </div>
                                        <div class="col-md-3 col-xs-4">
                                            <select id="cyber_filter" onchange="getcybermatch(this.value)">
                                                <option disabled selected>Select a Cyber</option>
                                                @foreach($tourn_cybers as $tourn_cyber)
                                                    <option value="{{$tourn_cyber->id}}">{{$tourn_cyber->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3  col-xs-4">
                                            <select id="user_filter" onchange="getusermatch(this.value)">
                                                <option disabled selected>Select a Player</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->user_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="tab-pane active" id="tab1">
                                        <div id="w0" class="grid-view">
                                            <table class="table table-bordered" id="users-table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Match Date</th>
                                                    <th>player 1</th>
                                                    <th>Player 2</th>
                                                    <th>Score 1</th>
                                                    <th>Score 2</th>
                                                    <th>Cyber</th>
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
    $(function() {
        dataTable = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{url('getmatches')}}'+'/0/0',
            columns: [
                { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                { data: 'created_at', name: 'created_at' },
                { data: 'player_1', name: 'player_1' },
                { data: 'player_2', name: 'player_2' },
                { data: 'score1', name: 'score1' },
                { data: 'score2', name: 'score2' },
                { data: 'cyber', name: 'cyber' },
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        updateTable();
    });
</script>


</body>
</html>

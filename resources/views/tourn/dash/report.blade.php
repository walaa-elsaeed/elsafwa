@extends('layouts.app')
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl7gZbf_aXumi-xEIr2U6Df9aWqO92fx8&libraries=places">
</script>


<script src="{{url('js/front/locationpicker.jquery.min.js')}}"></script>

@section('content')
    <div class="row" style="padding-top: 6%">
        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">
                        This Is Report From User ::
                        {{$report->user_name}}
                    </h3>

                    <br>

                    <h3 class="box-title">
                        About Cyber :: {{$report->cyber_name}}
                    </h3>
                </div>

                <div class="box-body">
                    <p>
                        {{$report->massege}}
                    </p>

                    <p>
                    <h4> Sent At:</h4>
                    {{$report->created_at}}
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection
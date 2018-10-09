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
                        Add Cyber
                    </h3>
                </div>

                <form method="post" action="{{url('storejoined')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="text">Select Tournament *</label>
                            <div class="materialSelect inline empty ">
                                <ul class="select">
                                    <input type="hidden" name="tourn">
                                    <li data-selected="true">Select Tourn</li>
                                    @foreach($tourns as $tourn)
                                        <li data-value="0" value="{{$tourn->id}}">{{$tourn->name}}</li>
                                    @endforeach

                                </ul>
                                <div class="message">Please select something</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <select class="form-control select2" style="width: 100%;" name="cyber">
                                <option selected disabled>Select Cyber</option>
                                @foreach($tourn_cybers as $tourn_cyber)
                                    <option value="{{$tourn_cyber->id}}">
                                        {{$tourn_cyber->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">User Name *</label>
                            <input type="text" class="form-control" id="name" placeholder="User Name" name="user_name"
                                   style="width: 100%">
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-xs-12 cus-12">
                                <div class="form-group">
                                    <label for="name">Password *</label>
                                    <input type="password" class="form-control" id="name" placeholder="Password" name="Password"
                                           style="width: 100%">
                                </div>
                            </div>

                            <div class="col-md-6 col-xs-12 cus-12">
                                <div class="form-group">
                                    <label for="name">Retype Password *</label>
                                    <input type="password" class="form-control" id="name" placeholder="Retype Password" name="retype_Password"
                                           style="width: 100%">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="col-xs-12">
                            <button class="btn btn-primary " type="submit">
                                        <span>
                                                Join
                                            </span>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
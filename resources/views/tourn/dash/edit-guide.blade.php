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
                        Edit Guide
                    </h3>
                </div>

                <form method="post" action="{{url('/update_guide/'.$guide->id)}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="box-body">

                        <div class="form-group">
                            <label for="text">Select Tournament *</label>
                            <div class="materialSelect inline empty ">
                                <ul class="select">
                                    <input type="hidden" name="tourn" value="{{$guide->tourn_id}}">
                                    @foreach($tourns as $tourn)
                                        @if($tourn->id == $guide->tourn_id )
                                            <li data-selected="true" data-value="0" value="{{$tourn->id}}">{{$tourn->name}}</li>
                                        @else
                                            <li data-value="0" value="{{$tourn->id}}">{{$tourn->name}}</li>
                                        @endif
                                    @endforeach

                                </ul>
                                <div class="message">Please select something</div>
                            </div>
                        </div>


                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_3" data-toggle="tab" aria-expanded="true">
                                        EN
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_4" data-toggle="tab" aria-expanded="false">
                                        ع
                                    </a>
                                </li>
                            </ul>
                        </div>


                        <div class="tab-content">

                            <div class="tab-pane active" id="tab_3">
                                <div class="col-xs-12 cus-12">
                                    <div class="form-group reli">
                                        <input type="text" name="guide_en" value="{{$guide->translate('en')->text}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_4">
                                <div class="col-xs-12 cus-12">
                                    <div class="form-group reli form-ar">
                                        <input type="text" name="guide_ar" value="{{$guide->translate('ar')->text}}" class="form-control">

                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>

                    <div class="box-footer">
                        <div class="col-xs-12">
                            <button class="btn btn-primary " type="submit">
                                        <span>
                                                Submit
                                            </span>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
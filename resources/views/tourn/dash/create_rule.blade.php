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
                        Add rule
                    </h3>
                </div>

                <form method="post" action="{{url('save_rule')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-body">

                        <div class="form-group">
                            <label for="text">Select Tournament *</label>
                            <div class="materialSelect inline empty ">
                                <ul class="select">
                                    <input type="hidden" name="tourn" required>
                                    <li data-selected="true">Select Tourn</li>
                                    @foreach($tourns as $tourn)
                                        <li data-value="0" value="{{$tourn->id}}">{{$tourn->name}}</li>
                                    @endforeach

                                </ul>
                                <div class="message">Please select something</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="text">Select Type *</label>
                            <div class="materialSelect inline empty ">
                                <ul class="select">
                                    <input type="hidden" name="type" required>
                                    <li data-selected="true">Select type</li>
                                    <li data-value="0" value="0">{{ __('strings.Phase_1')}}</li>
                                    <li data-value="0" value="1">{{ __('strings.Phase_2')}}</li>
                                    <li data-value="0" value="2">{{ __('strings.Phase_3')}}</li>
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
                                        <input type="text" name="rule_en" placeholder="type rule here" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_4">
                                <div class="col-xs-12 cus-12">
                                    <div class="form-group reli form-ar">
                                        <input type="text" name="rule_ar" placeholder="type rule here" class="form-control">

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
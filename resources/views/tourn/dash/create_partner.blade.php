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
                        Add Slide
                    </h3>
                </div>

                <form method="post" action="{{'storepartnerslide'}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-body">

                        <div class="form-group">
                            <label for="text">Select Type *</label>
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

                        <div class="col-xs-12 cus-12">
                            <div class="form-group reli">
                                <label for="image">Upload image *</label>
                                <input type="file"  class="upload-hidden" name="file" style="width: 100%!important;height: 100%!important;"  onchange="readURL(this);">
                                <button class="btn btn-default upload">
                                    upload
                                </button>
                                <div class="form-group">
                                    <img id="profile-img" src="{{url('img/partner-holder.jpg')}}" alt=""
                                         style="width:100%;height: 500px;border: 1px dashed #0080c4"/>

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
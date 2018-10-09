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
                        Edit Slide
                    </h3>
                </div>

                <form method="post" action="{{url('/update_add/'.$add->id)}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="box-body">

                        <div class="col-xs-12 cus-12">
                            <div class="form-group">
                                <label for="text">Select Type *</label>
                                <div class="materialSelect inline empty ">
                                    <ul class="select">
                                        <input type="hidden" name="tourn" value="{{$add->tourn_id}}">
                                        @foreach($tourns as $tourn)
                                            @if($tourn->id ==$add->tourn_id )
                                                <li data-selected="true" data-value="0" value="{{$tourn->id}}">{{$tourn->name}}</li>
                                            @else
                                                <li data-value="0" value="{{$tourn->id}}">{{$tourn->name}}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <div class="message">Please select something</div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xs-12 cus-12">
                            <div class="form-group">
                                <label for="text">Select Type *</label>
                                <div class="materialSelect inline empty ">
                                    <ul class="select">
                                        <input type="hidden" name="type" value="{{$add->type}}">
                                        @if($add->type == 0)
                                            <li onclick="toggle_src($(this));">Select Type</li>
                                            <li data-selected="true" data-value="0" value="0" onclick="toggle_src($(this));">Image</li>
                                            <li data-value="1" value="1" onclick="toggle_src($(this));">Iframe</li>
                                        @else
                                            <li  onclick="toggle_src($(this));">Select Type</li>
                                            <li data-value="0" value="0" onclick="toggle_src($(this));">Image</li>
                                            <li data-selected="true" data-value="1" value="1" onclick="toggle_src($(this));">Iframe</li>
                                        @endif
                                    </ul>
                                    <div class="message">Please select something</div>
                                </div>
                            </div>
                        </div>

                        @if($add->type == 0)
                            <div class="col-xs-12 cus-12 source">
                                <div class="form-group">
                                    <label for="text">article Source *</label>
                                    <input type="text" class="form-control" name="source">
                                </div>
                            </div>


                            <div class="col-xs-12 cus-12 image" style="display: block;">
                                <div class="form-group reli">
                                    <label for="image">Upload image *</label>
                                    <input type="file"  class="upload-hidden" name="file" style="width: 100%!important;height: 100%!important;"
                                           value="{{url('uploads/'.$add->img_url)}}"
                                           onchange="readURL(this);">
                                    <button class="btn btn-default upload">
                                        upload
                                    </button>
                                    <div class="form-group">
                                        <img id="profile-img" src="{{url('uploads/'.$add->img_url)}}"  alt="" style="width:650px;height: 400px;border: 1px dashed #0080c4"/>

                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-xs-12 cus-12 source" style="display: block;">
                                <div class="form-group">
                                    <label for="text">article Source *</label>
                                    <input type="text" class="form-control" name="source" value="{{$add->src}}">
                                </div>
                            </div>


                            <div class="col-xs-12 cus-12 image">
                                <div class="form-group reli">
                                    <label for="image">Upload image *</label>
                                    <input type="file"  class="upload-hidden" name="file" style="width: 100%!important;height: 100%!important;"
                                           onchange="readURL(this);">
                                    <button class="btn btn-default upload">
                                        upload
                                    </button>
                                    <div class="form-group">
                                        <img id="profile-img" src="{{url('img/news.png')}}"  alt="" style="width:650px;height: 400px;border: 1px dashed #0080c4"/>

                                    </div>
                                </div>
                            </div>
                        @endif

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


<script>



    function toggle_src(z) {

        console.log(z.attr('value'));

        if (z.attr('value') == 0)
        {
            $('.image').show();
            $('.source').hide();
        }
        else if (z.attr('value') == 1)
        {
            $('.image').hide();
            $('.source').show();
        }
        else
        {
            $('.image').hide();
            $('.source').hide();
        }

    }

</script>
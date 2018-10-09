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
                        Edit Tournament
                    </h3>
                </div>

                <form method="post" action="{{url('/update_tourn/'.$tourn->id)}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="box-body">

                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1" data-toggle="tab" aria-expanded="true">
                                        EN
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_2" data-toggle="tab" aria-expanded="false">
                                        ع
                                    </a>
                                </li>
                            </ul>
                        </div>


                        <div class="tab-content">

                            <div class="tab-pane active" id="tab_1">
                                <div class="col-xs-12 cus-12">
                                    <div class="form-group">
                                        <label for="name">Name *</label>
                                        <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                               value="{{$tourn->translate('en')->name}}"
                                               style="width: 100%">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_2">
                                <div class="col-xs-12 cus-12">
                                    <div class="form-group form-ar">
                                        <label for="name">الاسم *</label>
                                        <input type="text" class="form-control" id="name" placeholder="الاسم" name="name_ar"
                                               value="{{$tourn->translate('ar')->name}}"
                                               style="width: 100%">
                                    </div>
                                </div>
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
                                    <div class="form-group">
                                        <label for="name">Description *</label>
                                        <textarea class="form-control" id="name" placeholder="Description" name="description"  rows="5"
                                                  style="width: 100%">{{$tourn->translate('en')->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_4">
                                <div class="col-xs-12 cus-12">
                                    <div class="form-group form-ar">
                                        <label for="name">الموضوع *</label>
                                        <textarea class="form-control" id="name" placeholder="الموضوع" name="description_ar" rows="5" style="width: 100%">{{$tourn->translate('ar')->description}}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>




                        <div class="col-md-6 col-xs-12 cus-12">
                            <div class="form-group reli">
                                <label for="image">Upload image *</label>
                                <input type="file"  class="upload-hidden" name="file" style="width: 100%!important;height: 100%!important;"
                                       value="{{url('uploads/'.$tourn->img_url)}}"
                                       onchange="readURL(this);">
                                <button class="btn btn-default upload">
                                    upload
                                </button>
                                <div class="form-group">
                                    <img id="profile-img" src="{{url('uploads/'.$tourn->img_url)}}"  alt="" style="width:500px;height: 500px;border: 1px dashed #0080c4"/>

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
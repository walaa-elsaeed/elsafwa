@extends('layouts.app')

<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl7gZbf_aXumi-xEIr2U6Df9aWqO92fx8&libraries=places">
</script>

<script src="{{url('js/front/locationpicker.jquery.min.js')}}"></script>
<script>
    var deletedIds = [];
    function deleteImage(imageId)
    {
        //var fd = new FormData(document.getElementById("updateCyber"));
        //fd.append('deletedImages[]',imageId);
        deletedIds.push(imageId);
        var oldValue = $('#deletedImages').val();
        $('#deletedImages').attr("value",deletedIds.join(', '));
        $('#'+imageId).remove();
    }
</script>


@section('content')
    <div class="row" style="padding-top: 2%">
        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Edit {{$record->user_name}}
                    </h3>
                </div>

                <form id="updateCyber"  method="post" action="{{url('/join_cyber/'.$join_cyber->id)}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="box-body">


                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="name">User Name *</label>
                                    <input type="text" class="form-control" id="name" placeholder="User Name" name="user_name"
                                           style="width: 100%" value="{{$record->user_name}}">
                                </div>
                            </div>

                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="name">Paied *</label>
                                    <input type="text" class="form-control" id="name" placeholder="Paied" name="paied"
                                           style="width: 100%" onkeypress="return allowNumbers(event)" value="{{$record->paied}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-xs-12 cus-12">
                                <div class="form-group">
                                    <label for="name">Password *</label>
                                    <input type="password" class="form-control" id="name" placeholder="********" name="Password"
                                           style="width: 100%" value="{{$record->password}}">
                                </div>
                            </div>

                            <div class="col-md-6 col-xs-12 cus-12">
                                <div class="form-group">
                                    <label for="name">Retype Password *</label>
                                    <input type="password" class="form-control" id="name" placeholder="********" name="retype_Password"
                                           style="width: 100%" value="{{$record->password}}">
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
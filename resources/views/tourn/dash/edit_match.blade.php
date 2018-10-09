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
                        Edit Match ( {{$match->created_at}} )
                    </h3>
                </div>

                <form method="post" action="{{url('/match/'.$match->id)}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="box-body">

                        <div class="form-group">
                            <div class="col-md-6 col-xs-12">

                                <label for="name">player 1 *</label>
                                <input type="email"  class="form-control" placeholder="Email" name="email1" value="{{$user1->email}}" readonly="">
                                <br>
                                <input type="text" class="form-control" placeholder="Score" name="score1" value="{{$match->score1}}"
                                       onkeypress="return allowNumbers(event)"
                                >
                                <input type="hidden" value="{{$match->score1}}" name="oldscore1">

                            </div>

                            <div class="col-md-6 col-xs-12">

                                <label for="name">player 2 *</label>
                                <input type="email"  class="form-control" placeholder="Email" name="email2" value="{{$user2->email}}" readonly="">
                                <br>
                                <input type="text" class="form-control" placeholder="Score" name="score2" value="{{$match->score2}}"
                                       onkeypress="return allowNumbers(event)"
                                >
                                <input type="hidden" value="{{$match->score2}}" name="oldscore2">

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
<!DOCTYPE html>
<html lang="en">
<head>

    @include('front.common.heading')
    <span style="display: none">;</span>
    @include('sweet::alert')
    <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl7gZbf_aXumi-xEIr2U6Df9aWqO92fx8&libraries=places">
    </script>

    <script src="{{url('js/front/locationpicker.jquery.min.js')}}"></script>

</head>

<body>

<div >

    <!-- Navigation area -->
@include('front.common.nav')
<!-- Navigation area end -->



</div>

<div class="container-fluid">
    <div class="row add-cyber">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There is a problem with Your input:
                <br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            @if(Auth::user()->phone == null)
                <h4 class="text-center join-tittle">You must enter your phone number</h4>
            @else
                <h4 class="text-center join-tittle">{{ __('strings.sure_number')}}</h4>
            @endif

            <form method="post" action="{{url('/user_join/'.Auth::user()->id)}}">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="form-group">
                    <input type="text" class="form-control"
                           name="phone" placeholder="{{ __('strings.Phone')}}"
                           value="{{Auth::user()->phone}}"
                           maxlength="11" onkeypress="return allowNumbers(event)"
                    >
                </div>
                <div class="buttons text-center">
                    <button type="submit" class="btn btn-default join-btn">{{ __('strings.submit')}}</button>
                </div>
            </form>

    </div>
</div>



<!--Footer-->
@include('front.common.footer')

<!--Footer-->

@include('front.common.modals')

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
@include('front.common.scripts')



</body>
</html>

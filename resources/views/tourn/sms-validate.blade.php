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

        <h4 class="text-center join-tittle">
            {{ __('strings.validate_sms')}}
        </h4>

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
        <form method="post" action="{{url('/user_valid/'.Auth::user()->id)}}">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group">
                <input type='hidden' value="{{Auth::user()->sms}}" name="sms">
                <input type="text" class="form-control"
                       name="sms_input" placeholder="{{ __('strings.sms')}}"
                       maxlength="11" onkeypress="return allowNumbers(event)"
                >
            </div>

            <div class="form-group">
                <label>{{ __('strings.terms')}} *</label>
                <textarea placeholder="Description" readonly rows="7" style="color: #555">
{{ __('strings.tourn_terms')}}
{{ __('strings.tourn_privacy')}}
                                                        </textarea>
            </div>
            <div class="checkbox">
                <label style="width: 100%;margin-right: 10px;display: inline;line-height: 44px;color: #999 !important;">
                    <input type="checkbox" required style="width: auto">
                    {{ __('strings.accept')}}
                    {{ __('strings.terms')}}
                </label>
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

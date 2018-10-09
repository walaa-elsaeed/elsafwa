<!DOCTYPE html>
<html lang="en">
<head>
    @include('front.common.heading')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <span style="display: none">;</span>
    @include('sweet::alert')
</head>
<body>

@include('front.common.nav')

<!--Content Area-->
<div>
    @if (Session::has('message'))
        <h1 class="alert alert-success">
            {{ Session::get('message') }}
        </h1>
    @endif
    @if ($errors->count() > 0)
        <div class="note note-danger">
            <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('lay_out')
</div>

<!--Content Area-->

@include('front.common.footer')

@include('front.common.scripts')
<script>

    var successlocation = $("#loc").attr('value');

    $('#search').click(function () {
        val = $('#inputSearch').val();
        if (val != '')
        {
            window.location.href = successlocation +'/'+ val;
        }
        else
        {
            window.location.reload();
        }

    })

</script>


</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>default title</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="telephone=no" name="format-detection">
    <meta name="HandheldFriendly" content="true">
    <meta name="_token" content="{!! csrf_token() !!}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;amp;subset=cyrillic"
          rel="stylesheet">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/css/jquery.fancybox.min.css" media="all">
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/2.0/css/font-awesome.css"
          media="all">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!--[if (gt IE 9)|!(IE)]><!-->
    <link href="{{asset('static/css/main.min.css')}}" rel="stylesheet" type="text/css">
    <!--<![endif]-->
    <!--END OF  CSS-->
    <!-- FAVICON -->
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <!-- END OF FAVICON -->
    <!-- TOSTER -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
    <!-- END OF TOSTER -->
    @if(config('laravel2step.laravel2stepAppCssEnabled'))
        <link rel="stylesheet" type="text/css" href="{{ asset(config('laravel2step.laravel2stepAppCss')) }}">
    @endif
    @section('css')
    @show
    <link rel="stylesheet" type="text/css" href="{{ asset(config('laravel2step.laravel2stepCssFile')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- SCRIPT -->
    <script src="https://code.jquery.com/jquery-2.2.4.js"
            integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/js/jquery.fancybox.min.js"></script>
    <script>
        (function (H) {
            H.className = H.className.replace(/\bno-js\b/, 'js')
        })(document.documentElement)
    </script>
    <!-- END OF SCRIPT-->

</head>
<body>
<div id="app">
    @include('partials.header')
    @if (session('confirmation-success'))
        <div class="alert alert-success own__alert">
            {{ session('confirmation-success') }}
        </div>
    @endif
    @if (session('write_phone'))
        <div class="alert alert-success own__alert">
            {{ session('write_phone') }}
        </div>
    @endif

    @yield('content')
    @include('partials.footer')
</div>
@guest
    @include('partials.auth-modals')
@endguest

{{--SCRIPT--}}

<link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
<script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
{{--<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>--}}
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.4.0/sweetalert2.all.js"></script>

<script>
    @if(session('message'))
    // TODO: change Controllers to use AlertsMessages trait... then remove this
    {{--var alertType = {!! json_encode(Session::get('alert-type', 'info')) !!};--}}
    {{--var alertMessage = {!! json_encode(Session::get('message')) !!};--}}
    // var alerter = toastr[alertType];
    swal({
        position: 'top-end',
        type: {!! json_encode(Session::get('alert-type', 'info')) !!},
        title: {!! json_encode(Session::get('message')) !!},
        showConfirmButton: false,
        timer: 3000
    });
    // if (alerter) {
    //     alerter(alertMessage);
    // } else {
    //     toastr.error("toastr alert-type " + alertType + " is unknown");
    // }
    @endif

    @if (count($errors) > 0)
    @foreach ($errors->all() as $error)
    swal({
        position: 'top-end',
        type: "error",
        title: "{!! $error !!}",
        showConfirmButton: false,
        timer: 3000
    });
    {{--toastr.error("{{$error}}");--}}
    @endforeach
    @endif
</script>

<script src="{{asset('static/js/main.min.js')}}"></script>
@section('js')
@show
<script src="{{asset('js/custom.js')}}"></script>


</body>
</html>

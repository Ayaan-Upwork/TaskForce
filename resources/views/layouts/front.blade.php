<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>
    <!-- Styles -->
    <link href="{{ asset('frontend/css/custome.css') }}" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="{{asset('frontend/css/custome.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/css/bootstrap5.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/css/owl.carousel.min')}}" rel="stylesheet" />
    <link href="{{asset('frontend/css/owl.theme.default.min')}}" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
{{-- font family --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Koulen&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        p{
            text-decoration: none !important;
        }
    </style>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
</head>
<body>
    @include('layouts.inc.frontnavbar')
    <div class="content">
        @yield('content')
    </div>

    <script src="{{ asset('frontend/css/js/jquery-3.6.0.min.js')}}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('frontend/css/js/owl.carousel.min.js')}}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('frontend/css/js/custom.js')}}"></script>


    @if (session('status'))
        <script>
            // swal("{{ session('status') }}");
            toastr.success("{{ session('status') }}");

        </script>
    @endif
      @yield('scripts')
</body>
</html>
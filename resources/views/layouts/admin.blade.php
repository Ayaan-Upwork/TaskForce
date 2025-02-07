<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    @yield('title')
    <!-- Styles -->
    <link href="{{ asset('frontend/css/custome.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link href="{{asset('admins/css/custom.css')}}" rel="stylesheet" />
    <link href="{{asset('admins/css/material-dashboard.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('admins/css/jquery.datetimepicker.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    @yield('css')
</head>
<body>
    <div class="wrapper">
        @include('layouts.inc.sidebar')
        <div class="main-panel">
            @include('layouts.inc.adminnavbar')
            <div class="content">
                @yield('content')
            </div>
            @include('layouts.inc.adminfooter')
        </div>
    </div>

    {{-- <script src="{{ asset('admin/js/jquery.min.js')}}" defer></script> --}}
    <script src="{{ asset('admins/js/popper.min.js')}}" defer></script>
    {{-- <script src="{{ asset('admin/js/bootstrap-material-design.min.js')}}" defer></script> --}}
    <script src="{{ asset('admins/js/perfect-scrollbar.min.js')}}" defer></script>
    {{-- ======================================================= --}}
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- ======================================================= --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('admins/js/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" ></script>
    @if (session('status'))
        <script>
            // swal("{{ session('status') }}");
            toastr.success("{{ session('status') }}");

        </script>
    @endif
      @yield('scripts')
</body>
</html>

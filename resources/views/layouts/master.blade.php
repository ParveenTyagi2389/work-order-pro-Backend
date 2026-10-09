<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>@yield('page-title')</title>
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/uicons-regular-straight.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/uicons-solid-rounded.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/uicons-brands.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</head>

<body class="dashboard-page">
    @include('layouts.leftmenu')

  <!-- MAIN CONTENT AREA -->
  <main class="main-content">
    <!-- TOP BAR -->
   @include('layouts.topmenu')
   @yield('content')
  </main>

  <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin="">
    </script>
   @stack('scripts')
@yield('script')
</body>


</html>
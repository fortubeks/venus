<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ config('flowdash.rtl') ? 'rtl' : 'ltr' }}">
<head>
    @include('partials.header')
</head>

@php
    $layout = 'default';
@endphp

<body class="{{ $bodyClass ?? 'layout-fluid' }}">

  @include('partials.preloader')
  
  @yield('content')

  @include('partials.footer')
  @yield('footer')
</body>
</html>
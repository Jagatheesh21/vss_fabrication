<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Fabrication unit">
    <meta name="author" content="VSSIPL">
    <meta name="keyword" content="Fabrication ERP">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="manifest" href="{{asset('assets/favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('assets/favicon/fav_icon.png')}}">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{asset('vendors/simplebar/css/simplebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendors/simplebar.css')}}">
    <!-- Main styles for this application-->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    @stack('styles')
  </head>
  <body>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light ">
      <div class="body flex-grow-1 px-3">
        <div class="container-lg justify-content-center py-5" >
          @yield('content')
        </div>
      </div>
      @include('partials.footer')
      @stack('scripts')
  </body>
</html>
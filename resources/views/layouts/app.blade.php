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
    <link rel="stylesheet" href="{{asset('css/prism.css')}}">
    <link href="{{asset('css/examples.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
    <style>
      .table{
        width:100% !important;
      }
    </style>
    @stack('styles')
  </head>
  <body>
    <div class="sidebar sidebar-dark sidebar-fixed sidebar-narrow-unfoldable" id="sidebar">
      <div class="sidebar-brand d-none d-md-flex">
        <img src="{{asset('assets/img/logo.png')}}" class="sidebar-brand-full" width="180" height="46" alt="Logo">
        <img src="{{asset('assets/img/fav_icon.png')}}" class="sidebar-brand-narrow" width="46" height="46" alt="Logo">
      </div>
      @include('partials.menu')
      <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      
      <div class="body flex-grow-1 px-3 py-3">
        <div class="container-fluid">
          @yield('content')
        </div>
      </div>
      
  </body>
</html>
<script src="{{asset('vendors/chart.js/js/chart.min.js')}}"></script>
<script src="{{asset('vendors/@coreui/chartjs/js/coreui-chartjs.js')}}"></script>
<script src="{{asset('vendors/@coreui/utils/js/coreui-utils.js')}}"></script>
<script src="{{asset('vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
<script src="{{asset('vendors/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery_validation.min.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="{{asset('js/toasts.js')}}"></script>
<script type="text/javascript">
  $(function () {
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    $(".alert").delay(1000).slideUp(200, function() {
    $(this).alert('close');
});

  });

  function isNumber(evt)
				{
				evt = (evt) ? evt : window.event;
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode > 31 && (charCode < 48 || charCode > 57)) {
					return false;
				}
				return true; }
  
</script>
@stack('scripts')
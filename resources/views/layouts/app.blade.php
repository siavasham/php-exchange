
<!DOCTYPE html>
<html dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $constans->title }}</title>    
    <meta name="description" content="{{ __('home.description') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="stylesheet" href="{{ asset(mix('css/bootstrap.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/bootstrap-rtl.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/flickity.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('crypto/cryptocoins.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/fa.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/custom.css')) }}">
    <link rel="shortcut icon" href="{{ asset(mix('img/favicon.png')) }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </head>
  <body>
      <div class="body-inner xcontainer ">
          @yield('content')
      </div>
      <script src="{{ asset(mix('/js/jquery.min.js')) }}"></script>
      <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('/js/flickity.pkgd.min.js') }}"></script>
      <script src="{{ asset('/js/front.js') }}"></script>
  </body>
</html>

<!doctype html>
<html lang="en" ng-app="myApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ getenv('site.name') }}</title>
    {{ HTML::style('css/vendor.min.css') }}
    {{ HTML::style('css/main.css') }}
</head>
<body>
    @include('layouts.partials.nav')

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>

    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    {{ HTML::script('vendor/angular/angular.min.js') }}
    {{ HTML::script('js/app.js') }}

    <script>
        $('#flash-overlay-modal').modal();
    </script>
</body>
</html>
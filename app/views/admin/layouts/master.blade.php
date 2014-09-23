<!doctype html>
<html lang="en" ng-app="myApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ getenv('site.name') }}</title>
    {{ HTML::style('css/vendor.min.css') }}
    {{ HTML::style('css/main.css') }}
</head>
<body ng-controller="MasterController" resize ng-class="{'preload': preload}">
    @yield('content')

    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    {{ HTML::script('vendor/angular/angular.min.js') }}
    {{ HTML::script('vendor/angular/angular-cookies.min.js') }}
    {{ HTML::script('js/app.js') }}

    <script>
        $('#flash-overlay-modal').modal();
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en" ng-app="admin">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="VerticalHorizon">
    <link rel="icon" href="favicon.ico">

    <title>
        @section('title')
            Admin - {{ $model ? $model : trans('reactiveadmin::reactiveadmin.dashboard') }}
        @show
    </title>
    @section('styles')
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

        {{ HTML::style('public/packages/Verticalhorizon/Reactiveadmin/css/dashboard.css') }}
    @show

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    @include('reactiveadmin::partials.navbar')

    <div class="container-fluid">
        <div class="row">
            @yield('content')
        </div>
    </div>

    @section('scripts')
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        {{--<script>window.jQuery || document.write('<script src="{{ URL::to('public/js/vendor/jquery-1.11.0.min.js') }}"><\/script>')</script>--}}
        {{-- HTML::script('public/packages/bootstrap/js/bootstrap.min.js') --}}
        <!-- Latest compiled and minified JavaScript -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.min.js"></script>
        {{ HTML::script('public/packages/Verticalhorizon/Reactiveadmin/js/admin.js') }}

    @show

</body>
</html>

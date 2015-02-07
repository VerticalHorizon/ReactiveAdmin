<!DOCTYPE html>
<html lang="en" ng-app="admin">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="VerticalHorizon">
    <link rel="icon" href="/favicon.ico">

    <title>
        @section('title')
            {{ $model ? $model : trans('reactiveadmin::reactiveadmin.dashboard') }} | ReAdmin
        @show
    </title>
    @section('styles')
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

        <!-- Chosen for Bootstrap3 -->
        {{ HTML::style('public/packages/verticalhorizon/reactiveadmin/js/vendor/chosen/chosen.min.css') }}
        {{ HTML::style('public/packages/verticalhorizon/reactiveadmin/js/vendor/chosen/chosen-bootstrap.css') }}

        {{ HTML::style('public/packages/verticalhorizon/reactiveadmin/css/flag-icons.css') }}
        {{ HTML::style('public/packages/verticalhorizon/reactiveadmin/css/dashboard.css') }}
    @show

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    @include('reactiveadmin::partials.navbar')

    <div class="container-fluid">
        <div class="row" id="content">
            @yield('content')
        </div>
    </div>

    @section('scripts')
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        {{ HTML::script('public/packages/verticalhorizon/reactiveadmin/js/vendor/chosen/chosen.jquery.min.js') }}
        {{ HTML::script('public/packages/verticalhorizon/reactiveadmin/js/admin.js') }}
    @show

</body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="favicon.ico">

        <title>{{{ trans('confide::confide.forgot.title') }}}</title>

        <!-- Bootstrap core CSS -->
        {{ HTML::style('public/packages/bootstrap/css/bootstrap.min.css') }}

        <!-- Custom styles for this template -->
        {{ HTML::style('public/packages/Verticalhorizon/Reactiveadmin/css/signin.css') }}

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{ URL::to('public/js/vendor/jquery-1.11.0.min.js') }}"><\/script>')</script>
    </head>
    <body>
        <div class="container">
            @if (Session::get('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                {{{ Session::get('error') }}}
            </div>
            @endif

            @if (Session::get('notice'))
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                {{{ Session::get('notice') }}}
            </div>
            @endif

            {{ Form::open( array('url' => Request::url(), 'class' => 'form-signin', 'role' => 'form', 'method' => 'post') ) }}
            <h2 class="form-signin-heading">{{{ Lang::get('confide::confide.forgot.title') }}}</h2>
            <input class="form-control" tabindex="1" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="email" required name="email" id="email" value="{{{ Input::old('email') }}}">
            <br>
            <button class="btn btn-lg btn-primary btn-block" tabindex="2" type="submit">{{{ Lang::get('confide::confide.forgot.submit') }}}</button>
            {{ Form::close() }}
        </div> <!-- /container -->

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        {{ HTML::script('public/assets/js/ie10-viewport-bug-workaround.js') }}
        <!-- Bootstrap core JS -->
        {{ HTML::script('public/packages/bootstrap/js/bootstrap.min.js') }}
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="favicon.ico">

        <title>{{{ trans('confide::confide.login.title') }}}</title>

        <!-- Bootstrap core CSS -->
        {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}

        <!-- Custom styles for this template -->
        {{ HTML::style('packages/Verticalhorizon/Reactiveadmin/css/signin.css') }}

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{ URL::to('js/vendor/jquery-1.11.0.min.js') }}"><\/script>')</script>
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
            <h2 class="form-signin-heading">{{{ Lang::get('confide::confide.login.desc') }}}</h2>
            <input type="text" tabindex="1" name="email" required class="form-control" placeholder="{{{ Lang::get('confide::confide.username_e_mail') }}}" value="{{{ Input::old('email') }}}" required autofocus>
            <input type="password" tabindex="2" name="password" required class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" required>
            <label class="checkbox" for="remember">
                <input tabindex="4" type="checkbox" name="remember" id="remember" value="1"> {{{ Lang::get('confide::confide.login.remember') }}}
                <input type="hidden" name="remember" value="0" tabindex="3">
            </label>
            <button class="btn btn-lg btn-primary btn-block" tabindex="4" type="submit">{{{ Lang::get('confide::confide.login.submit') }}}</button>
            <small>
                <a href="{{{ URL::to('/users/forgot_password') }}}">{{{ Lang::get('confide::confide.login.forgot_password') }}}</a>
            </small>
            {{ Form::close() }}
        </div> <!-- /container -->

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        {{ HTML::script('assets/js/ie10-viewport-bug-workaround.js') }}
        <!-- Bootstrap core JS -->
        {{ HTML::script('packages/bootstrap/js/bootstrap.min.js') }}
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="VerticalHorizon">
    <link rel="icon" href="../../favicon.ico">

    <title>
      @section('title')
        Admin
      @show
    </title>
    @section('styles')
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/bootstrap/src/bootstrap-wysihtml5.css') }}"></link>
      <!-- Bootstrap core CSS -->
      <link href="{{ URL::asset('public/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

      <!-- Custom styles for this template -->
      <link href="{{ URL::asset('public/bootstrap/bootstrap-theme.min.css') }}" rel="stylesheet">
      <link href="{{ URL::asset('public/bootstrap/dashboard.css') }}" rel="stylesheet">
    @show

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    @include('admin.partials.navbar')

    <div class="container-fluid">
      <div class="row">
        @yield('content')
      </div>
    </div>

    @section('scripts')
      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      {{ HTML::script('public/bootstrap/lib/js/wysihtml5-0.3.0.js') }}
      {{ HTML::script('public/bootstrap/src/bootstrap3-wysihtml5.js') }}
      {{ HTML::script('public/bootstrap/js/bootstrap.min.js') }}
      {{ HTML::script('public/bootstrap/js/admin.js') }}
      <script type="text/javascript">
            $('textarea[data-type="wysihtml5"]').wysihtml5('deepExtend', {
                "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
                "emphasis": true, //Italics, bold, etc. Default true
                "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                "html": true, //Button which allows you to edit the generated HTML. Default false
                "image": true, //Button to insert an image. Default true,
                "link": true,
                "format-code": false, // enable syntax highlighting
                "color": true, //Button to change color of font
                parserRules: {
                    classes: {
                    },
                    tags: {
                        table: {},
                        tr: {},
                        th: {},
                        td: {},
                        p: {}
                    }
                },
                "stylesheets": ["<%= root_url %>wysiwyg-color.css", "<%= root_url %>github.css"], // CSS stylesheets to load
            });
      </script>
    @show
  </body>
</html>

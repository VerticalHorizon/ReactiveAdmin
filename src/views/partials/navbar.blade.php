<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::to('/') }}">{{ Config::get('reactiveadmin::site_name') }}</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to(Config::get('reactiveadmin::uri')) }}">Admin</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" id="navbar-right">
                @if($menu = Config::get('reactiveadmin::menu', array()))
                    @foreach ($menu as $key1 => $value1)
                        @if(is_array($value1))
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $key1 }} <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    @foreach ($value1 as $key2 => $value2)
                                        <li><a href="{{ URL::to(Config::get('reactiveadmin::uri'), $key2) }}">{{ $value2 }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li @if(Request::is(Config::get('reactiveadmin::uri').'/'.$key1))class="active"@endif><a href="{{ URL::to(Config::get('reactiveadmin::uri'), $key1) }}">{{ $value1 }}</a></li>
                        @endif
                    @endforeach
                @endif
                <!--  -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> {{{ Confide::user()->username }}} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header">User Menu</li>
                        <li><a href="{{ URL::to('admin/users/'.Confide::user()->id.'/edit') }}"><span class="glyphicon glyphicon-pencil"></span> {{ trans('reactiveadmin::reactiveadmin.edit.title') }}</a></li>
                        <li><a href="{{ URL::to('users/logout') }}"><span class="glyphicon glyphicon-off"></span> {{ trans('reactiveadmin::reactiveadmin.exit') }}</a></li>
                    </ul>
                </li>
                @if($locales = Config::get('reactiveadmin::locales', []))
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="flag-icon {{ Lang::getLocale() }}" title="{{ Lang::getLocale() }}"></span></a>
                    <ul class="dropdown-menu" role="lang">
                        @foreach ($locales as $key => $one)
                        <li><a href="{{ URL::to(Config::get('reactiveadmin::uri'), 'lang').'/'.$key }}"><span class="flag-icon {{ $one }}" title="{{ $one }}"></span></a></li>
                        @endforeach
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
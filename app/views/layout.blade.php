<!DOCTYPE html>

<html>
    <head>
        <title> Demo </title>
        {{ HTML::style('/assets/css/bootstrap.min.css') }}
        {{ HTML::style('/assets/css/bootstrap-theme.css') }}
    </head>
    <body>
        <header>

        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <div class="container-fluid">
                    <a class="navbar-brand" href=" {{ route('home') }}">Pintsize.it</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li> {{ HTML::linkRoute('home', 'Home') }} </li>
                    @if(Auth::check())
                        <li> {{ HTML::linkRoute('post', 'Post') }} </li>
                        <li> {{ HTML::linkRoute('logout', 'Logout ('.Auth::user()->username.')') }} </li>
                    @else
                        <li> {{ HTML::linkRoute('login', 'Login') }} </li>
                    @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        {{ Form::open(array('route'=>'search', 'class'=>'navbar-form')) }}
                        <div class="form-group">
                            {{ Form::text('criteria', null, array('class' => 'form-control', 'placeholder' => 'Search...')) }}
                            {{ Form::submit('Search Tags', array('class' => 'btn btn-default')) }}
                        </div>
                        {{ Form::close() }}
                    </li>
                </ul>
            </div>
        </nav>

    </header>

    <div id="container container-fluid">
        <!-- Check for flashed messages -->
        @if(Session::has('flash_notice'))
            <div id="flash_notice"> {{ Session::get('flash_notice') }} </div>
        @endif

        @yield('content')
    </div> <!-- End container -->

    <footer>

        <div class="container container-fluid">
            <p class="text-center">
                <small>Made by Daniel Burnley - <a href="mailto:dan@pintsize.it">dan@pintsize.it</a></small>
            </p>
        </div>

    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    {{ HTML::script('/assets/js/bootstrap.min.js') }}
    </body>
</html>
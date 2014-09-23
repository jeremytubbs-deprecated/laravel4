<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">{{ getenv('site.name') }}</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    @if ($currentUser)
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img class="nav-gravatar" src="{{ $currentUser->present()->gravatar }}" alt="{{ $currentUser->username }}">

                                {{ $currentUser->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @if (Auth::user()->hasGroup('admin'))
                                <li>{{ link_to_route('dashboard', 'Dashboard') }}</li>
                                <li class="divider"></li>
                                @endif
                                <li>{{ link_to_route('logout', 'Log Out') }}</li>
                            </ul>
                        </li>
                    @else
                        <li>{{ link_to_route('register', 'Register') }}</li>
                        <li>{{ link_to_route('login', 'Log In') }}</li>
                    @endif
                </ul>
        </div>
    </div>
</nav>
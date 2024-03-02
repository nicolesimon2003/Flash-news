<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        @guest
            <a class="navbar-brand" href="{{ route('login') }}">Login</a>
            <a class="navbar-brand" href="{{ route('registration') }}">Registration</a>
        @endguest
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                @auth
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            netflix<span class="text-primary font-weight-bold">ify</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="pl-0 pl-lg-4 my-4 my-lg-0">
                <div class="input-group">
                    <input type="search" class="form-control bg-transparent border-primary text-primary"
                           id="movie-search" placeholder="Search for movies">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text bg-transparent border-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <div class="text-center text-lg-right ml-auto">
                @auth

                    <ul class="navbar-nav">
                        <li class="nav-item mr-4">
                            <a href="" class="nav-link text-white" style="position: relative">
                                <i class="fas fa-heart" style="font-size: 22px; vertical-align: middle;"></i>
                                <span class="text-white bg-primary d-flex justify-content-center align-items-center"
                                      style="position: absolute; top: 0; left: 25px; width: 30px; height: 20px; border-radius: 50px"
                                >
                                    9+
                                </span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin'))
                                    <a class="dropdown-item" href="{{ route('dashboard.welcome') }}">
                                        <i class="fas fa-home mr-1"></i>
                                        dashboard
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt mr-1"></i>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                @else
                    <a class="btn btn-primary mr-2" style="border-radius: 0" href="{{ route('login') }}">login</a>

                    <a class="btn btn-outline-light" style="border-radius: 0"
                       href="{{ route('register') }}">register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

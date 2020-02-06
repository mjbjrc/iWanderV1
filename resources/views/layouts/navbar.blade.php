<div class="container-fluid p-0 m-0 justify-content-center">
<nav class="navbar navbar-expand-md navbar-custom navbar-default p-0">
    <div class="container-fluid nav-img p-2">

        <a class="navbar-brand link" href="{{ url('/') }}">
            {{ config('app.name', 'iWander') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"><i class="fa fa-bars fa-1x" style="color:black; font-size:28px;"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Authentication Links -->
                @guest
                  <autocomplete></autocomplete>
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          Browse <span class="caret"></span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('home') }}">
                              {{ __('Restaurants') }}
                          </a>
                          <a class="dropdown-item" href="{{ route('home') }}">
                              {{ __('Attractions') }}
                          </a>
                      </div>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link link" href="{{ route('login') }}">{{ __('How To') }}</a>
                  </li>
                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link link" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                      </li>
                  @endif
                    <li class="nav-item">
                        <a class="nav-link link" href="{{ route('login') }}">{{ __('Sign In') }}</a>
                    </li>

                @else
                  <autocomplete></autocomplete>
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          Browse <span class="caret"></span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('home') }}">
                              {{ __('Restaurants') }}
                          </a>
                          <a class="dropdown-item" href="{{ route('home') }}">
                              {{ __('Attractions') }}
                          </a>
                      </div>
                  </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            My Account <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Settings') }}
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link link" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                          @csrf
                      </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<hr/>
</div>

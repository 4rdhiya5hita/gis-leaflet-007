<div class="card">
    <!-- <div class="col"> -->
        @guest
            <div class="row">
                <a class="" href="" style="">                            
                    <img src="{{ asset('img/user-icon.png') }}" alt="User Avatar" class="img-circle mr-3" width="50" height="50">                                
                </a>
            </div>
            <div class="row">
                <a class="" href="{{ route('login') }}" style="">                            
                    <img src="{{ asset('img/edit-icon.png') }}" alt="User Avatar" class="img-circle mr-3" width="50" height="50">                                
                </a>
            </div>
                <!-- <li class="nav-item">
                    @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                </li> -->
            @else
                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('outlets.index') }}">{{ __('outlet.list') }}</a>
                </li>
                <li class="nav-item dropdown"> -->
                    

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </div>

    <!-- </div> -->
</div>
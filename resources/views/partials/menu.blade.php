<nav class="nav-center row grey darken-4">
    <div class="nav-wrapper">
        <a href="#" data-target="burger-menu" class="sidenav-trigger"><i class="material-icons">menu</i></a>

        <ul class="col s8 offset-s2 hide-on-med-and-down">
            <li class="white-text"><a tabindex="1" class="{{ $active === "index" ? "active" : "" }}" href="{{route('index')}}">{{ __('Homepage') }}</a></li>
            @if($types === true)
                <li class="white-text"><a tabindex="2" class="{{ $active === "stages" ? "active" : "" }}" href="{{route('stages')}}">{{ __('Internship') }}</a></li>
                <li class="white-text"><a tabindex="3" class="{{ $active === "formations" ? "active" : "" }}" href="{{route('formations')}}">{{ __('Training') }}</a></li>
                <li class="white-text"><a tabindex="4" class="{{ $active === "contact" ? "active" : "" }}" href="{{route('contact')}}">Contact</a></li>
            @endif
            @guest
            @else
                <li class="white-text">
                    <a tabindex="5" class="{{ $active === "dashboard" ? "active" : "" }}"href="{{ route('post.index') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="white-text">
                    <a tabindex="6" href="#"onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </ul>
        <form id="search-container" class="input-field col s8 m2 {{ $searchbar === false ? 'hide' : '' }}">
            @csrf
            <input tabindex="7" id="search" type="search" name="search" value="{{ $search ?? "" }}">
            <label class="label-icon" for="search"><i class="material-icons">search</i></label>
            <i class="material-icons close">close</i>
        </form>

        {{-- .input-field  --}}
    </div>
    {{-- .nav-wrapper--}}

</nav>

<ul class="sidenav" id="burger-menu">
    <li class="white-text"><a href="{{route('index')}}">Accueil</a></li>
    @if($types === true)
        <li class="white-text"><a href="{{route('stages')}}">Stages</a></li>
        <li class="white-text"><a href="{{route('formations')}}">Formations</a></li>
        <li class="white-text"><a href="{{route('contact')}}">Contact</a></li>
    @endif
    @guest
    @else
        <li class="white-text">
            <a href="#"onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
        </li>
        <li class="white-text">
            <a href="{{ route('post.index') }}">{{ __('Dashboard') }}</a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endguest

</ul>



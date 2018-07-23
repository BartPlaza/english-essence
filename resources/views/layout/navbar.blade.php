<div class="navbar has-shadow">
    <div class="navbar-brand">
        <div class="navbar-item logo">
            English-essence
        </div>
        <div id="navbar-burger" class="navbar-burger is-large" onclick="event.preventDefault(); document.getElementById('navbar-burger').classList.toggle('is-active');
                                                                                       document.getElementById('navbar-menu').classList.toggle('is-active')">
           <span></span>
           <span></span>
           <span></span>
        </div>
    </div>
    <div id="navbar-menu" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="/">Home</a>
            <a class="navbar-item" href="/words">Words overview</a>
            <a class="navbar-item" href="import_csv">Import words</a>
        </div>
        <div class="navbar-end">
            @guest
                <a class="navbar-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                <a class="navbar-item" href="{{ route('register') }}">{{ __('Register') }}</a>
            @else
                <a class="navbar-item" href="#">{{Auth::user()->name}}</a>
                <a class="navbar-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </div>
    </div>
</div>

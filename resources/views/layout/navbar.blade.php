<div class="navbar">

    <a href="/">Home</a>
    <a href="/words">Words overview</a>
    <a href="import_csv">Import words</a>
    @guest
        <a href="{{ route('login') }}">{{ __('Login') }}</a>
        <a href="{{ route('register') }}">{{ __('Register') }}</a>
    @else
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endguest
</div>

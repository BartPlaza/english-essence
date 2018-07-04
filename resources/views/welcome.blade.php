@extends('layout.main')

@section('content')

<h1>Welcome! Select type of exercise</h1>
    <div class="exercises">
        <div class="exercise">
            <h3>10 random words</h3>
            <span>
                <button class="button is-small is-dark">PL => EN</button>
                <button class="button is-small is-dark">EN => PL</button>
            </span>
        </div>
    </div>

@endsection





<!--
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
    <div class="top-right links">
@auth
        <a href="{{ url('/home') }}">Home</a>
                    @else
        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
            </div>
@endif
        -->
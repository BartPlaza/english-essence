@extends('layout.main')

@section('content')
    <div class="welcome-wrapper">
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
    </div>
@endsection
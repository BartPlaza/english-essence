@extends('layout.main')
@section('content')
    <div class="main from-top" style="background-color: whitesmoke;">
        <div class="hero exercises-hero-background">
            <div class="hero-body">
                <div class="container">
                    <div class="columns is-centered">
                        <div class="column is-8-desktop is-12-mobile exercises-hero-content">
                            <h1>Exercises</h1>
                            <p>
                                Welcome to our exercises. It's time to practise new languages. Please remember that the
                                slight age method is
                                the best way to reach your targets
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section exercises-list">
            <div class="container">
                <div class="tile is-ancestor">
                    <div class="tile is-parent">
                        <a href="/exercises/10-random-words?from={{Word::LANGUAGES['en']}}&to={{Word::LANGUAGES['pl']}}"
                           class="tile is-child exercises-item">
                            <div class="exercise-description">
                                <div class="exercise-title">10 random words</div>
                                <div class="exercise-languages">
                                    <i class="flag flag-gb "></i>
                                    <i class="fas fa-exchange-alt"></i>
                                    <i class="flag flag-pl "></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="tile is-parent">
                        <a href="/exercises/10-random-words?from={{Word::LANGUAGES['pl']}}&to={{Word::LANGUAGES['en']}}"
                           class="tile is-child exercises-item">
                            <div class="exercise-description">
                                <div class="exercise-title">10 random words</div>
                                <div class="exercise-languages">
                                    <i class="flag flag-pl "></i>
                                    <i class="fas fa-exchange-alt"></i>
                                    <i class="flag flag-gb "></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="tile is-parent is-12-tablet is-4-desktop">

                    </div>
                </div>
                <div class="tile is-ancestor">

                </div>
            </div>
        </div>
    </div>
@endsection
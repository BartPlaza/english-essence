@extends('layout.main')

@section('content')
    <div class="main full-height" style="background-color: whitesmoke;">
        <div class="hero welcome-page-hero">
            <div class="hero-body">
                <div class="container">
                    <div class="columns is-centered">
                        <div class="column is-10-desktop is-12-mobile">
                            <h1>Learn English the way you want.</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns is-centered">
            <div class="column is-8-desktop">
                <div class="columns planes-wrapper">
                    <div class="column is-6-desktop">
                        <div class="card plan-default">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Basic
                                </p>
                            </header>
                            <div class="card-content">
                                <p class="plan-price"><span>Free</span></p>
                            </div>
                            <div class="card-content plan-description">
                                <div class="plan-feature">One dictionary</div>
                                <div class="plan-feature">Basic exercises</div>
                                <div class="plan-feature">Google chrome extension</div>
                            </div>
                            <footer class="card-footer">
                                <a href="#" class="button is-medium is-light is-fullwidth">Choose</a>
                            </footer>
                        </div>
                    </div>
                    <div class="column is-6-desktop">
                        <div class="card plan-primary">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Professional
                                </p>
                            </header>
                            <div class="card-content">
                                <p class="plan-price">$ <span class="has-text-primary">5</span> / Month</p>
                            </div>
                            <div class="card-content plan-description">
                                <div class="plan-feature">One dictionary</div>
                                <div class="plan-feature">Basic exercises</div>
                                <div class="plan-feature">Google chrome extension</div>
                                <div class="plan-feature">Advanced exercises</div>
                                <div class="plan-feature">No words limit</div>
                                <div class="plan-feature">Email reminders</div>
                            </div>
                            <footer class="card-footer">
                                    <a href="#" class="button is-medium is-primary is-fullwidth">Choose</a>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
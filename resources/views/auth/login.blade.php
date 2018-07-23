@extends ('layout.main')

@section('content')
    <div class="main">
        @component('components.like_login_wrapper')
            <div class="box">
                <div class="title"><p>{{ __('Login') }}</p></div>
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    @component('components.input', ['name' => 'email', 'type' => 'email', 'label' => 'E-mail'])
                    @endcomponent
                    @component('components.input', ['name' => 'password', 'type' => 'password', 'label' => 'Password'])
                    @endcomponent
                    <div class="field">
                        <div class="control">
                            <label class="checkbox">
                                <input type="checkbox"
                                       name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="field is-grouped" style="align-items: center">
                        <div class="control">
                            <button type="submit" class="button is-lightblue">
                                {{ __('Login') }}
                            </button>
                        </div>
                        <div class="control">
                            <a class="is-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        @endcomponent
    </div>
@endsection

@extends ('layout.main')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="title"><p>{{ __('Login') }}</p></div>
            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf
                <div class="field">
                    <label class="label" for="email">{{ __('E-Mail Address') }}</label>
                    <div class="control">
                        <input id="email" type="email"
                               class="input {{ $errors->has('email') ? ' is-danger' : '' }}" name="email"
                               value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <p class="help is danger" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </p>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="password">{{ __('Password') }}</label>
                    <div class="control">
                        <input id="password" type="password"
                               class="input {{ $errors->has('password') ? ' is-danger' : '' }}"
                               name="password" required>

                        @if ($errors->has('password'))
                            <p class="help is-danger" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </p>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox"
                                   name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-link">
                            {{ __('Login') }}
                        </button>
                    </div>
                    <div class="control">
                        <a class="vutton is-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

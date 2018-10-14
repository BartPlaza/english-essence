@extends ('layout.main')

@section('content')
    <div class="main">
        @component('components.like_login_wrapper')
            <div class="box">
                <div class="title"><p>{{ __('Reset Password') }}</p></div>
                <form method="POST" action="{{ route('password.request') }}">
                    {{csrf_field()}}
                    <input type="hidden" name="token" value="{{ $token }}">
                    @component('components.input', ['name' => 'email', 'type' => 'email', 'label' => 'E-mail'])
                    @endcomponent
                    @component('components.input', ['name' => 'password', 'type' => 'password', 'label' => 'Password'])
                    @endcomponent
                    @component('components.input', ['name' => 'password_confirmation', 'type' => 'password', 'label' => 'Confirm password'])
                    @endcomponent
                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button is-lightblue">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @endcomponent
    </div>
@endsection

@extends ('layout.main')

@section('content')
    <div class="main">
        @component('components.like_login_wrapper')
            <div class="box">
                <div class="title"><p>{{ __('Reset Password') }}</p></div>
                @if (session('status'))
                    <div class="is-form-notification has-background-primary has-text-white" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    {{csrf_field()}}
                    @component('components.input', ['name' => 'email', 'type' => 'email', 'label' => 'E-mail'])
                    @endcomponent
                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button is-lightblue">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @endcomponent
    </div>
@endsection

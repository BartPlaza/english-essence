@extends ('layout.main')

@section('content')
    <div class="main">
        @component('components.like_login_wrapper')
            <div class="box">
                <div class="title">{{ __('Register') }}</div>
                <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                    @csrf
                    @component('components.input', ['name' => 'name', 'type' => 'text', 'label' => 'Name'])
                    @endcomponent
                    @component('components.input', ['name' => 'email', 'type' => 'email', 'label' => 'E-mail'])
                    @endcomponent
                    @component('components.input', ['name' => 'password', 'type' => 'password', 'label' => 'Password'])
                    @endcomponent
                    @component('components.input', ['name' => 'password_confirmation', 'type' => 'password', 'label' => 'Confirm password'])
                    @endcomponent
                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button is-lightblue">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @endcomponent
    </div>
@endsection


@extends('layout.main')
@section('content')
    <div class="main">
        @component('components.like_login_wrapper')
            <div id="exerciseComponent" data-words="{{$words}}"></div>
        @endcomponent
    </div>
@endsection

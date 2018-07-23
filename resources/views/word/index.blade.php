@extends('layout.main')

@section('content')
    <div class="main">
        @component('components.like_login_wrapper')
            <div class="panel" id="words-table">
                <div class="panel-heading">
                    <span>All words: {{$wordsCount}}</span>
                    <div id="Modal"></div>
                </div>
                <div class="panel-block">
                    <table class="table is-striped is-fullwidth">
                        <thead>
                        <tr>
                            <td class="column-no">No.</td>
                            <td>Word</td>
                            <td>Language</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($words as $index => $word)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$word->body}}</td>
                                <td>{{$word->language}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="panel-footer">
                    {{$words->links()}}
                </div>
            </div>
        @endcomponent
    </div>
@endsection
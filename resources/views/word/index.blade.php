@extends('layout.main')

@section('content')

    <div class="panel" id="words-table">
        <div class="panel-heading">
            All words
        </div>
        <div class="panel-block">
            <table class="table is-striped">
                <thead>
                <tr>
                    <td class="column-no">No.</td>
                    <td>English</td>
                    <td>Polish</td>
                </tr>
                </thead>
                <tbody>
                @foreach($words as $index => $word)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$word->en}}</td>
                        <td>{{$word->pl}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            {{$words->links()}}
        </div>
    </div>

@endsection
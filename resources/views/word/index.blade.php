@extends('layout.main')

@section('content')

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

@endsection
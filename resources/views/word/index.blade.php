@extends('layout.main')

@section('content')
    <div class="main">
        @component('components.like_login_wrapper')
            <div class="panel" id="words-table">
                <div class="panel-heading">
                    <span>All words: {{$wordsCount}}</span>
                    <div id="AddWordForm"></div>
                </div>
                <div class="panel-block">
                    <form action="/words" method="GET" class="is-full" style="width: 100%">
                        {{csrf_field()}}
                        <div class="field has-addons">
                            <div class="control is-expanded">
                                <input name="phrase" class="input" type="text" placeholder="Find word" value="{{ old('phrase') }}">
                            </div>
                            <div class="control">
                                <button type="submit" class="button is-lightblue">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="words-table-body" class="panel-block">
                    <table class="table is-striped is-fullwidth">
                        <thead>
                        <tr>
                            <td class="column-no"></td>
                            <td>Word</td>
                            <td>Language</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($words as $index => $word)
                            <tr>
                                <td>
                                    <div class="field">
                                        <div class="control">
                                            <label class="checkbox">
                                                <input class="word-checkbox" type="checkbox" data-word-id="{{$word->id}}">
                                            </label>
                                        </div>
                                    </div>
                                </td>
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
                    <div id="remove-wrapper">
                        <form action="/words" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <input id="remove-word-ids" type="hidden" name="ids">
                            <button type="submit" id="remove-word-button" class="button is-small is-danger is-outlined">
                                <i class="far fa-trash-alt"></i> &nbsp; Remove selected
                            </button>
                        </form>
                    </div>
                    {{$words->links()}}
                </div>
            </div>
        @endcomponent
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const removeWordsIds = document.getElementById('remove-word-ids');
        const removeButton = document.getElementById('remove-word-button');
        document.getElementById('words-table-body').addEventListener('change', function (event) {
            if (event.target.type === 'checkbox') {
                let selectedWords = checkSelectedWords();
                if (selectedWords.length > 0) {
                    updateSelectedWordsIds(extractIds(selectedWords));
                    updateDisplayingButton(true);
                } else {
                    updateSelectedWordsIds([]);
                    updateDisplayingButton(false);
                }
            }
            console.log(removeWordsIds.value)
        });


        function checkSelectedWords() {
            return Array.from(document.getElementsByClassName('word-checkbox'))
                .filter(function (checkbox) {
                    return checkbox.checked
                });
        }

        function updateSelectedWordsIds(ids) {
            removeWordsIds.value = JSON.stringify(ids);
        }

        function updateDisplayingButton(isVisible) {
            removeButton.style.display = isVisible ? 'block' : 'none';
        }

        function extractIds(selectedWords) {
            return selectedWords.map(function (checkbox) {
                return checkbox.getAttribute('data-word-id');
            });
        }
    });

</script>
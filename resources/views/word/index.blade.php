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
                        <div class="field has-addons">
                            <div class="control is-expanded">
                                <input name="body" class="input" type="text" placeholder="Find word"
                                       value="{{ old('body', '') }}">
                            </div>
                            <div class="control">
                                <button type="submit" class="button is-lightblue">
                                    Search
                                </button>
                            </div>
                        </div>
                        <div class="field is-horizontal">
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <select name="language" class="input selection-list">
                                            <option selected disabled value>Language filter</option>
                                            @foreach($languages as $language)
                                                <option value="{{$language}}" style="color: black"
                                                        @if($language === old('language')) selected @endif>
                                                    {{$language}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="control remove-filter-button">
                                        <div class="button">
                                            <i class="fas fa-times has-text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <select name="dictionary" class="input selection-list">
                                            <option selected disabled value>Dictionary filter</option>
                                        </select>
                                    </div>
                                    <div class="control remove-filter-button">
                                        <div class="button">
                                            <i class="fas fa-times has-text-danger"></i>
                                        </div>
                                    </div>
                                </div>
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
                                                <input class="word-checkbox" type="checkbox"
                                                       data-word-id="{{$word->id}}">
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
        const selectLists = Array.from(document.getElementsByClassName('selection-list'));

        selectLists.forEach(function (list) {
            adjustFilterFormatting(list);
            list.addEventListener('change', function () {
                adjustFilterFormatting(list);
            })
        });

        const removeFilterButtons = Array.from(document.getElementsByClassName('remove-filter-button'));

        removeFilterButtons.forEach(function(button){
           button.addEventListener('click', function(){
               let selectList = button.previousElementSibling.firstElementChild;
               selectList.value = '';
               selectList.dispatchEvent(new Event('change'));
           })
        });

        function adjustFilterFormatting(selectList) {
            if(selectList.value === ''){
                selectList.style.color = 'lightgray';
                selectList.closest('div.field').classList.remove('has-addons');
                selectList.parentNode.nextElementSibling.style.display = 'none';
            } else {
                selectList.style.color = 'black';
                selectList.closest('div.field').classList.add('has-addons');
                selectList.parentNode.nextElementSibling.style.display = 'block';
            }
        }

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
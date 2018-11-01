<?php

namespace App\Services;

use App\Dictionary;
use App\Word;
use Auth;

class DictionaryService
{
    public $dictionary;

    public function __construct(Dictionary $dictionary = null)
    {
        $this->dictionary = $dictionary ?: Auth::user()->dictionary;
    }

    public function addWord(Word $word): void
    {
        $this->dictionary->words()->attach($word->id);
    }

    public function removeWordsByIds(array $wordsIds): void
    {
        $this->dictionary->words()->detach($wordsIds);
    }
}
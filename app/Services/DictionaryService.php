<?php

namespace App\Services;

use App\Dictionary;
use App\Word;
use Auth;
use Illuminate\Database\Eloquent\Collection;

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

    public function getRandomWords(string $fromLanguage, int $qty): Collection
    {
        return $this->dictionary->words()->where('language', $fromLanguage)->get()->random($qty);
    }

    public function wordExists(string $body, string $language): bool
    {
        return $this->dictionary->words()->where(['body' => $body, 'language' => $language])->exists();
    }
}
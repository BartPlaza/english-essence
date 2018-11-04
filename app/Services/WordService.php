<?php

namespace App\Services;


use App\Word;

class WordService
{
    /**
     * @var DictionaryService
     */
    private $dictionaryService;

    public function __construct(DictionaryService $dictionaryService)
    {
        $this->dictionaryService = $dictionaryService;
    }

    public function store(string $body, string $language): void
    {
        $word = Word::findOrNull($body, $language);
        if(!$word){
            $word = Word::create(['body' => $body, 'language' => $language]);
        }
        $this->dictionaryService->addWord($word);
    }

    public function remove(array $wordsIds): void
    {
        $this->dictionaryService->removeWordsByIds($wordsIds);
    }
}
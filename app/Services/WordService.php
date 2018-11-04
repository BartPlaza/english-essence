<?php

namespace App\Services;


use App\Word;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;

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

    public function count(Request $request): int
    {
        $query = $this->prepareQuery($request);
        return $query->count();
    }

    private function prepareQuery(Request $request): BelongsToMany
    {
        $query = $this->dictionaryService->dictionary->words();

        if($request->has('phrase')){
            $query = $query->where('body', 'like', '%' . $request->get('phrase') . '%');
        }

        return $query;
    }

    public function paginate(Request $request, int $items): Paginator
    {
        $query = $this->prepareQuery($request);
        return $query->simplePaginate($items);
    }

    public function remove(array $wordsIds): void
    {
        $this->dictionaryService->removeWordsByIds($wordsIds);
    }
}
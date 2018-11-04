<?php

namespace App\Http\Controllers;

use App\CsvImporter;
use App\Dictionary;
use App\Scoping\BodyScope;
use App\Scoping\Scoper;
use App\Services\DictionaryService;
use App\Services\WordService;
use App\User;
use App\Word;
use App\Words;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use MongoDB\Driver\Query;

class WordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->flash();
        $query = Word::withScopes();
        $wordsCount = $query->count();
        $words = $query->simplePaginate(10);
        $languages = ['pl', 'en'];
        return view('word.index', compact('words', 'wordsCount', 'languages'));
    }

    public function store(Request $request, WordService $wordService)
    {
        $request->validate([
            'body' => 'required',
            'language' => ['required', Rule::in(Word::LANGUAGES)]
        ]);
        $body = $request->get('body');
        $language = $request->get('language');
        $wordService->store($body, $language);
    }

    public function exists(Request $request, DictionaryService $dictionaryService)
    {
        $request->validate([
            'body' => 'required',
            'language' => ['required', Rule::in(Word::LANGUAGES)]
        ]);
        $body = $request->get('body');
        $language = $request->get('language');
        return json_encode($dictionaryService->WordExists($body, $language));
    }

    public function remove(Request $request, WordService $wordService)
    {
        $wordsIds = (array) json_decode($request->get('ids'));
        $wordService->remove($wordsIds);
        return back();
    }

    public function import()
    {
        return view('word.import');
    }

    public function validateFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt'
        ]);
    }

    public function importFile(Request $request)
    {
        $file = $request['file'];
        $csvImporter = new CsvImporter($file);
        $csvImporter->save();
        $result = $csvImporter->saveToDatabase();
        $csvImporter->remove();
        return $result;
    }
}
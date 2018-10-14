<?php

namespace App\Http\Controllers;

use App\CsvImporter;
use App\User;
use App\Word;
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
        $query = Auth::user()->dictionary->words();

        if($request->has('phrase')){
            $query = $query->where('body', 'like', '%' . $request->get('phrase') . '%');
        }

        $wordsCount = $query->count();
        $words = $query->simplePaginate(10);
        return view('word.index', compact('words', 'wordsCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'language' => ['required', Rule::in(Word::LANGUAGES)]
        ]);

        $word = Word::create(Input::all());
        $user = Auth::user();
        $user->dictionary->words()->attach($word->id);
    }

    public function exists(Request $request)
    {
        return json_encode(Word::isInDictionary(Auth::user(), $request->input('word'), $request->input('lang')));
    }

    public function remove(Request $request)
    {
        $wordsIds = json_decode($request->get('ids'));
        $user = Auth::user();
        $user->dictionary->words()->detach($wordsIds);
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
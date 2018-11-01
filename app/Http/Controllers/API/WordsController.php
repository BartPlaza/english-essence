<?php

namespace App\Http\Controllers\API;

use App\Services\DictionaryService;
use App\User;
use App\Word;
use App\Words;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WordsController extends Controller
{
    public function store(Request $request, Words $wordsRepository, DictionaryService $dictionaryService)
    {
        $user = User::find(auth()->user()->id);
        $body = $request->input('body');
        $language = $request->input('language');

        if($wordsRepository->existsInDictionary($body, $language, $user->dictionary)){
            return response()->json(['code' => 200, 'message' => 'This word already exists']);
        }

        if($word = Word::create(['body' => $body, 'language' => $language])){
            $dictionaryService->addWord($word);
            return response()->json(['code' => 200, 'message' => 'Word successfully added']);
        }

        return response()->json(['code' => 500, 'message' => 'Sorry, something went wrong :( ']);
    }
}

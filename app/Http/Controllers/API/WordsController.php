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
    public function store(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $dictionaryService = new DictionaryService($user->dictionary);
        $body = $request->input('body');
        $language = $request->input('language');

        if($dictionaryService->wordExists($body, $language)){
            return response()->json(['code' => 200, 'message' => 'This word already exists']);
        }

        if($word = Word::create(['body' => $body, 'language' => $language])){
            $dictionaryService->addWord($word);
            return response()->json(['code' => 200, 'message' => 'Word successfully added']);
        }

        return response()->json(['code' => 500, 'message' => 'Sorry, something went wrong :( ']);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WordsController extends Controller
{
    public function store(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $body = $request->input('body');
        $language = $request->input('language');

        if(Word::isInDictionary($user, $body, $language)){
            return response()->json(['code' => 200, 'message' => 'This word already exists']);
        }

        if($word = Word::create(['body' => $body, 'language' => $language])){
            $user->dictionary->words()->attach($word->id);
            return response()->json(['code' => 200, 'message' => 'Word successfully added']);
        }

        return response()->json(['code' => 500, 'message' => 'Sorry, something went wrong :( ']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Dictionary;
use Auth;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client as Guzzle;

class ExercisesController extends Controller
{
    /**
     * @var Guzzle
     */
    private $guzzle;

    public function __construct(Guzzle $guzzle)
    {
        $this->middleware('auth');
        $this->guzzle = $guzzle;
    }


    public function index(Request $request)
    {
        if(($request->has('exercise')) && ($request->input('exercise') === 'finished')){
            $notification = ['message' => 'Exercise successfully finished', 'class' => 'is-success'];
        }
        return view('exercises.index', compact('notification'));
    }

    public function tenRandomWords(Request $request)
    {
        try {
            $fromLanguage = $request->input('from');
            $toLanguage = $request->input('to');
            $words = Auth::user()->dictionary->words()->where('language', $fromLanguage)->get()->random(10);
            return view('exercises.ten_random_words', compact('words','fromLanguage', 'toLanguage'));
        } catch (Exception $e) {
            $notification = ['message' => $e->getMessage(), 'class' => 'is-warning'];
            return view('exercises.index', compact('notification'));
        }
    }

    public function fetchWord(Request $request)
    {
        $word = $request->input('word');
        $target = 'pl';
        $endpoint = 'https://api-platform.systran.net/translation/text/translate?key=' . config('services.systran.key') . '&input=' . $word . '&target=' . $target;
        return $this->guzzle->get($endpoint)->getBody();
    }

    public function fetchAllWords(Request $request)
    {
        $words = $request->input('words');
        $from = $request->input('from');
        $to = $request->input('to');
        $endpoint = 'https://api-platform.systran.net/translation/text/translate?key=' . config('services.systran.key') . '&target=' . $to . '&source=' . $from;
        foreach ($words as $word){
            $endpoint = $endpoint . '&input=' . $word;
        }
        return $this->guzzle->get($endpoint)->getBody();
    }
}

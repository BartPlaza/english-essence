<?php

namespace App\Http\Controllers;

use App\CsvFile;
use App\CsvImporter;
use App\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WordsController extends Controller
{
    public function index()
    {
        $words = Word::all();
        return view('word.index', compact('words'));
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

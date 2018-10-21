<?php

namespace App\Http\Controllers;

use App;
use Config;
use Illuminate\Http\Request;
use Session;

class LocalizationController extends Controller
{
    public function language(Request $request, $language)
    {
        if(in_array($language, Config::get('app.locales'))){
            Session::put('locale', $language);
        }
        return back();
    }
}

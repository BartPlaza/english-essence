<?php

namespace App;

use Auth;

class Words {

    public function existsInDictionary(string $body, string $language, Dictionary $dictionary = null): bool
    {
        $dictionary = $dictionary ?: Auth::user()->dictionary;
        return $dictionary->words()->where(['body' => $body, 'language' => $language])->exists();
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Word
 * @property  int id
 * @property string body
 * @property string $language
 */

class Word extends Model
{
    const LANGUAGES = [
        'en' => 'en',
        'pl' => 'pl'
    ];
    protected $fillable = ['body', 'language'];

    public static function findOrNull($body, $language)
    {
        return Word::where(['body' => $body, 'language' => $language])->first();
    }

    public function dictionaries()
    {
        return $this->belongsToMany(Dictionary::class, 'dictionary_word');
    }
}

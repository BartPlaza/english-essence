<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    const LANGUAGES = [
        'en' => 'en',
        'pl' => 'pl'
    ];
    protected $fillable = ['body', 'language'];

    public function dictionaries()
    {
        return $this->belongsToMany(Dictionary::class, 'dictionary_word');
    }
}

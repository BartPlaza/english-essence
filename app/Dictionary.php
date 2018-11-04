<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Dictionary
 *
 * @property Word[] words
 * @property User user
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Word[] $words
 * @mixin \Eloquent
 */
class Dictionary extends Model
{
    protected $fillable = [
        'user_id', 'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function words()
    {
        return $this->belongsToMany(Word::class, 'dictionary_word');
    }
}

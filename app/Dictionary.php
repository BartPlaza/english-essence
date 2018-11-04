<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Dictionary
 *
 * @property Word[] words
 * @property User user
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
        return $this->belongsToMany(Word::class, 'dictionary_word')->withoutGlobalScope('forUser');
    }
}

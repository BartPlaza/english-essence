<?php

namespace App;

use App\Scoping\BodyScope;
use App\Scoping\Scoper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class Word
 *
 * @property int id
 * @property string body
 * @property string $language
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Dictionary[] $dictionaries
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Word withScopes()
 * @mixin \Eloquent
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

    public function scopeWithScopes(Builder $builder)
    {
        $scoper = new Scoper($builder);
        return $scoper->apply($this->getScopes());
    }

    private static function getScopes(): array
    {
        return [
            'body' => new BodyScope()
        ];
    }
}

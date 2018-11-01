<?php

namespace App\Rules;

use App\Words;
use Illuminate\Contracts\Validation\Rule;

class uniqueBodyAndLanguage implements Rule
{
    private $language;

    /**
     * Create a new rule instance.
     *
     * @param $language
     */
    public function __construct($language)
    {
        $this->language = $language;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $count = Words::where(['body' => $value, 'language' => $this->language])->count();
        return $count === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Word in this language already exists';
    }
}

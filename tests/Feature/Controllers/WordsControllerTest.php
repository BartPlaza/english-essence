<?php

namespace Tests\Feature\Controllers;

use App\Dictionary;
use App\User;
use App\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WordsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldReturnOnlyWordsRelatedWithAuthUser()
        {
            //given
            $user = factory(User::class)->create();
            $user->dictionary()->save(factory(Dictionary::class)->create());
            $user->dictionary->words()->save(factory(Word::class)->create());

            $otherDictionary = factory(Dictionary::class)->create();
            $otherDictionary->words()->save(factory(Word::class)->create());

            //when
            $response = $this->actingAs($user)->get('words');

            //then
            $response->assertViewHas('wordsCount', 1);
        }

    public function testShouldApplyBodyScopeToWordQuery()
    {
        //given
        $user = factory(User::class)->create();
        $user->dictionary()->save(factory(Dictionary::class)->create());
        $user->dictionary->words()->save(factory(Word::class)->create(['body' => 'kot']));
        $user->dictionary->words()->save(factory(Word::class)->create(['body' => 'pies']));

        //when
        $response = $this->actingAs($user)->get('words?body=ot');

        //then
        $response->assertViewHas('wordsCount', 1);
    }
}
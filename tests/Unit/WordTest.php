<?php

namespace Tests\Unit;


use App\Dictionary;
use App\User;
use App\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WordTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldReturnRelatedDictionaries()
    {
        //given
        $dictionary = factory(Dictionary::class)->create();
        $word = factory(Word::class)->create();
        $dictionary->words()->save($word);

        //when
        $dictionaries = $word->dictionaries;

        //then
        $this->assertInstanceOf(Dictionary::class, $dictionaries->first());
    }

    public function testShouldApplyBodyScopeToWordQuery()
    {
        //given
        $user = factory(User::class)->create();
        $word = factory(Word::class)->create(['body' => 'kot']);
        factory(Word::class)->create(['body' => 'pies']);

        //when
        $response = $this->actingAs($user)->get('words?body=ot');

        //then
        $response->assertViewHas('words', [$word]);
    }
}
<?php

namespace Tests\Unit;

use App\Dictionary;
use App\User;
use App\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DictionaryTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldReturnRelatedUser()
    {
        //given
        $user = factory(User::class)->create();
        $dictionary = factory(Dictionary::class)->create(['user_id' => $user->id]);

        //when
        $result = $dictionary->user;

        //then
        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($result->id, $user->id);
    }

    public function testShouldReturnRelatedWords()
    {
        //given
        $dictionary = factory(Dictionary::class)->create();
        $dictionary->words()->save(factory(Word::class)->create());

        //when
        $words = $dictionary->words;

        //then
        $this->assertInstanceOf(Word::class, $words->first());
    }
}

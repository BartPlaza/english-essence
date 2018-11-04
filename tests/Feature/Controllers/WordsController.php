<?php

namespace Tests\Feature\Controllers;

use App\User;
use App\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WordsController extends TestCase
{
    use RefreshDatabase;

    public function testShouldApplyBodyScopeToWordQuery()
    {
        //given
        $user = factory(User::class)->create();
        $word = factory(Word::class)->create(['body' => 'kot']);
        factory(Word::class)->create(['body' => 'pies']);

        //when
        $response = $this->actingAs($user)->get('words?body=ot');

        //then
        $response->assertViewHas('wordsCount', 1);
    }
}
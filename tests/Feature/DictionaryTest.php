<?php

namespace Tests\Feature;

use App\Dictionary;
use App\Events\RegisteredNewUser;
use App\User;
use App\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DictionaryTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldCreateDictionaryForNewUser()
    {
        //given
        $user = factory(User::class)->create();

        //when
        event(new RegisteredNewUser($user->id));

        //then
        $this->assertEquals(1, Dictionary::count());
    }
}

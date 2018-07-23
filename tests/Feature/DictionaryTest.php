<?php

use App\Dictionary;
use App\Events\RegisteredNewUser;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DictionaryTest extends TestCase
{

    use DatabaseTransactions;

    public function testShouldCreateDictionaryForNewUser()
    {
        //given
        $user = factory(User::class)->create();

        //when
        event(new RegisteredNewUser($user->id));

        //then
        $this->assertEquals(1, Dictionary::count());
    }

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


}

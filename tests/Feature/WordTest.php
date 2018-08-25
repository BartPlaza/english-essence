<?php

use App\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WordTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldSaveWordToDatabase()
    {
        var_dump(DB::connection()->getDatabaseName());
        //when
        $this->signIn();
        $response = $this->post('/words', ['body' => 'test','language' => 'pl', '_token' => csrf_token()]);
        //Word::create(['body' => 'test','language' => 'pl']);

        //then
        $response->assertStatus(200);

        //  $this->assertEquals(1, Word::all()->count());
    }

}

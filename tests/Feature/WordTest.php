<?php

use App\Word;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WordTest extends TestCase
{
    use DatabaseTransactions;

    public function testShouldSaveWordToDatabase()
    {
        //when
        $this->withExceptionHandling();
        $this->post('/words', ['langue' => 'bb'])->assertSessionHas('as');
        //Word::create(['body' => 'test', 'language' => 'pl']);

        //then
        //$this->assertEquals(1, Word::all()->count());
    }

}

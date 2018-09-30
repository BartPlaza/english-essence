<?php

use App\Dictionary;
use App\User;
use App\Word;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class)->create(['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('admin')]);
        $dictionary = factory(Dictionary::class)->create(['user_id' => $user->id]);
        $dictionary->words()->sync(factory(Word::class, 20)->create(['language' => Word::LANGUAGES['en']]));
    }
}

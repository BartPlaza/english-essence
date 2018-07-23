<?php

namespace App\Listeners;

use App\Dictionary;
use App\Events\RegisteredNewUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateDictionary
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RegisteredNewUser  $event
     * @return void
     */
    public function handle(RegisteredNewUser $event)
    {
        Dictionary::create(['user_id' => $event->userId, 'name' => 'default']);
    }
}

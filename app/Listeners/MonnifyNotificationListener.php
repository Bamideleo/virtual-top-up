<?php

namespace App\Listeners;

use App\Events\NewWebHookCallReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MonnifyNotificationListener
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
     * @param  \App\Events\NewWebHookCallReceived  $event
     * @return void
     */
    public function handle(NewWebHookCallReceived $event)
    {
        //
    }
}

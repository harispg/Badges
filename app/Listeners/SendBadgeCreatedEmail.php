<?php

namespace App\Listeners;

use App\Providers\BadgeCreated;
use App\Mail\Badge_Created;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendBadgeCreatedEmail implements ShouldQueue
{

    public $timeout = 180;
    
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
     * @param  BadgeCreated  $event
     * @return void
     */
    public function handle(BadgeCreated $event)
    {
        foreach ($event->users as $user) {
          \Mail::to($user)->send(new Badge_Created($event->badge, $user));
        }
        
    }
}

<?php

namespace App\Listeners;

use App\Models\Profile;
use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Events\Subscriber;


class CreateUserProfile implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;

        // Create a new profile for the user
        $user->profile()->firstOrCreate(['user_id' => $user->id], [
            'avatar' => '1.jpg',
            'bio' => '',
            'is_seller' => 0
        ]);
        

    }
     /**
     * Define the events and listeners for the subscriber.
     *
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\UserCreated',
            'App\Listeners\CreateUserProfile@handle'
        );
    }
}

<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Events\UserLogin;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserLoginAt
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $event->user->update([
            'last_login_at' => Carbon::now(),
            'last_login_ip' => request()->ip()
         ]);
    }
}

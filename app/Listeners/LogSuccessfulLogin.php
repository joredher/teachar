<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
//        date('Y-m-d H:i:s')
//        $user->last_login_at = $event->user->current_sign_in_at ? $event->user->current_sign_in_at : Carbon::now();
        $user = $event->user;
        $user->current_sign_in_at = Carbon::now();
        $user->last_login_ip = $this->request->ip();
        $user->save();
    }
}

<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Session;

class LoginSuccessful
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
     * @param  \IlluminateAuthEventsLogin  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $pass = $event->user->backup_pass;
        $email = $event->user->email;
        $id = $event->user->id;

        $login = Http::post('http://127.0.0.1:8000/api/v1/user/login', [
            'email' => $email,
            'password' => $pass,
        ]);

        $json = $login->json();

        $current = User::findOrFail($id);
        if ($current) {
            $current->token = $json;
            $current->save();
        }
    }
}

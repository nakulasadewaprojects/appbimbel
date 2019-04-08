<?php

namespace Illuminate\Auth\Events;

use Illuminate\Queue\SerializesModels;

class Authenticated
{
    use SerializesModels;

    /**
     * The authentication guard name.
     *
     * @var string
     */
    public $guard;

    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $user1;

    /**
     * Create a new event instance.
     *
     * @param  string  $guard
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function __construct($guard, $user1)
    {
        $this->user1 = $user1;
        $this->guard = $guard;
    }
}

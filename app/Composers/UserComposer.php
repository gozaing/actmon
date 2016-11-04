<?php

namespace App\Composers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;

class UserComposer
{
    /** @var Guard */
    protected $guard;

    /**
     * UserComposer constructor.
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    public function compose(View $view)
    {
        $view->with('user', $this->guard->user());
    }

}

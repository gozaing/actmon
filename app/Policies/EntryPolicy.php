<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\DataAccess\Eloquent\User;
use App\DataAccess\Eloquent\Entry;

class EntryPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Entry $entry)
    {
        return $user->id === (int) $entry->user_id;
    }
}

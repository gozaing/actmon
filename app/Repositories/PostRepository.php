<?php

namespace App\Repositories;

use App\User;
use Illuminate\Database\Eloquent\Collection;

class PostRepository
{
    /**
     * 指定ユーザの全ポストを取得
     *
     * @param User $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->posts()
                    ->orderBy('created_at', 'asc')
                    ->get();
    }


}
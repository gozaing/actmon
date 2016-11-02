<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\DataAccess\Eloquent\User;
use App\Post;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 指定されたユーザが指定されたポストを削除できるか決定
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function destroy(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}

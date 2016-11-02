<?php

namespace App\DataAccess\Eloquent;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * 特定ユーザーの全ポストを取得する
     *
     *
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

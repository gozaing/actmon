<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    /**
     * 複数代入を行う属性
     *
     * @var array
     */
    protected $fillable = ['title', 'body'];

    /**
     * ポスト所有ユーザーの取得
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Services;

use Illuminate\Contracts\Mail\Mailer;
use App\Repositories\UserRepositoryInterface;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /** @var UserRepositoryInterface */
    protected $user;

    /** @var Mailer */
    protected $mailer;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $user
     * @param Mailer $mailer
     */
    public function __construct(UserRepositoryInterface $user, Mailer $mailer)
    {
        $this->user   = $user;
        $this->mailer = $mailer;
    }

    /**
     * @param array $params
     * @return App\DataAccess\Eloquent\User
     */
    public function registerUser(array $params)
    {
        $user = $this->user->save($params);

        $this->mailer->send(
            'emails.register',
            ['user' => $user],
            function ($m) use ($user) {
                $m->sender('laravel-ref-jp@example.com', 'laravel-ref')
                    ->to($user->email, $user->name)
                    ->subject('ユーザ登録が完了しました');
            }
        );
        return $user;

    }

    /**
    * @return mixed
    */
   public function getUsers()
   {
       return $this->user->all();
   }
}

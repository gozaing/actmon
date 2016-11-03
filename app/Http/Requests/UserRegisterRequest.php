<?php

namespace App\Http\Requests;

/**
 * class UserRegisterRequest
 * @package App\Http\Request
 */
class UserRegisterRequest extends Request
{
   /** @var string */
   protected $redirectRoute = 'get.register';

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6'
        ];
    }
}

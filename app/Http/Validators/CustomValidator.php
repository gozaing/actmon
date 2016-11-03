<?php

namespace App\Http\Validators;

use Illuminate\Validation\Validator;

/**
 * カスタムバリデートクラス
 * Class CustomValidator
 * @package App\Http\Validators
 */
class CustomValidator extends Validator
{
    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function validateCaptcha($attribute, $value)
    {
        $this->after(function () {
            // 認証利用後のセッションから指定のキーを削除する
            session()->forget('captcha.phrase');
        });
        return $value === session('captcha.phrase');
    }
}

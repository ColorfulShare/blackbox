<?php

namespace App\Http\Traits;

use App\Models\User;
use PragmaRX\Google2FA\Google2FA;

trait TwoFactor{

    /**
     * Permite verificar si el codigo Es correcto
     *
     * @param integer $user_id
     * @param integer $code
     * @return boolean
     */
    public function checkCode(User $user, $code): bool
    {
        $result = false;
        if ((new Google2FA())->verifyKey($user->token_google, $code)) {
            $result = true;
        }
        return $result;
    }

    public function checkCodeMail(User $user, $code)
    {
        $result = false;

        if(($user->two_factor_code_email == $code)){
            $result = true;
        }
        return $result;
    }
}
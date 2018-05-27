<?php
 
namespace App\Support;
 
use PragmaRX\Google2FALaravel\Support\Authenticator;
use Auth;
 
class Google2FAAuthenticator extends Authenticator
{
    protected function canPassWithoutCheckingOTP()
    {
            !$this->isEnabled() ||
            $this->noUserIsAuthenticated() ||
            $this->twoFactorAuthStillValid();
    }
 
    protected function getGoogle2FASecretKey()
    {
        $secret = Auth::user()->{$this->config('otp_secret_column')};
        
        if (is_null($secret) || empty($secret)) {
            throw new InvalidSecretKey('Secret key cannot be empty.');
        }
 
        return $secret;
    }
 
 
}
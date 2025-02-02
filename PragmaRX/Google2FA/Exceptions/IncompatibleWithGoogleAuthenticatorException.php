<?php

namespace PragmaRX\Google2FA\Exceptions;

require_once("Contracts/Google2FA.php");
require_once("Contracts/IncompatibleWithGoogleAuthenticator.php");

use PragmaRX\Google2FA\Exceptions\Contracts\Google2FA as Google2FAExceptionContract;
use PragmaRX\Google2FA\Exceptions\Contracts\IncompatibleWithGoogleAuthenticator as IncompatibleWithGoogleAuthenticatorExceptionContract;

class IncompatibleWithGoogleAuthenticatorException extends Google2FAException implements Google2FAExceptionContract, IncompatibleWithGoogleAuthenticatorExceptionContract
{
    protected $message = 'This secret key is not compatible with Google Authenticator.';
}

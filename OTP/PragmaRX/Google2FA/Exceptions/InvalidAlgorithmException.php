<?php

namespace PragmaRX\Google2FA\Exceptions;

require_once("Contracts/Google2FA.php");
require_once("Contracts/InvalidAlgorithm.php");
require_once("Google2FAException.php");

use PragmaRX\Google2FA\Exceptions\Contracts\Google2FA as Google2FAExceptionContract;
use PragmaRX\Google2FA\Exceptions\Contracts\InvalidAlgorithm as InvalidAlgorithmExceptionContract;

class InvalidAlgorithmException extends Google2FAException implements Google2FAExceptionContract, InvalidAlgorithmExceptionContract
{
    protected $message = 'Invalid HMAC algorithm.';
}

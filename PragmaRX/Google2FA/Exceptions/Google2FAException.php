<?php

namespace PragmaRX\Google2FA\Exceptions;

require_once("Contracts/Google2FA.php");

use Exception;
use PragmaRX\Google2FA\Exceptions\Contracts\Google2FA as Google2FAExceptionContract;

class Google2FAException extends Exception implements Google2FAExceptionContract
{
}

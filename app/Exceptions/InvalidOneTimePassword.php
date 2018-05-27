<?php

namespace PragmaRX\Google2FALaravel\Exceptions;

use Exception;

class InvalidOneTimePassword extends Exception
{
    protected $message = 'Error';
}

<?php

namespace App\Exceptions;

use Exception;

class EmptyCoinDepositException extends Exception
{
    public function __construct() {
        parent::__construct('Empty coin deposit');
    }
}
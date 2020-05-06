<?php

namespace App\Exceptions;

use Exception;

class NotEnoughCoinsException extends Exception
{
    public function __construct() {
        parent::__construct('Not enough coins');
    }
}
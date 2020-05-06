<?php

namespace App\Exceptions;

use Exception;

class OperationNotAllowedException extends Exception
{
    public function __construct() {
        parent::__construct('Operation not allowed');
    }
}
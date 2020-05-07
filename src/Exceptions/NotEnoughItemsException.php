<?php

namespace App\Exceptions;

use Exception;

class NotEnoughItemsException extends Exception
{
    public function __construct() {
        parent::__construct('Not enough items');
    }
}
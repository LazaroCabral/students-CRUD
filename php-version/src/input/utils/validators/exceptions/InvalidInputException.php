<?php

namespace Lazaro\StudentCrud\Input\Utils\Validators\Exceptions;

use Exception;

class InvalidInputException extends Exception{

    public function __construct(string $message) {
        parent::__construct($message);
    }
}
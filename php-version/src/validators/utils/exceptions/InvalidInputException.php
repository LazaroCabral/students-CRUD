<?php

namespace Lazaro\StudentCrud\Validators\Utils\Exceptions;

use Exception;

class InvalidInputException extends Exception{

    public function __construct(string $message) {
        parent::__construct($message);
    }
}
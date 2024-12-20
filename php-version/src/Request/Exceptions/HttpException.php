<?php

namespace Lazaro\StudentCrud\Request\Exceptions;

class HttpException extends \Exception{

    public function __construct(int $httpCode) {
        parent::__construct((string) $httpCode);
    }

}
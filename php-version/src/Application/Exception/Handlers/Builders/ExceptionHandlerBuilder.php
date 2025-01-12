<?php

namespace Lazaro\StudentCrud\Application\Exception\Handlers\Builders;

use Lazaro\StudentCrud\Application\Exception\Handlers\AbstractExceptionHandler;
use Lazaro\StudentCrud\Application\Exception\Handlers\ExceptionHandlerInterface;

class ExceptionHandlerBuilder{

    private ExceptionHandlerInterface $firstHandler;

    private ExceptionHandlerInterface | null $lastHandler=null;

    public function __construct(AbstractExceptionHandler $exceptionHandler) {
        $this->firstHandler=$exceptionHandler;
    }

    public function addHandler(AbstractExceptionHandler $handler): ExceptionHandlerBuilder{
            if($this->lastHandler == null){
                $this->firstHandler->setNext($handler);
                $this->lastHandler=&$handler;
            }
            else{
                $this->lastHandler->setNext($handler);
                $this->lastHandler=&$handler;
            }
        return $this;
    }

    public function create(): ExceptionHandlerInterface{
        return $this->firstHandler;
    }


}